<?php

namespace Database\Seeders;

use App\Models\EvaluationQuery;
use Illuminate\Database\Seeder;

/**
 * EvaluationQuerySeeder
 * 
 * Seeder untuk 15 query evaluasi IR dengan expected document IDs.
 * Digunakan untuk menghitung Precision@K dan MAP.
 */
class EvaluationQuerySeeder extends Seeder
{
    public function run(): void
    {
        $queries = [
            [
                'query' => 'makanan tinggi protein untuk anak',
                'expected_document_ids' => [1, 2, 3, 4, 5, 6, 7, 29, 30, 31],
            ],
            [
                'query' => 'sayuran rendah gula sehat',
                'expected_document_ids' => [11, 12, 13, 14, 15, 16, 17, 18, 61, 72],
            ],
            [
                'query' => 'menu murah bergizi untuk sekolah',
                'expected_document_ids' => [19, 20, 21, 22, 23, 24, 25, 26, 27, 28],
            ],
            [
                'query' => 'makanan vegetarian protein nabati',
                'expected_document_ids' => [29, 30, 31, 32, 33, 34, 35, 36, 56, 68],
            ],
            [
                'query' => 'cemilan anak sekolah bergizi',
                'expected_document_ids' => [37, 38, 39, 40, 41, 42, 43, 44, 45, 46],
            ],
            [
                'query' => 'makanan tinggi serat pencernaan',
                'expected_document_ids' => [47, 48, 49, 50, 51, 52, 53, 54, 55, 56],
            ],
            [
                'query' => 'ikan laut omega protein',
                'expected_document_ids' => [3, 7, 9, 15, 58, 64, 70, 76, 80, 2],
            ],
            [
                'query' => 'tempe tahu kedelai fermentasi',
                'expected_document_ids' => [1, 6, 18, 27, 34, 35, 49, 56, 68, 71],
            ],
            [
                'query' => 'sup kuah hangat sayuran',
                'expected_document_ids' => [7, 13, 23, 40, 53, 63, 73, 79, 83, 12],
            ],
            [
                'query' => 'nasi goreng ekonomis praktis',
                'expected_document_ids' => [22, 21, 45, 66, 19, 24, 25, 26, 20, 28],
            ],
            [
                'query' => 'bubur sarapan pagi bergizi',
                'expected_document_ids' => [20, 41, 47, 77, 19, 37, 22, 24, 55, 83],
            ],
            [
                'query' => 'lauk pendamping nasi murah',
                'expected_document_ids' => [4, 27, 28, 59, 62, 67, 71, 74, 1, 19],
            ],
            [
                'query' => 'makanan kaya zat besi kalsium',
                'expected_document_ids' => [12, 45, 60, 6, 48, 30, 32, 47, 51, 17],
            ],
            [
                'query' => 'olahan ayam bumbu rempah',
                'expected_document_ids' => [2, 5, 23, 57, 65, 69, 75, 37, 44, 82],
            ],
            [
                'query' => 'dessert sehat buah segar',
                'expected_document_ids' => [43, 52, 54, 41, 78, 46, 85, 50, 84, 81],
            ],
        ];

        foreach ($queries as $query) {
            EvaluationQuery::create($query);
        }
    }
}
