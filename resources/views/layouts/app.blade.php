<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Temu Kembali Informasi Menu Makanan Bergizi untuk Program MBG (Makan Bergizi Gratis)">
    <title>@yield('title', 'STKI MBG - Sistem Temu Kembali Informasi Makanan Bergizi')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col">
    {{-- Navigation --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('search.index') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md shadow-green-200 group-hover:shadow-lg group-hover:shadow-green-300 transition-all duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold text-gray-900">STKI</span>
                        <span class="text-lg font-light text-green-600"> MBG</span>
                    </div>
                </a>

                {{-- Navigation Links --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('search.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('search.index') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Pencarian
                    </a>
                    <a href="{{ route('food.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('food.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Dataset
                    </a>
                    <a href="{{ route('evaluation.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('evaluation.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Evaluasi
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white pb-3">
            <div class="px-4 pt-2 space-y-1">
                <a href="{{ route('search.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Pencarian
                </a>
                <a href="{{ route('food.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Dataset
                </a>
                <a href="{{ route('evaluation.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    Evaluasi
                </a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <svg class="w-4 h-4 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Enhanced Footer --}}
    <footer class="bg-white border-t border-gray-200/60 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            {{-- Footer Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                {{-- Data Sources (from database) --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Data Sources</h4>
                    @if(isset($activeDatasets) && $activeDatasets->isNotEmpty())
                    <ul class="space-y-2.5">
                        @foreach($activeDatasets as $ds)
                        <li class="flex items-start gap-2">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></span>
                            <div>
                                <span class="text-sm font-medium text-gray-700">{{ $ds->name }}</span>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $ds->total_documents }} documents · {{ $ds->provider }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('food.index') }}" class="text-xs font-medium text-green-600 hover:text-green-700 transition-colors inline-flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            View Dataset
                        </a>
                    </div>
                    @else
                    <p class="text-xs text-gray-400">No active datasets.</p>
                    @endif
                </div>

                {{-- Powered By --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Powered By</h4>
                    <ul class="space-y-2.5">
                        @foreach(config('sources.technologies') as $tech)
                        <li class="flex items-start gap-2">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></span>
                            <div>
                                <span class="text-sm font-medium text-gray-700">{{ $tech['name'] }}</span>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $tech['description'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- System Info --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">System Info</h4>
                    <div class="space-y-3">
                        <div>
                            <span class="text-xs text-gray-400">Sistem</span>
                            <p class="text-sm font-medium text-gray-700">STKI MBG — Sistem Temu Kembali Informasi</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Metode</span>
                            <p class="text-sm text-gray-600">TF-IDF + Cosine Similarity</p>
                        </div>
                        <div>
                            <span class="text-xs text-gray-400">Last Indexed</span>
                            @if(isset($activeDatasets) && $activeDatasets->isNotEmpty())
                            <p class="text-sm text-gray-600">{{ $activeDatasets->max('last_indexed_at')?->translatedFormat('d F Y, H:i') ?? '-' }} WIB</p>
                            @else
                            <p class="text-sm text-gray-600">{{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="text-center sm:text-left">
                    <p class="text-sm font-semibold text-gray-700">STKI MBG — Sistem Temu Kembali Informasi</p>
                    <p class="text-xs text-gray-500 mt-0.5">Menu Makanan Bergizi untuk Program Makan Bergizi Gratis</p>
                </div>
                <div class="flex items-center gap-4 text-xs text-gray-400">
                    <span>TF-IDF</span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span>Cosine Similarity</span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span>Sastrawi Stemmer</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
