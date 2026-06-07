<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'e-Surat DPMPTSP') }} — Masuk</title>
        <meta name="description" content="Login ke Sistem Informasi Manajemen Surat DPMPTSP">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .login-page {
                min-height: 100vh;
                display: flex;
                background: #f0f5fb;
                position: relative;
                overflow: hidden;
            }
            /* Left Panel: Navy Blue */
            .login-left {
                display: none;
                width: 45%;
                background: linear-gradient(145deg, #1e3a5f 0%, #162d4a 60%, #0f1e33 100%);
                position: relative;
                overflow: hidden;
            }
            @media (min-width: 1024px) { .login-left { display: flex; flex-direction: column; justify-content: center; padding: 3rem; } }
            .login-left::before {
                content: '';
                position: absolute;
                inset: 0;
                background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
                background-size: 28px 28px;
            }
            .login-left::after {
                content: '';
                position: absolute;
                bottom: -60px; right: -60px;
                width: 300px; height: 300px;
                border-radius: 50%;
                background: rgba(59,130,246,0.12);
            }
            .login-left-top {
                position: absolute;
                top: -80px; left: -80px;
                width: 280px; height: 280px;
                border-radius: 50%;
                background: rgba(30,64,175,0.15);
            }
            /* Right Panel: White */
            .login-right {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }
            .login-card {
                width: 100%;
                max-width: 400px;
                background: #ffffff;
                border-radius: 16px;
                border: 1px solid #e2e8f0;
                box-shadow: 0 10px 40px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.04);
                padding: 2.5rem 2rem;
                position: relative;
            }
            .login-card::before {
                content: '';
                position: absolute;
                top: 0; left: 2rem; right: 2rem;
                height: 3px;
                background: linear-gradient(90deg, #1e40af, #3b82f6, #7c3aed);
                border-radius: 0 0 4px 4px;
            }
        </style>
    </head>
    <body>
        <div class="login-page">

            <!-- Left: Branding (Desktop Only) -->
            <div class="login-left">
                <div class="login-left-top"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <img src="{{ asset('images/logo.jpg') }}" alt="DPMPTSP Lampung" class="w-12 h-12 rounded-xl object-cover border border-white/20">
                        <div>
                            <p class="text-white font-bold text-lg leading-tight">e-Surat</p>
                            <p class="text-xs leading-tight" style="color: rgba(255,255,255,0.5);">DPMPTSP Lampung</p>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-3 leading-snug">
                        Sistem Manajemen<br>Surat Digital
                    </h2>
                    <p style="color: rgba(255,255,255,0.55);" class="text-sm leading-relaxed mb-8">
                        Platform terpadu untuk pengelolaan surat masuk, surat keluar, arsip, dan validasi dokumen secara digital.
                    </p>
                    <div class="space-y-3">
                        @foreach(['Kelola surat masuk & keluar', 'Disposisi dan tracking status', 'Arsip digital terstruktur', 'Validasi keaslian dokumen'] as $f)
                        <div class="flex items-center gap-2.5">
                            <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0"
                                 style="background: rgba(255,255,255,0.15);">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-sm" style="color: rgba(255,255,255,0.7);">{{ $f }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-8 flex justify-center">
                        <img src="{{ asset('images/dpmptsp_hero.jpg') }}" alt="Kantor DPMPTSP" 
                             class="w-full max-w-md h-auto rounded-xl shadow-2xl border border-white/10 opacity-95 hover:opacity-100 transition-all duration-300">
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="login-right">
                <div class="login-card animate-fade-up">
                    <div class="text-center mb-7">
                        <!-- Mobile logo only -->
                        <div class="lg:hidden flex items-center justify-center gap-2 mb-4">
                            <img src="{{ asset('images/logo.jpg') }}" alt="DPMPTSP Lampung" class="w-9 h-9 rounded-lg object-cover">
                            <span class="font-bold text-slate-800">e-Surat DPMPTSP Lampung</span>
                        </div>
                        <h1 class="text-xl font-bold text-slate-800">Selamat Datang</h1>
                        <p class="text-sm text-slate-400 mt-1">Masuk ke akun Anda</p>
                    </div>

                    {{ $slot }}

                    <p class="text-center text-xs text-slate-400 mt-6">
                        &copy; {{ date('Y') }} DPMPTSP — Sistem Surat Digital
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>
