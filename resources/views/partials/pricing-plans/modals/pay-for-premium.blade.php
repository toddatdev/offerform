<!-- Modal -->
<form
    class="modal hideableModal fade"
    id="upgradeTo{{ ucfirst($type) }}{{ ucfirst($per) }}lyPremiumModal"
    tabindex="-1"
    aria-labelledby="upgradeTo{{ ucfirst($type) }}{{ ucfirst($per) }}lyPremiumModalLabel"
    aria-hidden="true"
    x-data="{
        stripe{{ ucfirst($type) }}{{ ucfirst($per) }}: null,
        stripe{{ ucfirst($type) }}{{ ucfirst($per) }}CardElements: null,
        cardNumber{{ ucfirst($type) }}{{ ucfirst($per) }}El: null,
        cardExpiry{{ ucfirst($type) }}{{ ucfirst($per) }}El: null,
        cardCVC{{ ucfirst($type) }}{{ ucfirst($per) }}El: null,
        element{{ ucfirst($type) }}{{ ucfirst($per) }}Styles : {
            base: {
                color: '#32325D',
                fontWeight: 500,
                fontSize: '18px',
                fontSmoothing: 'antialiased',
            }
        },
        element{{ ucfirst($type) }}{{ ucfirst($per) }}Classes : {
{{--            input: 'border rounded p-3',--}}
    {{--            focus: 'form-control form-control-lg',--}}
    {{--            empty: 'form-control form-control-lg',--}}
    {{--            invalid: 'is-invalid',--}}
        }
    }"
    x-init="
        stripe{{ ucfirst($type) }}{{ ucfirst($per) }} = await window.loadStripe('{{ config('cashier.key') }}');
        stripe{{ ucfirst($type) }}{{ ucfirst($per) }}Elements = stripe{{ ucfirst($type) }}{{ ucfirst($per) }}.elements();

        cardNumber{{ ucfirst($type) }}{{ ucfirst($per) }}El = stripe{{ ucfirst($type) }}{{ ucfirst($per) }}Elements.create('cardNumber', {style: element{{ ucfirst($type) }}{{ ucfirst($per) }}Styles, classes: element{{ ucfirst($type) }}{{ ucfirst($per) }}Classes});
        cardExpiry{{ ucfirst($type) }}{{ ucfirst($per) }}El = stripe{{ ucfirst($type) }}{{ ucfirst($per) }}Elements.create('cardExpiry', {style: element{{ ucfirst($type) }}{{ ucfirst($per) }}Styles, classes: element{{ ucfirst($type) }}{{ ucfirst($per) }}Classes});
        cardCVC{{ ucfirst($type) }}{{ ucfirst($per) }}El = stripe{{ ucfirst($type) }}{{ ucfirst($per) }}Elements.create('cardCvc', {style: element{{ ucfirst($type) }}{{ ucfirst($per) }}Styles, classes: element{{ ucfirst($type) }}{{ ucfirst($per) }}Classes});


        cardNumber{{ ucfirst($type) }}{{ ucfirst($per) }}El.mount('#card-number-element-{{ $type }}-{{ $per }}');
        cardExpiry{{ ucfirst($type) }}{{ ucfirst($per) }}El.mount('#card-expiry-element-{{ $type }}-{{ $per }}');
        cardCVC{{ ucfirst($type) }}{{ ucfirst($per) }}El.mount('#card-cvc-element-{{ $type }}-{{ $per }}');
    "
    wire:submit.prevent="upgradeToPremium"
    wire:ignore
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-2">
            <div class="modal-header border-0 text-white d-block d-lg-none  ">
                <button type="button" class="btn-modal btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <h5 class="text-primary-light fw-bold">
                        @if($type === 'team')
                            Premium Team / Brokerage Plan
                        @else
                            Billing
                        @endif
                    </h5>

                    <h6 class="fw-bold">Upgrade to Premium

                        <i class="fa fa-question-circle ms-2 fs-22 p-2"
                           data-bs-toggle="popover" data-bs-trigger="hover"
                           data-bs-content="Upgrading to premium gives you the ability to unlock referral partner questions."
                           aria-hidden="true">
                        </i>

                    </h6>
                </div>
                <hr >
                {{--       If type is team then show team related information as well         --}}
                @if($type === 'team')
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <img class="img-fluid" src="{{asset('img/dash/settings/premium-img.png')}}" alt="">
                        </div>
                        <div class="col-12 col-lg-4">
                            <p class="fw-bold text-primary-light">Pricing per user</p>
                            <p class="fw-bold text-primary-light">2-25 $15 <span
                                    class="text-light text-dark">per month per user</span></p>
                            <p class="fw-bold text-primary-light"> 25+ <span
                                    class="text-light text-dark">agents contact us!</span>
                            </p>

                            <a href="" class="btn btn-primary-light px-3 text-uppercase rounded-pill mt-5">Contact us</a>

                        </div>
                        <div class="col-12 col-lg-4">
                            <p class="fw-bold text-primary-light">
                                You will automatically be billed based on the number of users on your team or
                                brokerage. If
                                you do not wish to have a user as a premium user on your account, you’ll have access
                                to
                                a team
                                manager dashboard where you can turn on and off premium user accounts. You will also
                                have the
                                ability to invite agents to your account.
                            </p>
                        </div>
                    </div>
                    <hr>
                @endif
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="d-flex mb-3">
                            <p class="mb-0 border rounded-circle p-2 fs-18 text-center text-primary-light border-primary-light me-3"
                               style="width: 35px;height: 35px; line-height: 20px">1</p>
                            <p class="mb-0 align-self-center text-capitalize">Billing Info</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Full Name</label>
                            <x-input
                                type="text"
                                class="rounded"
                                name="billing.full_name"
                                wire:model.lazy="billing.full_name"
                                required
                            />

                        </div>

                        <div class="form-group mb-3">
                            <label for="">Billing Address</label>
                            <x-input
                                type="text"
                                class="rounded"
                                name="billing.address"
                                wire:model.lazy="billing.address"
                                required />
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="" class="">City</label>
                                <x-input
                                    type="text"
                                    class="rounded"
                                    name="billing.city"
                                    wire:model.lazy="billing.city"
                                    required />
                            </div>

                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="">ZIP Code</label>
                                <x-input
                                    type="text"
                                    class="rounded"
                                    name="billing.zipcode"
                                    wire:model.lazy="billing.zipcode"
                                    required />
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Country</label>
                            <x-input
                                type="text"
                                class="rounded"
                                name="billing.country"
                                wire:model.lazy="billing.country"
                                required
                            />
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="d-flex mb-3">
                            <p class="mb-0 border rounded-circle p-2 fs-18 text-center text-primary-light border-primary-light me-3"
                               style="width: 35px;height: 35px; line-height: 20px">2</p>
                            <p class="mb-0 align-self-center text-capitalize">credit card info</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Cardholder name</label>
                            <x-input
                                type="text"
                                class="rounded"
                                id="card-holder-name{{ $type }}-{{ $per }}"
                                name="billing.card_holder_name"
                                wire:model.lazy="billing.card_holder_name"
                                required
                            />
                        </div>
                        @include('partials.stripe-card')
                    </div>

                    <div class="form-group col-12 my-4 text-end">
                        <x-button
                            class="btn btn-primary-light px-5 "
                            data-secret="{{ $clientSecret }}"
                            @click.prevent="
                                        // Call start
                                        (async() => {
                                            cardHolderNameEl = document.getElementById('card-holder-name{{ $type }}-{{ $per }}');

                                            let { setupIntent, error } = await stripe{{ ucfirst($type) }}{{ ucfirst($per) }}.confirmCardSetup(
                                                '{{ $clientSecret }}', {
                                                    payment_method: {
                                                        card: cardNumber{{ ucfirst($type) }}{{ ucfirst($per) }}El,
                                                        billing_details: { name: cardHolderNameEl.value }
                                                    }
                                                }
                                            );

                                            if (error) {
                                                console.log(error);
                                                $wire.emit('showToast', 'Error!', 'Sorry! unable to process payment something went wrong. Please try again later.', 1);
                                            } else {
                                                // The card has been verified successfully...
                                                console.log(setupIntent);
                                                $wire.set('paymentMethod', setupIntent.payment_method);
                                                $wire.call('upgradeToPremium')
                                            }
                                        })();

                                    "
                            wire:loading.attr="disabled"
                            wire:target="upgradeToPremium, setupPaymentMethod"
                        >
                            <div wire:loading.remove wire:target="upgradeToPremium">
                                Submit
                            </div>
                            <div wire:loading wire:target="upgradeToPremium">
                                Submitting...
                            </div>
                        </x-button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
