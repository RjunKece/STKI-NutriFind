@extends('layouts.app')

@section('title', 'Dataset Makanan — STKI MBG')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dataset Makanan Bergizi</h1>
            <p class="text-sm text-gray-500 mt-1">Total <span class="font-semibold text-gray-700">{{ $totalFoods }}</span> dokumen makanan dalam database</p>
        </div>

        {{-- Category Filter --}}
        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('food.index') }}" 
               class="px-3 py-1.5 rounded-lg text-xs font-medium transition-all {{ !$category ? 'bg-green-500 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }}">
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('food.index', ['category' => $cat]) }}" 
               class="px-3 py-1.5 rounded-lg text-xs font-medium transition-all {{ $category == $cat ? 'bg-green-500 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-green-300' }}">
                {{ ucfirst($cat) }}
            </a>
            @endforeach
        </div>
    </div>

    {{-- Food Grid --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($foods as $food)
        <a href="{{ route('food.show', $food) }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300 overflow-hidden flex flex-col">
            {{-- Top color bar --}}
            <div class="h-1 bg-gradient-to-r from-green-400 to-emerald-500"></div>

            <div class="p-4 flex flex-col flex-1">
                {{-- Category Badge --}}
                <span class="inline-flex items-center self-start px-2.5 py-1 rounded-lg text-xs font-medium bg-green-50 text-green-700 border border-green-100 mb-2">
                    {{ ucfirst($food->category) }}
                </span>

                {{-- Title --}}
                <h3 class="text-sm font-bold text-gray-800 group-hover:text-green-700 transition-colors mb-2 line-clamp-2">
                    {{ $food->title }}
                </h3>

                {{-- Description --}}
                <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 flex-1">
                    {{ Str::limit($food->description, 120) }}
                </p>

                {{-- Footer --}}
                <div class="mt-3 pt-3 border-t border-gray-50 flex items-center justify-between">
                    <span class="text-xs text-gray-400">ID: {{ $food->id }}</span>
                    <span class="text-xs text-green-600 font-medium group-hover:translate-x-1 transition-transform">Detail →</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $foods->appends(request()->query())->links() }}
    </div>
</div>
@endsection
