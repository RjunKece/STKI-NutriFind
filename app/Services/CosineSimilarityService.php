<?php

namespace App\Services;

/**
 * CosineSimilarityService
 * 
 * Service untuk menghitung Cosine Similarity antara dua vektor TF-IDF.
 * 
 * Rumus Cosine Similarity:
 * cos(θ) = (A · B) / (||A|| × ||B||)
 * 
 * dimana:
 * - A · B = dot product dari vektor A dan B
 * - ||A|| = magnitude (panjang) vektor A
 * - ||B|| = magnitude (panjang) vektor B
 * 
 * Nilai cosine similarity berkisar antara 0 (tidak relevan) hingga 1 (sangat relevan)
 */
class CosineSimilarityService
{
    /**
     * Hitung Cosine Similarity antara dua vektor
     * 
     * @param array $vectorA Vektor pertama (misal: query) [term => weight]
     * @param array $vectorB Vektor kedua (misal: dokumen) [term => weight]
     * @return float Nilai similarity antara 0.0 - 1.0
     */
    public function calculate(array $vectorA, array $vectorB): float
    {
        // Hitung dot product: Σ(Ai × Bi) untuk term yang ada di kedua vektor
        $dotProduct = $this->dotProduct($vectorA, $vectorB);

        // Hitung magnitude kedua vektor
        $magnitudeA = $this->magnitude($vectorA);
        $magnitudeB = $this->magnitude($vectorB);

        // Jika salah satu vektor nol, similarity = 0
        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0.0;
        }

        // Cosine Similarity = dot product / (magnitude A × magnitude B)
        return $dotProduct / ($magnitudeA * $magnitudeB);
    }

    /**
     * Hitung Dot Product antara dua vektor
     * Dot Product = Σ(Ai × Bi) untuk semua dimensi yang ada di kedua vektor
     * 
     * @param array $vectorA Vektor pertama [term => weight]
     * @param array $vectorB Vektor kedua [term => weight]
     * @return float Nilai dot product
     */
    public function dotProduct(array $vectorA, array $vectorB): float
    {
        $result = 0.0;

        // Iterasi hanya pada term yang ada di vektor A
        foreach ($vectorA as $term => $weightA) {
            if (isset($vectorB[$term])) {
                $result += $weightA * $vectorB[$term];
            }
        }

        return $result;
    }

    /**
     * Hitung Magnitude (panjang/norm) vektor
     * Magnitude = √(Σ(Ai²))
     * 
     * @param array $vector Vektor [term => weight]
     * @return float Magnitude vektor
     */
    public function magnitude(array $vector): float
    {
        $sumOfSquares = 0.0;

        foreach ($vector as $weight) {
            $sumOfSquares += $weight * $weight;
        }

        return sqrt($sumOfSquares);
    }

    /**
     * Hitung similarity antara satu query vector dengan banyak document vectors
     * Mengembalikan array [doc_id => similarity_score] terurut dari tertinggi
     * 
     * @param array $queryVector Vektor query [term => weight]
     * @param array $documentVectors Array vektor dokumen [doc_id => [term => weight]]
     * @param float $threshold Threshold minimum similarity (default 0.0)
     * @return array [doc_id => similarity_score] terurut descending
     */
    public function calculateBatch(array $queryVector, array $documentVectors, float $threshold = 0.0): array
    {
        $scores = [];

        foreach ($documentVectors as $docId => $docVector) {
            $similarity = $this->calculate($queryVector, $docVector);

            // Hanya simpan dokumen yang memenuhi threshold
            if ($similarity > $threshold) {
                $scores[$docId] = $similarity;
            }
        }

        // Urutkan berdasarkan skor tertinggi
        arsort($scores);

        return $scores;
    }
}
