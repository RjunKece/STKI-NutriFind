@extends('layouts.app')

@section('title', "Hasil Pencarian: {$query} — STKI MBG")

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Search Bar --}}
    <form action="{{ route('search.results') }}" method="GET" class="mb-8">
        <div class="flex items-center gap-3">
            <div class="relative flex-1">
                <div class="absolute left-4 top-1/2 -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="q" value="{{ $query }}" placeholder="Cari makanan bergizi..."
                       class="w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-400 transition-all shadow-sm">
            </div>
            {{-- Category Filter --}}
            <select name="category" class="py-3.5 px-4 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-400 shadow-sm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3.5 rounded-xl font-semibold text-sm hover:from-green-600 hover:to-emerald-700 transition-all shadow-sm hover:shadow-md active:scale-95">
                Cari
            </button>
        </div>
    </form>

    <div class="grid lg:grid-cols-4 gap-8">
        {{-- Main Results --}}
        <div class="lg:col-span-3">
            {{-- Results Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">
                        Hasil untuk "<span class="text-green-600">{{ $query }}</span>"
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Ditemukan <span class="font-semibold text-gray-700">{{ $totalResults }}</span> dokumen relevan
                        @if($category) dalam kategori <span class="font-semibold text-green-600">{{ $category }}</span> @endif
                    </p>
                </div>
            </div>

            {{-- Suggestions --}}
            @if(!empty($suggestions))
            <div class="bg-amber-50 border border-amber-200/60 rounded-xl p-4 mb-6">
                <p class="text-sm text-amber-800">
                    💡 Mungkin yang Anda maksud:
                    @foreach($suggestions as $sug)
                    <a href="{{ route('search.results', ['q' => $sug]) }}" class="font-semibold text-amber-700 hover:text-amber-900 underline underline-offset-2">{{ $sug }}</a>{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                </p>
            </div>
            @endif

            {{-- No Results --}}
            @if($totalResults === 0)
            <div class="text-center py-16">
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak ada hasil ditemukan</h3>
                <p class="text-sm text-gray-500">Coba gunakan kata kunci lain atau kurangi filter.</p>
            </div>
            @endif

            {{-- Result Cards --}}
            <div class="space-y-4">
                @foreach($results as $food)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-gray-200 transition-all duration-300 overflow-hidden group">
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                {{-- Rank Badge --}}
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold
                                        {{ $food->rank <= 3 ? 'bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-sm shadow-green-200' : 'bg-gray-100 text-gray-500' }}">
                                        #{{ $food->rank }}
                                    </span>
                                    <a href="{{ route('food.show', $food) }}" class="text-base font-bold text-gray-900 group-hover:text-green-700 transition-colors truncate">
                                        {{ $food->title }}
                                    </a>
                                </div>

                                {{-- Category Badge --}}
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                        {{ ucfirst($food->category) }}
                                    </span>
                                    @if(!empty($food->matched_terms))
                                    <span class="text-xs text-gray-400">
                                        Cocok: {{ implode(', ', array_slice($food->matched_terms, 0, 5)) }}
                                    </span>
                                    @endif
                                </div>

                                {{-- Description with highlighting --}}
                                <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                                    {!! $searchService->highlightText(Str::limit($food->description, 250), $queryInfo['processed_tokens'] ?? []) !!}
                                </p>
                            </div>

                            {{-- Relevance Score --}}
                            <div class="flex-shrink-0 text-right">
                                <div class="text-xs text-gray-400 mb-1">Skor</div>
                                <div class="text-lg font-bold {{ $food->relevance_score > 0.3 ? 'text-green-600' : ($food->relevance_score > 0.1 ? 'text-amber-600' : 'text-gray-500') }}">
                                    {{ number_format($food->relevance_score, 4) }}
                                </div>
                                {{-- Score Bar --}}
                                <div class="w-20 h-1.5 bg-gray-100 rounded-full mt-2 overflow-hidden">
                                    <div class="h-full rounded-full {{ $food->relevance_score > 0.3 ? 'bg-green-500' : ($food->relevance_score > 0.1 ? 'bg-amber-500' : 'bg-gray-400') }}"
                                         style="width: {{ min($food->relevance_score * 100 * 3, 100) }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Action --}}
                        <div class="mt-4 pt-3 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs text-gray-400">ID: {{ $food->id }}</span>
                            <a href="{{ route('food.show', $food) }}" class="inline-flex items-center gap-1 text-xs font-medium text-green-600 hover:text-green-700 transition-colors">
                                Lihat Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Sidebar: Query Processing Debug --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-4">
                {{-- Preprocessing Details --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                        ⚙️ Preprocessing Query
                    </h3>

                    @if(isset($queryInfo['details']))
                    <div class="space-y-3">
                        {{-- Original --}}
                        <div>
                            <div class="text-xs font-medium text-gray-500 mb-1">1. Original</div>
                            <div class="text-xs bg-gray-50 rounded-lg px-3 py-2 text-gray-700 font-mono">{{ $queryInfo['details']['original'] }}</div>
                        </div>

                        {{-- Case Folded --}}
                        <div>
                            <div class="text-xs font-medium text-gray-500 mb-1">2. Case Folding</div>
                            <div class="text-xs bg-gray-50 rounded-lg px-3 py-2 text-gray-700 font-mono">{{ $queryInfo['details']['case_folded'] }}</div>
                        </div>

                        {{-- Tokens --}}
                        <div>
                            <div class="text-xs font-medium text-gray-500 mb-1">3. Tokenization ({{ $queryInfo['details']['tokens_count'] }})</div>
                            <div class="flex flex-wrap gap-1">
                                @foreach($queryInfo['details']['tokens'] as $token)
                                <span class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded-md">{{ $token }}</span>
                                @endforeach
                            </div>
                        </div>

                        {{-- After Stopword --}}
                        <div>
                            <div class="text-xs font-medium text-gray-500 mb-1">4. Stopword Removal (-{{ $queryInfo['details']['stopwords_removed'] }})</div>
                            <div class="flex flex-wrap gap-1">
                                @foreach($queryInfo['details']['after_stopword'] as $token)
                                <span class="text-xs bg-amber-50 text-amber-700 px-2 py-0.5 rounded-md">{{ $token }}</span>
                                @endforeach
                            </div>
                        </div>

                        {{-- Stemmed --}}
                        <div>
                            <div class="text-xs font-medium text-gray-500 mb-1">5. Stemming ({{ $queryInfo['details']['final_count'] }} terms)</div>
                            <div class="flex flex-wrap gap-1">
                                @foreach($queryInfo['details']['final_tokens'] as $token)
                                <span class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded-md font-medium">{{ $token }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Index Info --}}
                @if(!empty($indexInfo))
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                        📊 Index Info
                    </h3>
                    <div class="space-y-2 text-xs text-gray-600">
                        <div class="flex justify-between">
                            <span>Total Dokumen</span>
                            <span class="font-semibold text-gray-800">{{ $indexInfo['total_documents'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Vocabulary Size</span>
                            <span class="font-semibold text-gray-800">{{ $indexInfo['vocabulary_size'] ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Query Terms</span>
                            <span class="font-semibold text-gray-800">{{ count($queryInfo['processed_tokens'] ?? []) }}</span>
                        </div>
                    </div>

                    {{-- Query TF-IDF Vector --}}
                    @if(!empty($indexInfo['query_vector']))
                    <div class="mt-4 pt-3 border-t border-gray-100">
                        <div class="text-xs font-medium text-gray-500 mb-2">Query TF-IDF Vector</div>
                        <div class="space-y-1">
                            @foreach(array_slice($indexInfo['query_vector'], 0, 10, true) as $term => $weight)
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600 font-mono">{{ $term }}</span>
                                <span class="text-gray-800 font-semibold">{{ number_format($weight, 4) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
