@extends('layouts.app')

@section('title', "{$food->title} — STKI MBG")

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('search.index') }}" class="hover:text-green-600 transition-colors">Beranda</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('food.index') }}" class="hover:text-green-600 transition-colors">Dataset</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700 font-medium">{{ Str::limit($food->title, 30) }}</span>
    </nav>

    {{-- Main Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 sm:px-8 py-8">
            <div class="flex items-start justify-between">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm mb-3">
                        {{ ucfirst($food->category) }}
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-bold text-white">{{ $food->title }}</h1>
                </div>
                <div class="text-right">
                    <div class="text-xs text-green-100">ID Dokumen</div>
                    <div class="text-2xl font-bold text-white/80">#{{ $food->id }}</div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-6 sm:p-8 space-y-8">
            {{-- Description --}}
            <div>
                <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="w-1 h-4 bg-green-500 rounded-full"></span>
                    Deskripsi
                </h2>
                <p class="text-gray-600 leading-relaxed text-sm">{{ $food->description }}</p>
            </div>

            {{-- Nutrition Info --}}
            <div>
                <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="w-1 h-4 bg-emerald-500 rounded-full"></span>
                    Informasi Nutrisi
                </h2>
                <div class="bg-green-50/50 rounded-xl p-5 border border-green-100/50">
                    <div class="flex flex-wrap gap-3">
                        @foreach(explode('|', $food->nutrition_info) as $info)
                        @php
                            $parts = explode(':', trim($info));
                            $label = trim($parts[0] ?? '');
                            $value = trim($parts[1] ?? '');
                        @endphp
                        @if($label && $value)
                        <div class="bg-white rounded-xl px-4 py-3 border border-green-100/80 shadow-sm flex-1 min-w-[140px]">
                            <div class="text-xs text-gray-500">{{ $label }}</div>
                            <div class="text-sm font-bold text-gray-800 mt-0.5">{{ $value }}</div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Metadata --}}
            <div>
                <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <span class="w-1 h-4 bg-gray-400 rounded-full"></span>
                    Metadata Dokumen
                </h2>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-xs text-gray-500">Kategori</div>
                        <div class="font-semibold text-gray-800 mt-1">{{ ucfirst($food->category) }}</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-xs text-gray-500">ID</div>
                        <div class="font-semibold text-gray-800 mt-1">{{ $food->id }}</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-xs text-gray-500">Dibuat</div>
                        <div class="font-semibold text-gray-800 mt-1">{{ $food->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-xs text-gray-500">Diperbarui</div>
                        <div class="font-semibold text-gray-800 mt-1">{{ $food->updated_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Back Button --}}
    <div class="mt-6 flex items-center gap-3">
        <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <a href="{{ route('food.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition-all shadow-sm">
            Lihat Semua Dataset
        </a>
    </div>
</div>
@endsection
