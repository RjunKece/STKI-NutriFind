<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

// ============================================
// HALAMAN UTAMA - Search Engine Landing Page
// ============================================
Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::get('/search', [SearchController::class, 'results'])->name('search.results');

// ============================================
// DATASET MAKANAN
// ============================================
Route::get('/foods', [FoodController::class, 'index'])->name('food.index');
Route::get('/foods/{food}', [FoodController::class, 'show'])->name('food.show');

// ============================================
// EVALUASI IR
// ============================================
Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation.index');
Route::post('/evaluation/run', [EvaluationController::class, 'run'])->name('evaluation.run');
Route::get('/evaluation/{evaluationQuery}', [EvaluationController::class, 'detail'])->name('evaluation.detail');
