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
            {{-- Subtitle --}}
            <p class="text-sm font-medium text-green-700/80 tracking-wide mb-6">Information Retrieval System — TF-IDF & Cosine Similarity</p>

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
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    Query Terpopuler
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
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Pencarian Terakhir
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
                    {{ ucfirst($cat) }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ============================================================= --}}
    {{-- INFORMATION SECTION --}}
    {{-- ============================================================= --}}
    <div class="bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

            {{-- Section Header --}}
            <div class="text-center mb-16">
                <p class="text-sm font-semibold text-green-600 tracking-wider uppercase mb-3">Tentang Sistem</p>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Eksplorasi Informasi dengan Cepat & Presisi</h2>
                <p class="mt-4 text-base text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Mesin pencari berbasis Information Retrieval yang menggunakan pemodelan vektor TF-IDF dan pengukuran Cosine Similarity untuk menemukan dokumen paling relevan dari koleksi menu makanan bergizi.
                </p>
            </div>

            {{-- About the Search System — Feature Cards --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Pencarian Berbasis Relevansi</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Sistem tidak sekadar mencocokkan kata, tetapi menghitung bobot setiap term menggunakan TF-IDF untuk menemukan dokumen yang benar-benar relevan dengan kebutuhan pengguna.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Perankingan Otomatis</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Hasil pencarian diurutkan secara otomatis berdasarkan skor Cosine Similarity, sehingga dokumen paling sesuai selalu tampil di urutan teratas.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Pemrosesan Cepat</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Matriks TF-IDF yang sudah di-precompute memungkinkan pencarian real-time tanpa perlu memproses ulang seluruh dokumen di setiap query baru.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Preprocessing Bahasa Indonesia</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Teks diproses secara khusus untuk Bahasa Indonesia: case folding, tokenisasi, penghapusan stopword, dan stemming dengan algoritma Nazief-Adriani via Sastrawi.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Data Terkurasi</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Seluruh data menu makanan bergizi dikurasi untuk mendukung Program Makan Bergizi Gratis (MBG), lengkap dengan informasi nutrisi yang terverifikasi.</p>
                </div>
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-100 transition-colors">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-gray-800 mb-2">Evaluasi Terukur</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Performa sistem diukur menggunakan metrik standar IR: Precision@K dan Mean Average Precision (MAP) untuk memastikan kualitas hasil pencarian.</p>
                </div>
            </div>

            {{-- ========================= --}}
            {{-- Panduan Cara Penggunaan --}}
            {{-- ========================= --}}
            <div class="mb-20">
                <div class="text-center mb-12">
                    <p class="text-sm font-semibold text-green-600 tracking-wider uppercase mb-3">Panduan</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Cara Menggunakan</h2>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach(config('sources.usage_steps') as $step)
                    <div class="relative bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300">
                        <div class="text-4xl font-extrabold text-green-500/15 leading-none mb-3">{{ $step['number'] }}</div>
                        <h3 class="text-base font-bold text-gray-800 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $step['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ========================= --}}
            {{-- Formula & Metode --}}
            {{-- ========================= --}}
            <div class="mb-20">
                <div class="text-center mb-12">
                    <p class="text-sm font-semibold text-green-600 tracking-wider uppercase mb-3">Metodologi</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Formula & Metode yang Digunakan</h2>
                    <p class="mt-3 text-sm text-gray-500 max-w-xl mx-auto">Dua metode matematika utama yang mendasari mesin pencarian ini, berdasarkan teori <em>Vector Space Model</em> oleh Salton et al. (1975).</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    {{-- TF-IDF Card --}}
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white">TF-IDF</h3>
                            <p class="text-sm text-green-100 mt-0.5">Term Frequency–Inverse Document Frequency</p>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-3 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    Mengukur tingkat kepentingan suatu kata (term) terhadap sebuah dokumen dalam konteks seluruh koleksi dokumen.
                                </li>
                                <li class="flex items-start gap-3 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    Menentukan bobot kata berdasarkan frekuensi kemunculan di dokumen (TF) dan kelangkaan di seluruh koleksi (IDF).
                                </li>
                                <li class="flex items-start gap-3 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    Kata yang sering muncul di satu dokumen tetapi jarang di dokumen lain mendapat bobot tinggi.
                                </li>
                            </ul>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-medium">Formula</div>
                                <div class="text-center">
                                    <code class="text-base font-mono font-semibold text-gray-800">W(d, t) = TF(d, t) × log(N / DF(t))</code>
                                </div>
                                <div class="mt-3 space-y-1 text-xs text-gray-500">
                                    <p><strong class="text-gray-600">TF(d, t)</strong> — Frekuensi term <em>t</em> dalam dokumen <em>d</em></p>
                                    <p><strong class="text-gray-600">DF(t)</strong> — Jumlah dokumen yang mengandung term <em>t</em></p>
                                    <p><strong class="text-gray-600">N</strong> — Total dokumen dalam koleksi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Cosine Similarity Card --}}
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                            <h3 class="text-lg font-bold text-white">Cosine Similarity</h3>
                            <p class="text-sm text-emerald-100 mt-0.5">Pengukuran Kemiripan Vektor</p>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-3 mb-6">
                                <li class="flex items-start gap-3 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    Mengukur tingkat kemiripan antara vektor query dan vektor dokumen berdasarkan sudut di antara keduanya.
                                </li>
                                <li class="flex items-start gap-3 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    Menghasilkan skor antara 0 (tidak mirip) hingga 1 (identik) untuk menentukan relevansi hasil pencarian.
                                </li>
                                <li class="flex items-start gap-3 text-sm text-gray-600">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-1.5 flex-shrink-0"></span>
                                    Tidak terpengaruh oleh panjang dokumen karena mengukur arah vektor, bukan magnitude.
                                </li>
                            </ul>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <div class="text-xs text-gray-400 uppercase tracking-wider mb-2 font-medium">Formula</div>
                                <div class="text-center">
                                    <code class="text-base font-mono font-semibold text-gray-800">Similarity(Q, D) = (Q · D) / (||Q|| × ||D||)</code>
                                </div>
                                <div class="mt-3 space-y-1 text-xs text-gray-500">
                                    <p><strong class="text-gray-600">Q</strong> — Vektor query pengguna</p>
                                    <p><strong class="text-gray-600">D</strong> — Vektor dokumen</p>
                                    <p><strong class="text-gray-600">Q · D</strong> — Dot product antara vektor Q dan D</p>
                                    <p><strong class="text-gray-600">||Q||, ||D||</strong> — Magnitude (norma) masing-masing vektor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================= --}}
            {{-- Data Pipeline / Alur Sistem --}}
            {{-- ========================= --}}
            <div class="mb-20">
                <div class="text-center mb-12">
                    <p class="text-sm font-semibold text-green-600 tracking-wider uppercase mb-3">Arsitektur</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Alur Data Sistem (Data Pipeline)</h2>
                    <p class="mt-3 text-sm text-gray-500 max-w-xl mx-auto">Proses pengolahan data dari awal hingga menampilkan hasil pencarian, mengikuti arsitektur standar Information Retrieval.</p>
                </div>

                <div class="relative">
                    {{-- Pipeline Steps --}}
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(config('sources.pipeline') as $stage)
                        <div class="relative bg-white/70 backdrop-blur-sm rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group">
                            {{-- Step Number --}}
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center text-white text-xs font-bold shadow-sm">
                                    {{ $stage['step'] }}
                                </div>
                                <h3 class="text-base font-bold text-gray-800">{{ $stage['title'] }}</h3>
                            </div>
                            {{-- Connector Arrow (except last in row) --}}
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $stage['description'] }}</p>
                        </div>
                        @endforeach
                    </div>

                    {{-- Flow Indicator --}}
                    <div class="mt-8 flex items-center justify-center gap-2">
                        @foreach(config('sources.pipeline') as $i => $stage)
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2.5 py-1 rounded-lg border border-green-100">{{ $stage['title'] }}</span>
                                @if($i < count(config('sources.pipeline')) - 1)
                                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ========================= --}}
            {{-- Data Sources & References --}}
            {{-- ========================= --}}
            <div>
                <div class="text-center mb-12">
                    <p class="text-sm font-semibold text-green-600 tracking-wider uppercase mb-3">Kredibilitas</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Sumber Data & Referensi</h2>
                    <p class="mt-3 text-sm text-gray-500 max-w-xl mx-auto">Seluruh informasi dan metodologi yang digunakan dalam sistem ini berasal dari sumber yang terpercaya dan terverifikasi.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach(config('sources.sources') as $source)
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md hover:border-green-200/50 transition-all duration-300 group flex flex-col">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-green-700 transition-colors leading-snug">{{ $source['name'] }}</h4>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium flex-shrink-0
                                {{ $source['category'] === 'dataset' ? 'bg-blue-50 text-blue-700 border border-blue-100' : '' }}
                                {{ $source['category'] === 'library' ? 'bg-purple-50 text-purple-700 border border-purple-100' : '' }}
                                {{ $source['category'] === 'research' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                {{ $source['category'] === 'reference' ? 'bg-gray-50 text-gray-600 border border-gray-200' : '' }}
                                {{ $source['category'] === 'tool' ? 'bg-teal-50 text-teal-700 border border-teal-100' : '' }}
                            ">
                                {{ config('sources.category_labels')[$source['category']] ?? $source['category'] }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed flex-1 mb-3">{{ $source['description'] }}</p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50 text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full {{ $source['status'] === 'active' ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                <span class="text-gray-400">{{ $source['status'] === 'active' ? 'Aktif' : 'Tidak Aktif' }}</span>
                            </div>
                            @if($source['url'])
                            <a href="{{ $source['url'] }}" target="_blank" rel="noopener noreferrer" class="text-green-600 hover:text-green-700 font-medium flex items-center gap-1 transition-colors">
                                Sumber
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            @else
                            <span class="text-gray-400">Data Internal</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    {{-- END INFORMATION SECTION --}}
</div>
@endsection
