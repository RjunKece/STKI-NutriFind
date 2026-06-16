<?php

namespace App\Http\Controllers;

use App\Models\DatasetRegistry;
use App\Models\Food;
use App\Services\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private SearchService $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Halaman utama / Landing Page dengan search bar
     */
    public function index()
    {
        $stats = $this->searchService->getSearchStats();
        $categories = Food::select('category')->distinct()->pluck('category');
        $totalFoods = Food::count();

        // Dataset Registry — statistik nyata dari database
        $datasetRegistries = DatasetRegistry::active()->get();

        return view('search.index', compact('stats', 'categories', 'totalFoods', 'datasetRegistries'));
    }

    /**
     * Proses pencarian dan tampilkan hasil
     */
    public function results(Request $request)
    {
        $query = $request->input('q', '');
        $category = $request->input('category');

        if (empty(trim($query))) {
            return redirect()->route('search.index')->with('error', 'Masukkan kata kunci pencarian.');
        }

        // Jalankan search engine
        $searchResults = $this->searchService->search($query, $category);

        // Cari suggestions jika hasil sedikit
        $suggestions = [];
        if ($searchResults['total_results'] < 3) {
            $suggestions = $this->searchService->getSuggestions($query);
        }

        $categories = Food::select('category')->distinct()->pluck('category');

        return view('search.results', [
            'query' => $query,
            'category' => $category,
            'results' => $searchResults['results'],
            'queryInfo' => $searchResults['query_info'],
            'indexInfo' => $searchResults['index_info'],
            'totalResults' => $searchResults['total_results'],
            'suggestions' => $suggestions,
            'categories' => $categories,
            'searchService' => $this->searchService,
        ]);
    }
}
