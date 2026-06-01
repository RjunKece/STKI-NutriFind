<?php

namespace App\Services;

/**
 * TfidfService
 * 
 * Service untuk menghitung TF-IDF (Term Frequency - Inverse Document Frequency).
 * 
 * Rumus:
 * - TF(t,d) = jumlah kemunculan term t dalam dokumen d / total term dalam d
 * - IDF(t) = log(N / df(t)) + 1, dimana N = jumlah total dokumen, df(t) = jumlah dokumen yang mengandung term t
 * - TF-IDF(t,d) = TF(t,d) × IDF(t)
 */
class TfidfService
{
    /**
     * Hitung Term Frequency (TF) untuk satu dokumen
     * TF = jumlah kemunculan term / total term dalam dokumen
     * 
     * @param array $tokens Array token hasil preprocessing
     * @return array Associative array [term => tf_value]
     */
    public function calculateTF(array $tokens): array
    {
        if (empty($tokens)) {
            return [];
        }

        // Hitung frekuensi kemunculan setiap term
        $termCount = array_count_values($tokens);
        $totalTerms = count($tokens);

        // Normalisasi TF: frekuensi / total term
        $tf = [];
        foreach ($termCount as $term => $count) {
            $tf[$term] = $count / $totalTerms;
        }

        return $tf;
    }

    /**
     * Hitung raw Term Frequency (jumlah kemunculan tanpa normalisasi)
     * Digunakan untuk menampilkan detail di halaman debug
     * 
     * @param array $tokens Array token hasil preprocessing
     * @return array Associative array [term => count]
     */
    public function calculateRawTF(array $tokens): array
    {
        if (empty($tokens)) {
            return [];
        }

        return array_count_values($tokens);
    }

    /**
     * Hitung Document Frequency (DF) untuk semua term di seluruh koleksi dokumen
     * DF(t) = jumlah dokumen yang mengandung term t
     * 
     * @param array $allDocumentTokens Array 2D [doc_id => [tokens...]]
     * @return array Associative array [term => df_value]
     */
    public function calculateDF(array $allDocumentTokens): array
    {
        $df = [];

        foreach ($allDocumentTokens as $tokens) {
            // Gunakan unique tokens per dokumen agar satu dokumen hanya dihitung sekali
            $uniqueTerms = array_unique($tokens);
            foreach ($uniqueTerms as $term) {
                if (!isset($df[$term])) {
                    $df[$term] = 0;
                }
                $df[$term]++;
            }
        }

        return $df;
    }

    /**
     * Hitung Inverse Document Frequency (IDF) untuk semua term
     * IDF(t) = log10(N / df(t)) + 1
     * Menambah 1 untuk menghindari IDF = 0 pada term yang muncul di semua dokumen
     * 
     * @param array $df Document Frequency array
     * @param int $totalDocuments Total jumlah dokumen
     * @return array Associative array [term => idf_value]
     */
    public function calculateIDF(array $df, int $totalDocuments): array
    {
        $idf = [];

        foreach ($df as $term => $docFreq) {
            // Menggunakan log10 untuk IDF, +1 sebagai smoothing
            $idf[$term] = log10($totalDocuments / $docFreq) + 1;
        }

        return $idf;
    }

    /**
     * Hitung vektor TF-IDF untuk satu dokumen
     * TF-IDF(t,d) = TF(t,d) × IDF(t)
     * 
     * @param array $tf Term Frequency array untuk dokumen
     * @param array $idf Inverse Document Frequency array global
     * @return array Associative array [term => tfidf_value]
     */
    public function calculateTFIDF(array $tf, array $idf): array
    {
        $tfidf = [];

        foreach ($tf as $term => $tfValue) {
            $idfValue = $idf[$term] ?? 0;
            $tfidf[$term] = $tfValue * $idfValue;
        }

        return $tfidf;
    }

    /**
     * Bangun seluruh index TF-IDF untuk koleksi dokumen
     * Mengembalikan vektor TF-IDF untuk setiap dokumen beserta data pendukung
     * 
     * @param array $allDocumentTokens Array 2D [doc_id => [tokens...]]
     * @return array [
     *   'vectors' => [doc_id => [term => tfidf_value]],
     *   'df' => [term => df_value],
     *   'idf' => [term => idf_value],
     *   'tf' => [doc_id => [term => tf_value]],
     *   'total_documents' => int,
     *   'vocabulary_size' => int
     * ]
     */
    public function buildIndex(array $allDocumentTokens): array
    {
        $totalDocuments = count($allDocumentTokens);
        
        // Hitung DF untuk seluruh koleksi
        $df = $this->calculateDF($allDocumentTokens);
        
        // Hitung IDF berdasarkan DF
        $idf = $this->calculateIDF($df, $totalDocuments);

        $vectors = [];
        $allTf = [];

        foreach ($allDocumentTokens as $docId => $tokens) {
            // Hitung TF per dokumen
            $tf = $this->calculateTF($tokens);
            $allTf[$docId] = $tf;

            // Hitung TF-IDF per dokumen
            $vectors[$docId] = $this->calculateTFIDF($tf, $idf);
        }

        return [
            'vectors' => $vectors,
            'df' => $df,
            'idf' => $idf,
            'tf' => $allTf,
            'total_documents' => $totalDocuments,
            'vocabulary_size' => count($df),
        ];
    }
}
