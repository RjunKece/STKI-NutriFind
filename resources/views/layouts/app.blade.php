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
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('search.index') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        🔍 Pencarian
                    </a>
                    <a href="{{ route('food.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('food.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        📋 Dataset
                    </a>
                    <a href="{{ route('evaluation.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('evaluation.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                        📊 Evaluasi
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
                <a href="{{ route('search.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">🔍 Pencarian</a>
                <a href="{{ route('food.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">📋 Dataset</a>
                <a href="{{ route('evaluation.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100">📊 Evaluasi</a>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <span>✅</span> {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
            <span>⚠️</span> {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200/60 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-center md:text-left">
                    <p class="text-sm font-semibold text-gray-700">STKI MBG — Sistem Temu Kembali Informasi</p>
                    <p class="text-xs text-gray-500 mt-1">Menu Makanan Bergizi untuk Program Makan Bergizi Gratis</p>
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
