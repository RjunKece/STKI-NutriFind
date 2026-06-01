<?php

namespace App\Services;

use App\Models\Food;
use App\Models\SearchLog;
use Illuminate\Support\Collection;

/**
 * SearchService
 * 
 * Service utama yang mengorkestrasikan seluruh proses pencarian:
 * 1. Menerima query dari user
 * 2. Melakukan preprocessing query
 * 3. Preprocessing seluruh dokumen
 * 4. Menghitung TF-IDF untuk query dan dokumen
 * 5. Menghitung Cosine Similarity
 * 6. Mengembalikan hasil ranking berdasarkan relevansi
 */
class SearchService
{
    private PreprocessingService $preprocessor;
    private TfidfService $tfidf;
    private CosineSimilarityService $cosine;

    public function __construct(
        PreprocessingService $preprocessor,
        TfidfService $tfidf,
        CosineSimilarityService $cosine
    ) {
        $this->preprocessor = $preprocessor;
        $this->tfidf = $tfidf;
        $this->cosine = $cosine;
    }

    /**
     * Fungsi pencarian utama
     * Mengembalikan hasil pencarian dengan ranking berdasarkan cosine similarity
     * 
     * @param string $query Query pencarian user
     * @param string|null $category Filter kategori (opsional)
     * @return array [
     *   'results' => Collection of foods with scores,
     *   'query_info' => array of query processing details,
     *   'index_info' => array of indexing details,
     *   'total_results' => int
     * ]
     */
    public function search(string $query, ?string $category = null): array
    {
        // Ambil semua dokumen makanan
        $foodsQuery = Food::query();
        if ($category) {
            $foodsQuery->where('category', $category);
        }
        $foods = $foodsQuery->get();

        if ($foods->isEmpty()) {
            return [
                'results' => collect(),
                'query_info' => [
                    'original' => $query,
                    'processed_tokens' => [],
                ],
                'index_info' => [],
                'total_results' => 0,
            ];
        }

        // ========================================
        // TAHAP 1: Preprocessing Query
        // ========================================
        $queryTokens = $this->preprocessor->process($query);
        $queryDetails = $this->preprocessor->processWithDetails($query);

        if (empty($queryTokens)) {
            return [
                'results' => collect(),
                'query_info' => [
                    'original' => $query,
                    'processed_tokens' => [],
                    'details' => $queryDetails,
                ],
                'index_info' => [],
                'total_results' => 0,
            ];
        }

        // ========================================
        // TAHAP 2: Preprocessing Dokumen
        // ========================================
        $allDocumentTokens = [];
        $foodMap = [];

        foreach ($foods as $food) {
            $fullText = $food->full_text;
            $tokens = $this->preprocessor->process($fullText);
            $allDocumentTokens[$food->id] = $tokens;
            $foodMap[$food->id] = $food;
        }

        // Tambahkan query sebagai "dokumen" tambahan untuk perhitungan TF-IDF
        // Query diperlakukan sebagai dokumen terakhir dalam koleksi
        $allTokensWithQuery = $allDocumentTokens;
        $allTokensWithQuery['query'] = $queryTokens;

        // ========================================
        // TAHAP 3: Hitung TF-IDF Index
        // ========================================
        $index = $this->tfidf->buildIndex($allTokensWithQuery);

        // Ambil vektor TF-IDF query
        $queryVector = $index['vectors']['query'] ?? [];

        // Ambil vektor TF-IDF dokumen (tanpa query)
        $documentVectors = [];
        foreach ($index['vectors'] as $docId => $vector) {
            if ($docId !== 'query') {
                $documentVectors[$docId] = $vector;
            }
        }

        // ========================================
        // TAHAP 4: Hitung Cosine Similarity
        // ========================================
        $similarityScores = $this->cosine->calculateBatch($queryVector, $documentVectors);

        // ========================================
        // TAHAP 5: Bangun Hasil Ranking
        // ========================================
        $results = collect();
        $rank = 1;
        foreach ($similarityScores as $docId => $score) {
            if (isset($foodMap[$docId])) {
                $food = $foodMap[$docId];
                $food->relevance_score = round($score, 6);
                $food->rank = $rank++;
                $food->matched_terms = $this->getMatchedTerms($queryTokens, $allDocumentTokens[$docId]);
                $results->push($food);
            }
        }

        // ========================================
        // TAHAP 6: Log Pencarian
        // ========================================
        $processedQueryString = implode(' ', $queryTokens);
        SearchLog::create([
            'query' => $query,
            'processed_query' => $processedQueryString,
            'result_count' => $results->count(),
        ]);

        return [
            'results' => $results,
            'query_info' => [
                'original' => $query,
                'processed_tokens' => $queryTokens,
                'details' => $queryDetails,
            ],
            'index_info' => [
                'total_documents' => $index['total_documents'] - 1, // Minus query
                'vocabulary_size' => $index['vocabulary_size'],
                'query_vector' => $queryVector,
            ],
            'total_results' => $results->count(),
        ];
    }

    /**
     * Cari term query yang cocok dalam dokumen
     * Digunakan untuk keyword highlighting
     */
    private function getMatchedTerms(array $queryTokens, array $docTokens): array
    {
        return array_values(array_unique(array_intersect($queryTokens, $docTokens)));
    }

    /**
     * Dapatkan saran pencarian sederhana berdasarkan riwayat pencarian
     * (Spell correction sederhana menggunakan levenshtein distance)
     */
    public function getSuggestions(string $query, int $limit = 5): array
    {
        $previousQueries = SearchLog::select('query')
            ->distinct()
            ->pluck('query')
            ->toArray();

        if (empty($previousQueries)) {
            return [];
        }

        $suggestions = [];
        foreach ($previousQueries as $prev) {
            $distance = levenshtein(mb_strtolower($query), mb_strtolower($prev));
            if ($distance > 0 && $distance <= 3) {
                $suggestions[] = [
                    'query' => $prev,
                    'distance' => $distance,
                ];
            }
        }

        // Urutkan berdasarkan jarak terdekat
        usort($suggestions, fn($a, $b) => $a['distance'] - $b['distance']);

        return array_slice(array_column($suggestions, 'query'), 0, $limit);
    }

    /**
     * Highlight keyword dalam teks berdasarkan query tokens
     * Mengembalikan teks dengan tag <mark> pada term yang cocok
     */
    public function highlightText(string $text, array $queryTokens): string
    {
        if (empty($queryTokens)) {
            return $text;
        }

        // Buat pattern regex dari token query
        // Gunakan original words (sebelum stemming) untuk matching visual
        $words = explode(' ', $text);
        $highlighted = [];

        foreach ($words as $word) {
            $processedWord = $this->preprocessor->process($word);
            $isMatch = false;

            foreach ($processedWord as $pw) {
                if (in_array($pw, $queryTokens)) {
                    $isMatch = true;
                    break;
                }
            }

            if ($isMatch) {
                $highlighted[] = '<mark class="bg-yellow-200 px-0.5 rounded">' . e($word) . '</mark>';
            } else {
                $highlighted[] = e($word);
            }
        }

        return implode(' ', $highlighted);
    }

    /**
     * Dapatkan statistik pencarian
     */
    public function getSearchStats(): array
    {
        $totalSearches = SearchLog::count();
        $topQueries = SearchLog::select('query')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('query')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        $recentSearches = SearchLog::orderByDesc('created_at')
            ->limit(10)
            ->get();

        $avgResultCount = SearchLog::avg('result_count');

        return [
            'total_searches' => $totalSearches,
            'top_queries' => $topQueries,
            'recent_searches' => $recentSearches,
            'avg_result_count' => round($avgResultCount ?? 0, 1),
        ];
    }
}
