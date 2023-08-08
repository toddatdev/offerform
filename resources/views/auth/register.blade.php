<x-guest-layout>
    @php
        $as = request()->get('as', 'agent');
        $name = request()->get('name');
        $email = request()->get('email');
        $code = request()->get('code');
    @endphp
    <x-slot name="title">
        Join Offer Form as  @if($as === 'agent') an individual agent @else a team or brokerage @endif
    </x-slot>
    <x-auth-card>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="as" value="{{ $as }}"/>
            @if($as === 'agent')
                <div class="row mb-3">
                    <div class="form-group col">
                        <x-label for="first_name" class="">{{ __('First Name') }}</x-label>
                        <x-input id="first_name" type="text" name="first_name"
                                 :value="old('first_name', $name)" required autocomplete="first_name" autofocus/>
                    </div>

                    <div class="form-group col">
                        <x-label for="last_name" class="">{{ __('Last Name') }}</x-label>
                        <x-input id="last_name" type="text" name="last_name"
                                 :value="old('last_name')" required autocomplete="last_name"/>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <x-label for="email" class="">{{ __('Email Address') }}</x-label>
                    <x-input id="email" type="email" name="email" class="autocomplete-email"
                             :value="old('email', $email)" required autocomplete="email"/>

                </div>
            @else
                <div class="form-group mb-3">
                    <x-label for="brokerage_or_team_name" class="">{{ __('Brokerage/Team Name') }}</x-label>
                    <x-input id="brokerage_or_team_name" type="text" name="brokerage_or_team_name"
                             :value="old('brokerage_or_team_name')" required autofocus/>
                </div>

                <div class="form-group mb-3">
                    <x-label for="company_admin_name" class="">{{ __('Company Admin Name') }}</x-label>
                    <x-input id="company_admin_name" type="text" name="company_admin_name"
                             :value="old('company_admin_name')" required/>
                </div>
                <div class="form-group mb-3">
                    <x-label for="company_admin_email" class="">{{ __('Company Admin Email') }}</x-label>
                    <x-input id="company_admin_email" type="text" name="company_admin_email" class="autocomplete-email"
                             :value="old('company_admin_email')" required/>
                </div>
                <div class="form-group mb-3">
                    <x-label for="company_admin_phone" class="">{{ __('Company Admin Phone') }}</x-label>
                    <x-input id="company_admin_phone" type="phone" name="company_admin_phone"
                             :value="old('company_admin_phone')" required/>
                </div>
                <div class="form-group mb-3">
                    <x-label for="no_of_agents" class="">{{ __('No. of Agents') }}</x-label>
                    <x-input id="no_of_agents" type="number" name="no_of_agents"
                             :value="old('no_of_agents')" required/>
                </div>
                <div class="form-group mb-3">
                    <x-label for="your_position_with_company" class="">{{ __('Your Position with Company') }}</x-label>
                    <x-input id="your_position_with_company" type="text" name="your_position_with_company"
                             :value="old('your_position_with_company')" required/>
                </div>
            @endif
            <div class="form-group mb-3">
                <x-label for="password" class="">{{ __('Password') }}</x-label>
                <x-input id="password" type="password"
                         name="password" required autocomplete="new-password"/>
            </div>

            <div class="form-group mb-3">
                <x-label for="password-confirm" class="">{{ __('Confirm Password') }}</x-label>
                <x-input id="password-confirm" type="password" name="password_confirmation"
                         required autocomplete="new-password"/>
            </div>

            @if($as === 'agent')

                <div class="form-group mb-3">
                    <x-label for="partner_key_code">{{ __('Partner Key Code') }} <span class="text-muted">(Optional)</span></x-label>
                    <x-input id="partner_key_code" type="text"
                             name="partner_key_code" autocomplete="partner_key_code"/>
                </div>

                <div class="form-group mb-3">
                    <x-label for="brokerage_or_team_code">{{ __('Brokerage/Team Code') }} <span class="text-muted">(Optional)</span></x-label>
                    <x-input id="brokerage_or_team_code" type="text"
                             :value="old('brokerage_or_team_code', $code)"
                             name="brokerage_or_team_code" autocomplete="brokerage_or_team_code"/>
                </div>
            @endif
            <!-- Agree with term and conditions -->
            <div class="mb-3 mt-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="terms" id="terms">

                    <label class="form-check-label" for="terms">
                        I agree to <a href="{{route('guest.terms-and-conditions')}}" target="_blank">Terms &amp; Service</a>
                    </label>
                </div>
                <x-jet-input-error for="terms"/>
            </div>

            <div class="d-flex mb-0">
                <div class="ms-auto">
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </div>

            <p class="text-center mt-3">
                Register as @if($as === 'agent') a team or brokerage @else an individual agent @endif
                <a href="{{ route('register', ['as' => $as === 'agent' ? 'team' : 'agent']) }}">
                    {{ __('click here') }}.
                </a>
            </p>


            <h5 class="text-center text-muted my-3 fw-bold text-uppercase">OR</h5>
            <h5 class="text-center text-muted mt-2 mb-3 text-uppercase">Sign up with</h5>
            <div class="row">
                <div class="col d-grid">
                    <a href="{{ route('third-party.provider.login', 'google') }}" class="btn btn-lg text-white gmail"><i class="fa fa-google me-2"></i>Google</a>
                </div>
                <div class="col d-grid">
                    <a href="{{ route('third-party.provider.login', 'facebook') }}" class="btn btn-lg text-white facebook"><i class="fa fa-facebook me-2"></i>Facebook</a>
                </div>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>
