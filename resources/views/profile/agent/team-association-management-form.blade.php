@if($associatedTeam)
    <div class="card border-0 mb-4 shadow-sm">
        <div class="card-body ">
            <h4 class="fw-bold text-primary-light text-center">Team Settings</h4>
            <div class="row py-5 w-full-md-75">
                <div class="col-12 col-lg-6 text-center">
                    <h4 class="text-primary-light">Associated With</h4>
                    <button class="btn btn-lg btn-primary-light px-3"
                            disabled>{{ $associatedTeam->name }}</button>

                    <h4 class="mt-5 mb-2">Disassociate with Team</h4>
                    <button
                        class="btn btn-lg btn-primary-light rounded-pill fs-14 px-3 px-lg-5 text-uppercase"
                        wire:click.prevent="associateOrDisassociateWithTeam('disassociate')"
                    >
                        <div wire:loading.remove
                             wire:target="associateOrDisassociateWithTeam('disassociate')">
                            Disassociate
                        </div>
                        <div wire:loading wire:target="associateOrDisassociateWithTeam('disassociate')">
                            Disassociating...
                        </div>
                    </button>
                </div>
                <div class="col-12 col-lg-6 text-center">
                    <div class="form-group mb-3">
                        <label for="" class="text-primary-light">Enter New Team Code</label>
                        <x-input type="text" name="teamCode" wire:model.lazy="teamCode"/>
                    </div>
                    <button
                        class="btn btn-lg btn-primary-light rounded-pill fs-14 px-3 px-lg-5 text-uppercase"
                        wire:click.prevent="associateOrDisassociateWithTeam('associate')"
                    >
                        <div wire:loading.remove wire:target="associateOrDisassociateWithTeam('associate')">
                            Update
                        </div>
                        <div wire:loading wire:target="associateOrDisassociateWithTeam('associate')">
                            Updating...
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif
