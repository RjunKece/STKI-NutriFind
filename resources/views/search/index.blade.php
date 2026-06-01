@extends('layouts.app')

@section('title', 'STKI MBG - Pencarian Makanan Bergizi')

@section('content')
<div class="relative overflow-hidden">
    {{-- Hero Section --}}
    <div class="relative min-h-[70vh] flex items-center justify-center">
        {{-- Background decoration --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-green-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-green-50 rounded-full blur-3xl opacity-30"></div>
        </div>

        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-green-100/80 backdrop-blur-sm text-green-800 text-xs font-semibold px-4 py-2 rounded-full mb-8 border border-green-200/50">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                Information Retrieval System — TF-IDF & Cosine Similarity
            </div>

            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight tracking-tight mb-4">
                Temukan Menu
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-500"> Makanan Bergizi</span>
            </h1>

            <p class="text-lg text-gray-500 mb-10 max-w-xl mx-auto leading-relaxed">
                Sistem Temu Kembali Informasi untuk Program 
                <span class="font-semibold text-gray-700">Makan Bergizi Gratis (MBG)</span>
            </p>

            {{-- Search Form --}}
            <form action="{{ route('search.results') }}" method="GET" class="relative max-w-2xl mx-auto" id="search-form">
                <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-400 rounded-2xl blur-lg opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                    <div class="relative flex items-center bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-200/80 overflow-hidden">
                        <div class="pl-5">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="q" id="search-input"
                               placeholder="Cari makanan bergizi..."
                               value="{{ old('q') }}"
                               autocomplete="off"
                               class="flex-1 py-4 px-4 text-base text-gray-800 placeholder-gray-400 bg-transparent border-none outline-none focus:ring-0">
                        <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 m-1.5 rounded-xl font-semibold text-sm hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md shadow-green-200 hover:shadow-lg hover:shadow-green-300 active:scale-95">
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            {{-- Sample Queries --}}
            <div class="mt-8 flex flex-wrap items-center justify-center gap-2">
                <span class="text-xs text-gray-400 mr-1">Coba:</span>
                @foreach(['tinggi protein', 'murah bergizi', 'menu anak sekolah', 'rendah gula', 'vegetarian', 'tinggi serat'] as $sample)
                <a href="{{ route('search.results', ['q' => $sample]) }}" 
                   class="inline-flex items-center px-3 py-1.5 bg-white/80 backdrop-blur-sm border border-gray-200/80 rounded-full text-xs text-gray-600 hover:text-green-700 hover:border-green-300 hover:bg-green-50/50 transition-all duration-200">
                    {{ $sample }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-2xl font-bold text-gray-900">{{ $totalFoods }}</div>
                <div class="text-xs text-gray-500 mt-1">Dokumen Makanan</div>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-2xl font-bold text-gray-900">{{ $categories->count() }}</div>
                <div class="text-xs text-gray-500 mt-1">Kategori</div>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['total_searches'] }}</div>
                <div class="text-xs text-gray-500 mt-1">Total Pencarian</div>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300">
                <div class="text-2xl font-bold text-gray-900">{{ $stats['avg_result_count'] }}</div>
                <div class="text-xs text-gray-500 mt-1">Rata-rata Hasil</div>
            </div>
        </div>

        {{-- Recent & Popular Searches --}}
        @if($stats['total_searches'] > 0)
        <div class="mt-8 grid md:grid-cols-2 gap-6">
            {{-- Top Queries --}}
            @if($stats['top_queries']->isNotEmpty())
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    🔥 Query Terpopuler
                </h3>
                <div class="space-y-2">
                    @foreach($stats['top_queries']->take(5) as $tq)
                    <a href="{{ route('search.results', ['q' => $tq->query]) }}" 
                       class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors group">
                        <span class="text-sm text-gray-600 group-hover:text-green-700">{{ $tq->query }}</span>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $tq->count }}×</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Recent Searches --}}
            @if($stats['recent_searches']->isNotEmpty())
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    🕐 Pencarian Terakhir
                </h3>
                <div class="space-y-2">
                    @foreach($stats['recent_searches']->take(5) as $rs)
                    <a href="{{ route('search.results', ['q' => $rs->query]) }}" 
                       class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-gray-50 transition-colors group">
                        <span class="text-sm text-gray-600 group-hover:text-green-700">{{ $rs->query }}</span>
                        <span class="text-xs text-gray-400">{{ $rs->created_at->diffForHumans() }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Categories --}}
        <div class="mt-8">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Jelajahi Kategori</h3>
            <div class="flex flex-wrap gap-3">
                @foreach($categories as $cat)
                <a href="{{ route('search.results', ['q' => $cat, 'category' => $cat]) }}" 
                   class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 hover:border-green-300 hover:text-green-700 hover:bg-green-50/50 transition-all duration-200 shadow-sm hover:shadow">
                    @switch($cat)
                        @case('tinggi protein') 💪 @break
                        @case('rendah gula') 🍃 @break
                        @case('murah bergizi') 💰 @break
                        @case('vegetarian') 🥬 @break
                        @case('anak sekolah') 🎒 @break
                        @case('tinggi serat') 🌾 @break
                    @endswitch
                    {{ ucfirst($cat) }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
