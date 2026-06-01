<?php

namespace App\Http\Controllers;

use App\Models\EvaluationQuery;
use App\Models\EvaluationResult;
use App\Models\Food;
use App\Services\SearchService;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Halaman dashboard evaluasi IR
     * Menampilkan hasil evaluasi Precision@K dan MAP
     */
    public function index()
    {
        $evaluationQueries = EvaluationQuery::with('results.food')->get();

        return view('evaluation.index', [
            'evaluationQueries' => $evaluationQueries,
            'hasResults' => EvaluationResult::exists(),
        ]);
    }

    /**
     * Jalankan evaluasi untuk semua query pengujian
     * Menghitung Precision@K dan MAP
     */
    public function run(Request $request)
    {
        $k = $request->input('k', 10);

        $evaluationQueries = EvaluationQuery::all();

        if ($evaluationQueries->isEmpty()) {
            return redirect()->route('evaluation.index')
                ->with('error', 'Belum ada query evaluasi. Silakan jalankan seeder.');
        }

        // Hapus hasil evaluasi sebelumnya
        EvaluationResult::truncate();

        $allPrecisions = [];
        $allAveragePrecisions = [];

        foreach ($evaluationQueries as $evalQuery) {
            // Jalankan pencarian untuk setiap query evaluasi
            $searchResults = $this->searchService->search($evalQuery->query);
            $expectedIds = $evalQuery->expected_document_ids;
            $results = $searchResults['results']->take($k);

            $relevant = 0;
            $precisionAtEachRank = [];
            $rank = 0;

            foreach ($results as $result) {
                $rank++;
                $isRelevant = in_array($result->id, $expectedIds);

                if ($isRelevant) {
                    $relevant++;
                }

                // Simpan hasil evaluasi per dokumen
                EvaluationResult::create([
                    'evaluation_query_id' => $evalQuery->id,
                    'retrieved_document_id' => $result->id,
                    'rank' => $rank,
                    'relevance_score' => $result->relevance_score,
                    'is_relevant' => $isRelevant,
                ]);

                // Hitung precision di setiap rank (untuk MAP)
                if ($isRelevant) {
                    $precisionAtEachRank[] = $relevant / $rank;
                }
            }

            // Precision@K = jumlah dokumen relevan di top-K / K
            $precisionAtK = $rank > 0 ? $relevant / $rank : 0;
            $allPrecisions[] = $precisionAtK;

            // Average Precision untuk query ini
            $ap = !empty($precisionAtEachRank) 
                ? array_sum($precisionAtEachRank) / count($expectedIds) 
                : 0;
            $allAveragePrecisions[] = $ap;
        }

        // MAP (Mean Average Precision)
        $map = !empty($allAveragePrecisions) 
            ? array_sum($allAveragePrecisions) / count($allAveragePrecisions) 
            : 0;

        $avgPrecision = !empty($allPrecisions) 
            ? array_sum($allPrecisions) / count($allPrecisions) 
            : 0;

        return redirect()->route('evaluation.index')
            ->with('success', sprintf(
                'Evaluasi selesai! K=%d | Rata-rata Precision@%d: %.4f | MAP: %.4f',
                $k, $k, $avgPrecision, $map
            ));
    }

    /**
     * Detail hasil evaluasi per query
     */
    public function detail(EvaluationQuery $evaluationQuery)
    {
        $evaluationQuery->load('results.food');

        // Hitung metrik untuk query ini
        $results = $evaluationQuery->results->sortBy('rank');
        $expectedIds = $evaluationQuery->expected_document_ids;

        $relevant = 0;
        $precisionAtEachRank = [];
        $enrichedResults = [];

        foreach ($results as $result) {
            $isRelevant = in_array($result->retrieved_document_id, $expectedIds);
            if ($isRelevant) {
                $relevant++;
            }
            $precisionAtRank = $relevant / $result->rank;

            $enrichedResults[] = [
                'result' => $result,
                'precision_at_rank' => $precisionAtRank,
                'cumulative_relevant' => $relevant,
            ];

            if ($isRelevant) {
                $precisionAtEachRank[] = $precisionAtRank;
            }
        }

        $totalRetrieved = $results->count();
        $precisionAtK = $totalRetrieved > 0 ? $relevant / $totalRetrieved : 0;
        $averagePrecision = !empty($precisionAtEachRank) 
            ? array_sum($precisionAtEachRank) / count($expectedIds) 
            : 0;

        return view('evaluation.detail', [
            'evaluationQuery' => $evaluationQuery,
            'enrichedResults' => $enrichedResults,
            'precisionAtK' => $precisionAtK,
            'averagePrecision' => $averagePrecision,
            'totalRelevant' => $relevant,
            'totalRetrieved' => $totalRetrieved,
            'expectedIds' => $expectedIds,
        ]);
    }
}
