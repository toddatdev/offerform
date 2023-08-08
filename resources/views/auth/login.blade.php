<x-guest-layout>
    <x-slot name="title">
        Login to {{ config('app.name') }}
    </x-slot>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
            <div class="form-group">
                <x-label for="email" :value="__('Email:*')"/>
                <x-input id="email" class="autocomplete-email" type="email" name="email" :value="old('email')" required
                         autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password:*')"/>
                <x-input id="password"
                         type="password"
                         name="password"
                         required autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
{{--            <div class="mb-3 mt-2">--}}
{{--                <div class="form-check">--}}
{{--                    <input class="form-check-input" type="checkbox" name="remember" id="remember">--}}

{{--                    <label class="form-check-label" for="remember">--}}
{{--                        {{ __('Remember Me') }}--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="mb-0 mt-4">
                <x-button class="btn btn-primary">
                    {{ __('Log in') }}
                </x-button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            <div class="d-flex mt-3 justify-content-center">
                <p class="text-muted mb-0">Don't have an account?</p>
                <a class="text-decoration-none outline-none border-0 ms-1" href="{{ route('register') }}">
                    {{ __('Create a free account') }}
                </a>
            </div>

        </form>
        <h5 class="text-center text-muted my-2 fw-bold text-uppercase">OR</h5>
        <h5 class="text-center text-muted mt-2 mb-3 text-uppercase">Sign in with</h5>
        <div class="row">
            <div class="col d-grid">
                <a href="{{ route('third-party.provider.login', 'google') }}" class="btn btn-lg text-white gmail"><i class="fa fa-google me-2"></i>Google</a>
            </div>
            <div class="col d-grid">
                <a href="{{ route('third-party.provider.login', 'facebook') }}" class="btn btn-lg text-white facebook"><i class="fa fa-facebook me-2"></i>Facebook</a>
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
