<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
                <x-button>
                    <a href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                  </x-button>

            </div>
            <div class="mt-4 text-center">
                <a href="/google-auth/redirect" class="bg-yellow-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fab fa-google"></i> Iniciar con Google
                </a>
            </div>

            <div class="mt-4 text-center">
                <a href="github-auth/redirect"class="bg-yellow-500 hover:bg-black-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fab fa-github"></i> Iniciar  con Github
                </a>
            </div>

            <div class="mt-4 text-center">
                <a href=" " class="bg-yellow-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fab fa-google"></i> Iniciar con Discord
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
