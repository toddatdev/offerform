<div>
    <form wire:submit.prevent="save" class="card border-0 shadow-sm rounded-3 my-5">
        <div class="card-body px-0 px-lg-5">
            <h3 class="text-center text-primary-light mb-4">Permissions</h3>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="p{{ $permission->id }}"
                                   value="{{ $permission->id }}" wire:model.defer="state"/>
                            <label class="form-check-label" for="p{{ $permission->id }}">
                                {{ Str::of($permission->name)->replace('-', ' ')->title() }}

                            </label>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="d-flex mt-3">
                <div
                    class="d-flex justify-content-center align-items-center ms-auto"
                >
                    <x-jet-action-message class="text-success me-2" on="saved">
                        {{ __('Saved!') }}
                    </x-jet-action-message>
                    <button class="btn rounded-pill btn-primary-light-black-hover px-5">
                        <div wire:loading.remove wire:target="save">
                            Save
                        </div>
                        <div wire:loading wire:target="save">
                            Saving...
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div
        class="d-flex align-items-center"
    >
        <button class="btn rounded-pill btn-black-white-hover px-5 me-2" data-bs-toggle="modal"
                data-bs-target="#deleteConfirmation{{ $user->id ?? 0 }}Modal">
            <div wire:loading.remove wire:target="save">
                Delete Account
            </div>
            <div wire:loading wire:target="save">
                Deleting...
            </div>
        </button>
        <button class="btn rounded-pill btn-black-white-hover px-5" wire:click.prevent="activeOrInactive">
            <div wire:loading.remove wire:target="activeOrInactive">
                {{ $user->active ? 'InActivate' : 'Activate' }}
            </div>
            <div wire:loading wire:target="activeOrInactive">
                {{ $user->active ? 'Inactivating...' : 'Activating...' }}
            </div>
        </button>
    </div>

    <x-modals.delete-confirmation :id="$user->id" :action='"destroy"'
                                  :key="time().$user->id"/>
</div>
