<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('Security Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-gray-200 text-blue-600 focus:ring-0 w-4 h-4 transition-colors" name="remember">
                <span class="ms-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest group-hover:text-gray-600 transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-[10px] font-bold text-blue-600 hover:text-blue-700 uppercase tracking-widest transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
        </div>

        <div class="mt-10">
            <x-primary-button class="w-full justify-center">
                {{ __('Login to Dashboard') }}
            </x-primary-button>
        </div>
        
        @if (Route::has('register'))
            <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Belum punya akun?</p>
                <a href="{{ route('register') }}" class="text-[10px] font-bold text-gray-900 hover:text-blue-600 uppercase tracking-widest transition-colors">
                    Daftar Sekarang &rarr;
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
