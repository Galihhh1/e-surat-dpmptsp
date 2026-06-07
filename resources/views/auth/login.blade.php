<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert-success mb-4">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="form-input" placeholder="nama@dpmptsp.go.id"
                   required autofocus autocomplete="username">
            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password"
                   class="form-input" placeholder="••••••••"
                   required autocomplete="current-password">
            @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-slate-300 bg-white text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-slate-500">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-blue-600 hover:text-blue-500 transition-colors">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-full justify-center mt-2" style="padding: 0.7rem 1rem;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
            </svg>
            Masuk
        </button>
    </form>
</x-guest-layout>
