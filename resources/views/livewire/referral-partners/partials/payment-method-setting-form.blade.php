<form
    class="card border-0 mb-4 shadow-sm p-3" wire:submit.prevent="savePaymentMethods"
    x-data="{
        stripe: null,
        stripeCardElements: null,
        cardNumberEl: null,
        cardExpiryEl: null,
        cardCVCEl: null,
        elementStyles : {
            base: {
                color: '#32325D',
                fontWeight: 500,
                fontSize: '18px',
                fontSmoothing: 'antialiased',
            }
        },
        elementClasses : {
            {{--            input: 'border rounded p-3',--}}
            {{--            focus: 'form-control form-control-lg',--}}
            {{--            empty: 'form-control form-control-lg',--}}
            {{--            invalid: 'is-invalid',--}}
        }
    }"
    x-init="async () => {
        stripe = await window.loadStripe('{{ config('cashier.key') }}');
        stripeElements = stripe.elements();

        cardNumberEl = stripeElements.create('cardNumber', {style: elementStyles, classes: elementClasses});
        cardExpiryEl = stripeElements.create('cardExpiry', {style: elementStyles, classes: elementClasses});
        cardCVCEl = stripeElements.create('cardCvc', {style: elementStyles, classes: elementClasses});

        cardNumberEl.mount('#card-number-element');
        cardExpiryEl.mount('#card-expiry-element');
        cardCVCEl.mount('#card-cvc-element');
    }"
>
    <div class="card-body row">
        <div class="col-12 col-lg-6">
            <h5 class="fw-bold mb-3 text-capitalize">billing info via credit card</h5>
            <div class="row">
                <div class="form-group mb-3 col-12 ">
                    <label for="">Name on Card</label>
                    <x-input type="text" name="card.name" wire:model.defer="state.card.name" id="card-holder-name"/>
                </div>
            </div>
            <label>Card Number</label>
            <div id="card-number-element" wire:ignore class="mb-3 border rounded" style="padding: 0.75rem 1rem"></div>
            <div class="row mb-3">
                <div class="col-12 col-md-6 col-lg-6">
                    <label>Expiry Month/Year</label>
                    <div id="card-expiry-element" wire:ignore class="border rounded" style="padding: 0.75rem 1rem"></div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <label>CVC Number</label>
                    <div id="card-cvc-element" wire:ignore class="border rounded" style="padding: 0.75rem 1rem"></div>
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-12">
                    <label for="">ZIP/Postal Code</label>
                    <x-input type="text" name="card.zipcode" wire:model.defer="state.card.zipcode"/>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <h5 class="fw-bold mb-3 text-capitalize">bill Via Bank Account</h5>
            <div class="row">
                <div class="form-group mb-3 col-12 ">
                    <label for="">Name on Account</label>
                    <x-input type="text" name="bank_account.name" wire:model.defer="state.bank_account.name"/>
                </div>
                <div class="form-group mb-3 col-12 ">
                    <label for="">Account Number</label>
                    <x-input type="text" name="bank_account.number" wire:model.defer="state.bank_account.number"/>
                </div>
                <div class="form-group mb-3 col-12 ">
                    <label for="">Routing Number</label>
                    <x-input type="text" name="bank_account.routing_number"
                             wire:model.defer="state.bank_account.routing_number"/>
                </div>
            </div>
        </div>

        <div class="text-end mt-4 ">
            <button
                type="submit"
                class="btn btn-lg btn-primary-light px-5 rounded-3 "
                data-secret="{{ $clientSecret }}"
                @click.prevent="
                    // Call start
                    (async() => {
                        cardHolderNameEl = document.getElementById('card-holder-name');

                        let { setupIntent, error } = await stripe.confirmCardSetup(
                            '{{ $clientSecret }}', {
                                payment_method: {
                                    card: cardNumberEl,
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
                            $wire.set('state.payment_method', setupIntent.payment_method);
                            $wire.call('savePaymentMethods')
                        }
                    })();

            "
                wire:loading.attr="disabled"
                wire:target="savePaymentMethods"
            >
                <div wire:loading.remove wire:target="savePaymentMethods">
                    Save
                </div>
                <div wire:loading wire:target="savePaymentMethods">
                    Saving...
                </div>
            </button>
        </div>

    </div>
</form>
