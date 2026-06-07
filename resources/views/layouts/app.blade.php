<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <title>{{ config('app.name', 'e-Surat DPMPTSP') }} | @isset($header){{ strip_tags($header) }}@else Dashboard @endisset</title>
        <meta name="description" content="Sistem Informasi Manajemen Surat DPMPTSP - Platform pengelolaan surat masuk, surat keluar, arsip, dan validasi surat secara digital.">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <!-- Mobile Overlay -->
        <div class="mobile-overlay" id="mobileOverlay" onclick="closeSidebar()"></div>

        <!-- Sidebar (Navy Blue) -->
        @include('layouts.navigation')

        <!-- Main Wrapper -->
        <div class="main-wrapper">

            <!-- Top Header (White) -->
            <header class="top-header">
                <div class="flex items-center gap-4 w-full">

                    <!-- Mobile Hamburger -->
                    <button onclick="openSidebar()" class="md:hidden text-slate-500 hover:text-slate-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <!-- Breadcrumb / Page Title -->
                    @isset($header)
                        <div class="flex items-center gap-2">
                            <span class="text-slate-400 text-sm hidden sm:block">e-Surat</span>
                            <svg class="w-4 h-4 text-slate-300 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <h1 class="text-sm font-semibold text-slate-700">{{ $header }}</h1>
                        </div>
                    @endisset

                    <!-- Right: Clock + User -->
                    <div class="ml-auto flex items-center gap-4">

                        <!-- Live Clock -->
                        <div class="hidden lg:flex items-center gap-2 text-xs text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span id="currentTime"></span>
                        </div>

                        <!-- User Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl border border-slate-200 hover:border-blue-200 hover:bg-blue-50 transition-all">
                                <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                                     style="background: linear-gradient(135deg, #1e40af, #3b82f6);">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-xs font-semibold text-slate-700 leading-tight">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] text-slate-400 leading-tight capitalize">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                                </div>
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-44 bg-white rounded-xl border border-slate-200 shadow-lg z-50 overflow-hidden">
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-2 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 transition-colors">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profil Saya
                                </a>
                                <hr class="border-slate-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-2 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="page-content animate-fade-up">
                {{ $slot }}
            </main>

        </div>

        <script>
            function openSidebar() {
                document.querySelector('.sidebar').classList.add('open');
                document.getElementById('mobileOverlay').classList.add('open');
            }
            function closeSidebar() {
                document.querySelector('.sidebar').classList.remove('open');
                document.getElementById('mobileOverlay').classList.remove('open');
            }
            function updateTime() {
                const el = document.getElementById('currentTime');
                if (el) {
                    const now = new Date();
                    el.textContent = now.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' })
                                   + ' · ' + now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                }
            }
            updateTime();
            setInterval(updateTime, 10000);
        </script>
    </body>
</html>
