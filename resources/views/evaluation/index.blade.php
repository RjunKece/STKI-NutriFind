@extends('layouts.app')

@section('title', 'Evaluasi IR — STKI MBG')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Evaluasi Sistem IR</h1>
            <p class="text-sm text-gray-500 mt-1">Pengujian Precision@K dan Mean Average Precision (MAP)</p>
        </div>

        {{-- Run Evaluation --}}
        <form action="{{ route('evaluation.run') }}" method="POST" class="flex items-center gap-3">
            @csrf
            <div class="flex items-center gap-2">
                <label for="k" class="text-sm text-gray-600">K =</label>
                <select name="k" id="k" class="py-2 px-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-400 shadow-sm">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2 rounded-xl font-semibold text-sm hover:from-green-600 hover:to-emerald-700 transition-all shadow-sm hover:shadow-md active:scale-95">
                Jalankan Evaluasi
            </button>
        </form>
    </div>

    {{-- Metrics Overview (if results exist) --}}
    @if($hasResults)
    @php
        $totalQueries = $evaluationQueries->count();
        $allPrecisions = [];
        $allAPs = [];
        foreach ($evaluationQueries as $eq) {
            $results = $eq->results->sortBy('rank');
            $expectedIds = $eq->expected_document_ids;
            $relevant = 0;
            $precisionAtRanks = [];
            foreach ($results as $r) {
                $isRel = in_array($r->retrieved_document_id, $expectedIds);
                if ($isRel) {
                    $relevant++;
                    $precisionAtRanks[] = $relevant / $r->rank;
                }
            }
            $totalRetrieved = $results->count();
            $precAtK = $totalRetrieved > 0 ? $relevant / $totalRetrieved : 0;
            $allPrecisions[] = $precAtK;
            $ap = !empty($precisionAtRanks) ? array_sum($precisionAtRanks) / count($expectedIds) : 0;
            $allAPs[] = $ap;
        }
        $avgPrecision = count($allPrecisions) > 0 ? array_sum($allPrecisions) / count($allPrecisions) : 0;
        $map = count($allAPs) > 0 ? array_sum($allAPs) / count($allAPs) : 0;
        $k = $evaluationQueries->first()?->results->count() ?? 10;
    @endphp

    <div class="grid sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Rata-rata Precision@{{ $k }}</div>
            <div class="text-3xl font-bold {{ $avgPrecision > 0.3 ? 'text-green-600' : ($avgPrecision > 0.15 ? 'text-amber-600' : 'text-red-500') }}">
                {{ number_format($avgPrecision, 4) }}
            </div>
            <div class="mt-2 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full {{ $avgPrecision > 0.3 ? 'bg-green-500' : ($avgPrecision > 0.15 ? 'bg-amber-500' : 'bg-red-500') }}" 
                     style="width: {{ $avgPrecision * 100 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">MAP (Mean Average Precision)</div>
            <div class="text-3xl font-bold {{ $map > 0.3 ? 'text-green-600' : ($map > 0.15 ? 'text-amber-600' : 'text-red-500') }}">
                {{ number_format($map, 4) }}
            </div>
            <div class="mt-2 w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full {{ $map > 0.3 ? 'bg-green-500' : ($map > 0.15 ? 'bg-amber-500' : 'bg-red-500') }}" 
                     style="width: {{ $map * 100 }}%"></div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Total Query Evaluasi</div>
            <div class="text-3xl font-bold text-gray-800">{{ $totalQueries }}</div>
            <div class="text-xs text-gray-500 mt-2">{{ $k }} dokumen per query</div>
        </div>
    </div>
    @endif

    {{-- Evaluation Queries Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-bold text-gray-700">Query Evaluasi ({{ $evaluationQueries->count() }} query)</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/50 text-xs text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3 text-left font-medium">No</th>
                        <th class="px-6 py-3 text-left font-medium">Query</th>
                        <th class="px-6 py-3 text-left font-medium">Expected Docs</th>
                        @if($hasResults)
                        <th class="px-6 py-3 text-left font-medium">Precision@K</th>
                        <th class="px-6 py-3 text-left font-medium">AP</th>
                        @endif
                        <th class="px-6 py-3 text-left font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($evaluationQueries as $i => $eq)
                    @php
                        $pAtK = 0;
                        $ap = 0;
                        if ($hasResults && $eq->results->isNotEmpty()) {
                            $results = $eq->results->sortBy('rank');
                            $expectedIds = $eq->expected_document_ids;
                            $relevant = 0;
                            $precisionAtRanks = [];
                            foreach ($results as $r) {
                                $isRel = in_array($r->retrieved_document_id, $expectedIds);
                                if ($isRel) {
                                    $relevant++;
                                    $precisionAtRanks[] = $relevant / $r->rank;
                                }
                            }
                            $totalRetrieved = $results->count();
                            $pAtK = $totalRetrieved > 0 ? $relevant / $totalRetrieved : 0;
                            $ap = !empty($precisionAtRanks) ? array_sum($precisionAtRanks) / count($expectedIds) : 0;
                        }
                    @endphp
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 text-gray-400 font-medium">{{ $i + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">{{ $eq->query }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1">
                                @foreach(array_slice($eq->expected_document_ids, 0, 5) as $docId)
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs bg-gray-100 text-gray-600">{{ $docId }}</span>
                                @endforeach
                                @if(count($eq->expected_document_ids) > 5)
                                <span class="text-xs text-gray-400">+{{ count($eq->expected_document_ids) - 5 }}</span>
                                @endif
                            </div>
                        </td>
                        @if($hasResults)
                        <td class="px-6 py-4">
                            <span class="font-semibold {{ $pAtK > 0.3 ? 'text-green-600' : ($pAtK > 0.1 ? 'text-amber-600' : 'text-red-500') }}">
                                {{ number_format($pAtK, 4) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-semibold {{ $ap > 0.3 ? 'text-green-600' : ($ap > 0.1 ? 'text-amber-600' : 'text-red-500') }}">
                                {{ number_format($ap, 4) }}
                            </span>
                        </td>
                        @endif
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($hasResults && $eq->results->isNotEmpty())
                                <a href="{{ route('evaluation.detail', $eq) }}" class="text-xs text-green-600 hover:text-green-700 font-medium">Detail</a>
                                @endif
                                <a href="{{ route('search.results', ['q' => $eq->query]) }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Cari</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- IR Concept Explanation --}}
    <div class="mt-8 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="text-sm font-bold text-gray-700 mb-4">Konsep Evaluasi IR</h3>
        <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-600">
            <div>
                <h4 class="font-semibold text-gray-800 mb-2">Precision@K</h4>
                <p class="leading-relaxed">Mengukur proporsi dokumen relevan dalam top-K hasil pencarian. <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">P@K = |Relevan ∩ Retrieved@K| / K</code></p>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800 mb-2">Mean Average Precision (MAP)</h4>
                <p class="leading-relaxed">Rata-rata dari Average Precision seluruh query. AP menghitung precision di setiap posisi dokumen relevan ditemukan. <code class="bg-gray-100 px-1.5 py-0.5 rounded text-xs">MAP = Σ AP(q) / |Q|</code></p>
            </div>
        </div>
    </div>
</div>
@endsection
