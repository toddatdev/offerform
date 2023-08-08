<x-guest-layout>
    <x-slot name="title">
        Verify Email
    </x-slot>
    <x-auth-card>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="d-flex">
                    <x-button class="btn-primary mx-auto">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="d-flex mt-2">
                    <button type="submit" class="btn btn-link mx-auto">
                        {{ __('Log Out') }}
                    </button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
