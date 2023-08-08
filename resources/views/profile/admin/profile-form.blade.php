<div>
    @if($routeIs === 'create')
        <form wire:submit.prevent="createUser" class="card border-0 mb-4 shadow-sm p-3">
            <div class="card-body">
                <h5 class="fw-bold">General settings page for the owner admin</h5>
                <div class="row mb-3 mt-4">
                    <div class="col-12 col-lg-4">
                        <x-profile-photo wire:model="photo" :user="$user"/>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="form-group col-12 col-lg-6 mb-3">
                                <label class="fw-bold mb-2" for="">First Name</label>
                                <x-input type="text" class="py-3" placeholder="John" wire:model.defer="state.first_name" name="first_name"/>
                            </div>

                            <div class="form-group col-12 col-lg-6 mb-3">
                                <label class="fw-bold mb-2" for="">Last Name</label>
                                <x-input type="text" class="py-3" placeholder="Doe" wire:model.defer="state.last_name" name="last_name"/>
                            </div>

                            <div class="form-group col-12 col-lg-6 mb-3">
                                <label class="fw-bold mb-2" for="">Admin Title</label>
                                <x-input type="text" class="py-3" placeholder=""
                                         wire:model.defer="state.other_inputs.admin_title"
                                         name="other_inputs.admin_title"
                                />
                            </div>

                            <div class="form-group col-12 col-lg-6 mb-3">
                                <label class="fw-bold mb-2" for="">Email</label>
                                <x-input type="email" class="py-3" placeholder="admin@app.com"
                                         wire:model.defer="state.email"
                                         name="email"
                                />
                            </div>
                            <div class="form-group col-12 col-lg-6 mb-3">
                                <label class="fw-bold mb-2" for="">Password</label>
                                <x-input type="password" class="py-3" placeholder=""
                                         wire:model.defer="state.password"
                                         name="password"
                                />
                            </div>

                            <div class="form-group col-12 col-lg-6 mb-3" x-data>
                                <label class="fw-bold mb-2" for="">Contact Phone</label>
                                <x-input
                                    type="text"
                                    class="py-3"
                                    placeholder="(###) ###-####"
                                    wire:model.defer="state.phone"
                                    name="phone"
                                    x-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}"
                                />
                            </div>

                            <div class="d-flex mt-2">
                                <x-button class="btn btn-primary-lighter btn-lg rounded-pill px-5 fs-16 text-white fw-bold ms-auto"
                                          wire:click.prevent="createUser">
                                    <div wire:loading.remove wire:target="createUser">
                                        Create
                                    </div>
                                    <div wire:loading wire:target="createUser">
                                        Creating...
                                    </div>
                                </x-button>
                            </div>

                        </div>
                    </div>
                </div>
                <x-jet-action-message class="text-success" on="saved">
                    {{ __('Updated successfully!') }}
                </x-jet-action-message>
            </div>
        </form>
    @else
        <form wire:submit.prevent="updateProfileInformation" class="card border-0 mb-4 shadow-sm p-3">
        <div class="card-body">
            <h5 class="fw-bold">General settings page for the owner admin</h5>
            <div class="row mb-3 mt-4">
                <div class="col-12 col-lg-4">
                    <x-profile-photo wire:model="photo" :user="$user"/>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="row">
                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">First Name</label>
                            <x-input type="text" class="py-3" placeholder="John" wire:model.defer="state.first_name" name="first_name"/>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Last Name</label>
                            <x-input type="text" class="py-3" placeholder="Doe" wire:model.defer="state.last_name" name="last_name"/>
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Admin Title</label>
                            <x-input type="text" class="py-3" placeholder=""
                                     wire:model.defer="other_inputs.admin_title"
                                     name="other_inputs.admin_title"
                            />
                        </div>
                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Copyright</label>
                            <x-input type="text" class="py-3" placeholder=""
                                     wire:model.defer="other_inputs.copyright"
                                     name="other_inputs.copyright"
                            />
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3">
                            <label class="fw-bold mb-2" for="">Email</label>
                            <x-input type="text" class="py-3" placeholder="admin@app.com"
                                     wire:model.defer="state.email"
                                     name="email"
                            />
                        </div>

                        <div class="form-group col-12 col-lg-6 mb-3" x-data>
                            <label class="fw-bold mb-2" for="">Contact Phone</label>
                            <x-input type="text" class="py-3" placeholder="(###) ###-####" wire:model.defer="state.phone" name="phone"
                                     x-mask="{numericOnly: true, blocks: [0, 3, 3, 4], delimiters: ['(', ') ', '-']}"
                            />
                        </div>

                        <div class="form-group col-12 col-lg-12 mb-3">
                            <label class="fw-bold mb-2" for="">Contact address</label>
                            <x-input type="text" class="py-3" placeholder="Street#1234 USA"
                                     name="address"
                                     wire:model.defer="state.address"/>
                        </div>

                        <div class="d-flex mt-2">
                            <x-button class="btn btn-primary-lighter btn-lg rounded-pill px-5 fs-16 text-white fw-bold ms-auto"
                                      wire:click.prevent="updateProfileInformation">
                                <div wire:loading.remove wire:target="updateProfileInformation">
                                    Update
                                </div>
                                <div wire:loading wire:target="updateProfileInformation">
                                    Updating...
                                </div>
                            </x-button>
                        </div>

                    </div>
                </div>
            </div>
            <x-jet-action-message class="text-success" on="saved">
                {{ __('Updated successfully!') }}
            </x-jet-action-message>
        </div>
    </form>
    @endif
    @if($routeIs === 'settings')
        <div class=" my-5">
            <a href="{{ route('dash.users.create') }}" class="btn btn-lg btn-black-white-hover rounded-pill fs-14 px-5">Add Admin Account</a>
        </div>
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Name <img src="/img/menu-icons/double-arrow.svg"
                                                  class="w-10 ms-1" alt=""></th>
                        <th scope="col">Employee Title <img src="/img/menu-icons/double-arrow.svg"
                                                            class="w-10 ms-1" alt=""></th>
                        <th scope="col" class="text-center text-capitalize">Last Active<img
                                src="/img/menu-icons/double-arrow.svg" class="w-10 ms-1" alt="">
                        </th>
                        <th scope="col" class="text-center text-capitalize">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="align-self-center align-items-center">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="img-fluid rounded-circle" src="{{ $user->profile_photo_url }}"
                                             alt="{{ $user->full_name }}"
                                             onerror="this.src = '/img/dash/users/user-icon.png'"
                                             style="width: 40px;height: 40px; object-fit: cover">
                                    </div>
                                    <div class="flex-grow-1 ms-3 fw-bold">
                                        <a href="http://127.0.0.1:8000/u/users/1/edit"
                                           class="text-decoration-none text-dark"> {{ $user->first_name }} </a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->other_inputs['admin_title'] ?? '' }}</td>
                            <td class="text-center">-</td>
                            <td class="text-center text-capitalize">
                                <a href="{{ route('dash.users.edit', $user->id) }}"
                                   class="bg-primary-lighter px-4 text-white rounded-2 py-1 text-decoration-none">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    @endif
</div>
