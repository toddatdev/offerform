<div class="container mb-4 mt-1">

    <a
        href="{{ route('dash.teams.index') }}"
        class="btn btn-lg bg-white text-primary-lighter tc-black-hover-warning btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
        type="button"
    >
        <i class="fa fa-angle-left fs-20 me-3"></i> <span class="text-dark fs-14  fw-bold">Back</span>
    </a>

    <div class="row mt-5">
        <div class="col-12 col-lg-3">
            <div class="mb-3">
                <img class="w-100 rounded-3" src="{{ asset("storage/$team->image") }}" onerror="this.src = '/img/dash/dummy-img.jpg'" alt="{{ $team->name }}">
            </div>
            <div class="mb-3">
                <div class="mb-5 position-relative">
                    <label for="" class="position-absolute file-upload-label change-img">
                        <img class="w-18 me-3" src="{{asset('img/menu-icons/upload-icon.svg')}}" alt="">
                        Select Image
                    </label>
                    <div class="text-start mt-2"
                         x-data="{ isUploadingImage: false, progressImage: 0 }"
                         x-on:livewire-upload-start="isUploadingImage = true"
                         x-on:livewire-upload-finish="isUploadingImage = false;"
                         x-on:livewire-upload-error="isUploadingImage = false"
                         x-on:livewire-upload-progress="progressImage = $event.detail.progress"
                    >
                        <x-input class="form-control form-control-lg upload-change-img"
                                 wire:model="image" id="image"
                                 type="file"/>
                        <div class="progress mt-2" x-show="isUploadingImage" style="height: 15px">
                            <div class="progress-bar" role="progressbar"
                                 :style="`width: ${progressImage}%`"
                                 x-on:aria-valuenow="progressImage" aria-valuemin="0"
                                 aria-valuemax="100"
                                 x-text="`${progressImage}%`"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="form-group col-12 col-lg-6 mb-3">
                    <label class="fw-bold mb-2" for="team_name">Team Name</label>
                    <x-input name="team.name" wire:model.lazy="team.name" type="text" id="team_name"/>

                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                    <label class="fw-bold mb-2" for="team_contact_name">Contact Name</label>
                    <x-input name="team.contact_name" wire:model.lazy="team.contact_name" type="text" id="team_contact_name" />

                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                    <label class="fw-bold mb-2" for="team_contact_email">Email Address</label>
                    <x-input name="team.contact_email" wire:model.lazy="team.contact_email" type="text" id="team_contact_email" />
                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                    <label class="fw-bold mb-2" for="">Manager Password </label>
                    <x-input class="form-control form-control-lg" type="text" />
                </div>

                <div class="form-group col-12 col-lg-6 mb-3">
                    <label class="fw-bold mb-2" for="team_address">Address</label>
                    <x-input name="team.address" wire:model.lazy="team.address" type="text" id="team_address" />

                </div>


                <div class="form-group col-12 col-lg-6 mb-3">
                    <label class="fw-bold mb-2" for="team_contact_phone">Contact Phone:</label>
                    <x-input name="team.contact_phone" wire:model.lazy="team.contact_phone" type="text" id="team_contact_phone"/>
                </div>
            </div>
        </div>
        <div class="form-group col-12 mb-3">
            <x-textarea name="team.notes" wire:model.lazy="team.notes" rows="4" placeholder="Notes" />
        </div>

        <div class="form-group col-12 col-md-6  col-lg-4 mb-3">
            <label class="fw-bold mb-2" for="team_no_of_agents">No. of Agents</label>
            <x-input type="number" name="team.no_of_agents" wire:model.lazy="team.no_of_agents" min="0" id="team_no_of_agents"/>

        </div>
    </div>

    <div class="row my-5">
        <div class="col-12 col-md-6 col-lg-3 mb-4 mx-auto">
            <div class="card bg-transparent text-center border-0 team-pricing-card">
                <div class="card-body bg-white shadow rounded mb-4">
                    <h4 class="text-primary-light fw-bold mb-3">Team Free</h4>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="{{ $team->code ?? '' }}" wire:model.defer="team.code" />
                        <p class="mb-0 ms-2 align-self-center fs-14">/Team Code</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-4 mx-auto">
            <div class="card bg-transparent text-center border-0 team-pricing-card">
                <div class="card-body bg-white shadow rounded mb-4">
                    <h4 class="text-primary-light fw-bold mb-3">Team Discount</h4>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="$0" wire:model.defer="team.discount_per_month">
                        <p class="mb-0 ms-2 align-self-center fs-14">/month</p>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="$0" wire:model.defer="team.discount_per_year">
                        <p class="mb-0 ms-2 align-self-center fs-14">/year</p>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="{{ $team->code ?? '' }}" wire:model.defer="team.code" />
                        <p class="mb-0 ms-2 align-self-center fs-14">/Team Code</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3 mb-4 mx-auto">
            <div class="card bg-transparent text-center border-0 team-pricing-card">
                <div class="card-body bg-white shadow rounded mb-4">
                    <h4 class="text-primary-light fw-bold mb-3">Team Premium</h4>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="{{ $team->total_agents ?? 30 }}" wire:model.defer="team.total_agents"/>
                        <p class="mb-0 ms-2 align-self-center fs-14">Total agents</p>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="${{ $team->price_per_agent ?? 15 }}" wire:model.defer="team.price_per_agent" />
                        <p class="mb-0 ms-2 align-self-center fs-14">Price per agent</p>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <input type="text" placeholder="${{ ($team->total_agents ?? 30) * ($team->price_per_agent ?? 15) }}" />
                        <p class="mb-0 ms-2 align-self-center fs-14">Monthly bill</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <x-button class="ms-auto btn-primary-light" wire:click.prevent="save">
            <div wire:loading.remove wire:target="save">
                Update / Save
            </div>
            <div wire:loading wire:target="save">
                Saving...
            </div>
        </x-button>
    </div>


    @if(request()->routeIs('dash.teams.edit'))
        <div class="card border-0 shadow-sm rounded-3 my-5">
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="">Name <img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col">Company <img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col" class="text-center text-capitalize">Total offers <img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col" class="text-center text-capitalize">Total Revenue <img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col" class="text-center text-capitalize">Date of last offer <img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col" class="text-center text-capitalize">Free or paid <img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team->users as $user)
                        <tr class="align-self-center align-items-center">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="img-fluid rounded-circle"
                                             src="{{ $user->image }}" alt="{{ $user->full_name }}"
                                             onerror="this.src = '/img/dash/users/user-icon.png'"
                                             style="width: 40px;height: 40px; object-fit: cover"
                                        />
                                    </div>
                                    <div class="flex-grow-1 ms-3 fw-bold">
                                        <a href="{{ route('dash.users.edit', $user->id) }}" class="text-decoration-none text-dark"> {{ $user->first_name }} </a>
                                    </div>
                                </div>
                            </td>
                            <td>-</td>
                            <td class="text-center fw-bold">-</td>
                            <td class="text-center fw-bold">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center text-capitalize">
                                <span class="bg-primary-lighter px-4 text-white rounded-2 py-1">Free</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif









    {{-- Old Team cols--}}

{{--    <div class="row my-5">--}}
{{--        <div class="col-12 col-md-6 col-lg-3 mx-auto">--}}
{{--            <div class="card bg-transparent text-center border-0 team-pricing-card">--}}
{{--                <div class="card-body bg-white shadow rounded mb-4">--}}
{{--                    <h5 class="text-primary-light fw-bold mb-3">Team Free</h5>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="$0" class="w-50" >--}}
{{--                        <p class="mb-0 ms-2 align-self-center w-50 fs-14 text-start" >/month</p>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="$0" class="w-50" >--}}
{{--                        <p class="mb-0 ms-2 align-self-center w-50 fs-14 text-start" >/year</p>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="KW124" class="w-50" >--}}
{{--                        <p class="mb-0 ms-2 align-self-center w-50 fs-14 text-start" >/Team Code</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-lg rounded-pill px-4 text-uppercase btn btn-primary-light px-5">--}}
{{--                    Current plan--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-6 col-lg-3 mx-auto">--}}
{{--            <div class="card bg-transparent text-center border-0 team-pricing-card">--}}
{{--                <div class="card-body bg-white shadow rounded mb-4">--}}
{{--                    <h5 class="text-primary-light fw-bold mb-3">Team Discount</h5>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="$0">--}}
{{--                        <p class="mb-0 ms-2 align-self-center fs-14">/month</p>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="$0">--}}
{{--                        <p class="mb-0 ms-2 align-self-center fs-14">/year</p>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="KW124">--}}
{{--                        <p class="mb-0 ms-2 align-self-center fs-14">/Team Code</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <x-button class="text-uppercase btn btn-primary-light px-5">Current plan</x-button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-12 col-md-6 col-lg-3 mx-auto">--}}
{{--            <div class="card bg-transparent text-center border-0 team-pricing-card">--}}
{{--                <div class="card-body bg-white shadow rounded mb-4">--}}
{{--                    <h5 class="text-primary-light fw-bold mb-3">Team Premium</h5>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="$0" class="w-50" >--}}
{{--                        <p class="mb-0 ms-2 align-self-center w-50 fs-14 text-start" >/month</p>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="$0" class="w-50" >--}}
{{--                        <p class="mb-0 ms-2 align-self-center w-50 fs-14 text-start" >/year</p>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex justify-content-start mb-3">--}}
{{--                        <input type="text" placeholder="KW124" class="w-50" >--}}
{{--                        <p class="mb-0 ms-2 align-self-center w-50 fs-14 text-start" >/Team Code</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button type="submit" class="btn btn-lg rounded-pill px-4 text-uppercase btn btn-primary-light px-5">--}}
{{--                    Change plan--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{--  End  Old Team cols--}}



</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.change-img').click(function () {
                $('.upload-change-img').click();
            });

            $('.change-video').click(function () {
                $('.upload-change-video').click();
            });

        });
    </script>
@endpush
