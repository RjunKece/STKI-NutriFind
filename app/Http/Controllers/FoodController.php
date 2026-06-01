<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Halaman daftar semua makanan (Dataset List)
     */
    public function index(Request $request)
    {
        $category = $request->input('category');

        $query = Food::query();
        if ($category) {
            $query->where('category', $category);
        }

        $foods = $query->orderBy('title')->paginate(20);
        $categories = Food::select('category')->distinct()->pluck('category');
        $totalFoods = Food::count();

        return view('food.index', compact('foods', 'categories', 'category', 'totalFoods'));
    }

    /**
     * Halaman detail makanan
     */
    public function show(Food $food)
    {
        return view('food.show', compact('food'));
    }
}
