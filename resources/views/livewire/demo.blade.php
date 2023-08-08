<div class="demo-forms row" wire:ignore>
    <div class="col-12 col-md-9 col-lg-6 mx-auto">
        <div class="text-center mb-5" data-aos="fade-up">
            <h5 class="text-primary fw-normal ">Want to learn more?</h5>
            <form class="input-group mb-3 mt-3" wire:submit.prevent="sendDemoVideo">
                <x-input type="text" class="form-control form-control-lg text-center" name="email"
                         wire:model.defer="email"
                         placeholder="Enter your email"/>
                <button
                    class="btn btn-primary px-4 w-180"
                    type="submit" id="button-addon2">Send demo video
                </button>
            </form>
        </div>

        <div class="text-center mb-5" data-aos="fade-up">
            <h5 class="text-primary fw-normal ">Free Forever No Credit Card Required</h5>
            <form class="input-group mt-3" action="{{ route('register') }}">
                <x-input type="text" class="form-control form-control-lg text-center"
                         name="email"
                         placeholder="Enter your email"/>
                <button class="btn btn-primary px-4 w-180" type="submit">Create Free Account
                </button>
            </form>
        </div>

        <div class="text-center pt-4 mb-5" data-aos="fade-up">
            <h5 class="text-primary fw-normal ">Enter Your Email Here To Have An Example OfferForm Sent To Your
                Inbox</h5>
            <form class="input-group mb-3 mt-3" wire:submit.prevent="sendMeAnOfferForm">
                <x-input type="text" class="form-control form-control-lg text-center"
                         name="email"
                         placeholder="Enter your email" wire:model.defer="email"/>
                <button class="btn btn-primary px-4 w-180" type="submit" id="button-addon2">Send me an Offerform
                </button>
            </form>
        </div>

    </div>
</div>
