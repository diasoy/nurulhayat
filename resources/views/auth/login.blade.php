<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Show Password -->
        <div class="block mt-4">
            <label for="show_password" class="inline-flex items-center">
                <input id="show_password" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary shadow-sm focus:ring-primary dark:focus:ring-secondary dark:focus:ring-offset-gray-800" onchange="togglePassword()">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Show password') }}</span>
            </label>
        </div>

        <!-- Remember Me (hidden) -->
        <input id="remember_me" type="hidden" name="remember" value="0">

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('register'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-secondary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                {{ __("Don't have account?") }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Forgot Password link (moved to below the button)
        <div class="text-center mt-4">
            @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-primary dark:hover:text-secondary focus:outline-none focus:underline" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div> -->
    </form>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</x-guest-layout>