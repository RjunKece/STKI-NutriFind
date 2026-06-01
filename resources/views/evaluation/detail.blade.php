@extends('layouts.app')

@section('title', "Detail Evaluasi: {$evaluationQuery->query} — STKI MBG")

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('evaluation.index') }}" class="hover:text-green-600 transition-colors">Evaluasi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700 font-medium">{{ Str::limit($evaluationQuery->query, 40) }}</span>
    </nav>

    {{-- Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
        <h1 class="text-xl font-bold text-gray-900 mb-2">Detail Evaluasi Query</h1>
        <p class="text-base text-green-700 font-semibold mb-4">"{{ $evaluationQuery->query }}"</p>

        {{-- Metrics --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-xs text-gray-500">Precision@K</div>
                <div class="text-xl font-bold {{ $precisionAtK > 0.3 ? 'text-green-600' : ($precisionAtK > 0.1 ? 'text-amber-600' : 'text-red-500') }}">
                    {{ number_format($precisionAtK, 4) }}
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-xs text-gray-500">Average Precision</div>
                <div class="text-xl font-bold {{ $averagePrecision > 0.3 ? 'text-green-600' : ($averagePrecision > 0.1 ? 'text-amber-600' : 'text-red-500') }}">
                    {{ number_format($averagePrecision, 4) }}
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-xs text-gray-500">Dokumen Relevan</div>
                <div class="text-xl font-bold text-gray-800">{{ $totalRelevant }} / {{ $totalRetrieved }}</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4">
                <div class="text-xs text-gray-500">Expected Docs</div>
                <div class="text-xl font-bold text-gray-800">{{ count($expectedIds) }}</div>
            </div>
        </div>
    </div>

    {{-- Expected Document IDs --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
        <h3 class="text-sm font-bold text-gray-700 mb-3">Expected Document IDs (Ground Truth)</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($expectedIds as $docId)
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                #{{ $docId }}
            </span>
            @endforeach
        </div>
    </div>

    {{-- Retrieved Results --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-bold text-gray-700">Hasil Retrieval (diurutkan berdasarkan ranking)</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left font-medium">Rank</th>
                        <th class="px-6 py-3 text-left font-medium">Dokumen</th>
                        <th class="px-6 py-3 text-left font-medium">Skor</th>
                        <th class="px-6 py-3 text-left font-medium">Relevan?</th>
                        <th class="px-6 py-3 text-left font-medium">P@rank</th>
                        <th class="px-6 py-3 text-left font-medium">Kumulatif</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($enrichedResults as $er)
                    <tr class="hover:bg-gray-50/50 transition-colors {{ $er['result']->is_relevant ? 'bg-green-50/30' : '' }}">
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold
                                {{ $er['result']->rank <= 3 ? 'bg-gradient-to-br from-green-500 to-emerald-600 text-white' : 'bg-gray-100 text-gray-500' }}">
                                {{ $er['result']->rank }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($er['result']->food)
                            <a href="{{ route('food.show', $er['result']->food) }}" class="font-medium text-gray-800 hover:text-green-600 transition-colors">
                                {{ $er['result']->food->title }}
                            </a>
                            <div class="text-xs text-gray-400 mt-0.5">ID: {{ $er['result']->retrieved_document_id }}</div>
                            @else
                            <span class="text-gray-400">Dokumen #{{ $er['result']->retrieved_document_id }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-xs">
                            {{ number_format($er['result']->relevance_score, 6) }}
                        </td>
                        <td class="px-6 py-4">
                            @if($er['result']->is_relevant)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                ✅ Ya
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-red-50 text-red-600 border border-red-100">
                                ❌ Tidak
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-xs {{ $er['result']->is_relevant ? 'text-green-600 font-semibold' : 'text-gray-400' }}">
                            {{ number_format($er['precision_at_rank'], 4) }}
                        </td>
                        <td class="px-6 py-4 text-xs text-gray-600">
                            {{ $er['cumulative_relevant'] }} relevan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Back --}}
    <div class="mt-6">
        <a href="{{ route('evaluation.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Evaluasi
        </a>
    </div>
</div>
@endsection
