<form wire:submit.prevent="saveIntegrations" class="card border-0 mb-4 shadow-sm p-3">
    <div class="card-body">
        <h4 class="fw-bold text-primary-light">
            Integrations
            <i class="fa fa-question-circle ms-2 fs-22 text-primary-light p-2"
               data-bs-toggle="popover" data-bs-trigger="hover"
               data-bs-content="This will allow you to pass information from OfferForm to your other systems."
               aria-hidden="true">
            </i>
        </h4>
        <hr>
        <div class="row mb-4">
            <div class="col-12 col-lg-3 mb-3 mb-lg-0">
                <div class="socialicon">
                    <img class="img-fluid" src="{{ asset('img/dash/settings/zapier.png') }}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                <div class="form-group">
                    <x-input type="text" class="" name="zapier" wire:model.defer="state.zapier" placeholder=""/>
                </div>
                <x-jet-action-message class="text-success" on="integrations-updated">
                    {{ __('Integration hook verified and saved successfully!') }}
                </x-jet-action-message>
            </div>
            <div class="col-12 col-lg-3 mb-3 mb-lg-0">

                <div class="button text-start text-lg-end">
                    <button type="submit" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light">
                        <span wire:loading.remove wire:target="update">
                            Connect
                        </span>
                        <span wire:loading wire:target="update">
                            Connect
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
