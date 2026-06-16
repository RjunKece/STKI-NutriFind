<?php

namespace Database\Seeders;

use App\Models\DatasetRegistry;
use App\Models\Food;
use App\Services\PreprocessingService;
use Illuminate\Database\Seeder;

/**
 * DatasetRegistrySeeder
 * 
 * Mendaftarkan metadata dataset yang BENAR-BENAR digunakan oleh sistem pencarian.
 * Semua angka (total_documents, categories, vocabulary_size, indexed_documents) 
 * dihitung langsung dari data aktual di database, bukan hardcode.
 */
class DatasetRegistrySeeder extends Seeder
{
    public function run(): void
    {
        // Hitung statistik nyata dari database
        $totalDocuments = Food::count();
        $categories = Food::select('category')->distinct()->pluck('category')->sort()->values()->toArray();
        $indexedDocuments = $totalDocuments; // Semua dokumen di-index

        // Hitung vocabulary size dari seluruh dokumen yang sudah dipreproses
        $vocabularySize = $this->calculateVocabularySize();

        // Dataset utama: Makanan Bergizi Indonesia
        DatasetRegistry::updateOrCreate(
            ['slug' => 'makanan-bergizi-indonesia'],
            [
                'name' => 'Dataset Makanan Bergizi Indonesia',
                'description' => 'Koleksi data menu makanan bergizi Indonesia yang dikurasi untuk mendukung Program Makan Bergizi Gratis (MBG). Setiap dokumen berisi nama makanan, kategori nutrisi, deskripsi lengkap, dan informasi gizi detail termasuk kalori, protein, karbohidrat, lemak, serat, vitamin, dan mineral.',
                'provider' => 'Tim Pengembang STKI MBG',
                'source_url' => null, // Dataset internal, bukan dari sumber eksternal
                'total_documents' => $totalDocuments,
                'categories' => $categories,
                'vocabulary_size' => $vocabularySize,
                'indexed_documents' => $indexedDocuments,
                'last_indexed_at' => now(),
                'status' => 'active',
                'version' => '1.0.0',
            ]
        );
    }

    /**
     * Hitung jumlah kata unik (vocabulary) dari seluruh dokumen
     * setelah melalui preprocessing pipeline (tokenisasi, stopword removal, stemming)
     */
    private function calculateVocabularySize(): int
    {
        try {
            $preprocessor = app(PreprocessingService::class);
            $allTokens = [];

            Food::chunk(50, function ($foods) use ($preprocessor, &$allTokens) {
                foreach ($foods as $food) {
                    $tokens = $preprocessor->process($food->full_text);
                    foreach ($tokens as $token) {
                        $allTokens[$token] = true;
                    }
                }
            });

            return count($allTokens);
        } catch (\Exception $e) {
            // Fallback: estimasi kasar jika preprocessing gagal
            return 0;
        }
    }
}
