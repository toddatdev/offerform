<div class="container my-5 pb-5">

    <h3 class="text-center">{{ $team->name }}</h3>
    <h3 class="text-center text-primary-light">Team code: <b>{{ $team->code }}</b></h3>

    <div class="row my-4">
        <div class="form-group col-12 col-md-8 col-lg-8 my-1 ">
            <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                <div class="input-group-prepend border-0 align-self-center">
                    <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                        <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt="">
                    </button>
                </div>
                <x-input type="text" placeholder="Search agent by name" aria-describedby="button-addon4"
                         class="form-control form-control-lg rounded-pill bg-none border-0 search" wire:model="search" />
            </div>
        </div>
        <div class="form-group col-12 col-md-4 col-lg-4 my-1 btn-group">
            <a href="#" class="btn btn-lg rounded-pill btn-primary-light btn-header fw-bold shadow-sm mx-1 px-2 fs-14"
               data-bs-toggle="modal" data-bs-target="#inviteAgentModal"
            >
                <img class=" mx-2" width="17" src="{{asset('img/menu-icons/fluent-people-white-icon.svg')}}" alt="">
                INVITE AGENT
            </a>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless ">
                    <thead>
                    <tr class="border-bottom">
                        <th scope="col">Name</th>
                        <th scope="col">Total OfferForms Sent</th>
                        <th scope="col">Total OfferForms Completed</th>
                        <th scope="col">OfferForms Offers Accepted</th>
                        <th scope="col">Date of Last Offer</th>
                        <th scope="col">Remove Team User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($team->users as $user)
                        @php
                            $offers = app(\App\Models\OfferForms\OfferFormOffer::class)
                                            ->where('team_id', $team->id)
                                            ->where('slug', 'not like', 'view-form-%')
                                            ->where('slug', 'not like', 'screenshot-%')
                                            ->where('user_id', $user->id);
                            $lastOffer = $offers->latest()->first();
                        @endphp
                        <tr>
                            <td class="fw-500">{{ $user->fullName }}</td>
                            <td class="fw-500">{{ $offers->count() }}</td>
                            <td class="fw-500">{{ $offers->where('status', 1)->count() }}</td>
                            <td class="fw-500">{{ $offers->where('accepted', 1)->count() }}</td>
                            <td class="fw-500">{{ optional(optional(optional($lastOffer)->created_at)->timezone(session('ip_position:timezone', 'UTC')))->format('Y-m-d') }}</td>
                            <td class="fw-500 text-center">
                                <x-button class="btn-link py-0 my-0" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $user->id ?? 0 }}Modal">
                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                </x-button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach($team->users as $user)
        <x-modals.delete-confirmation :id="$user->id" :action='"destroy($user->id)"' >
            <x-slot name="title">
                Do you want to remove this user from your team?
            </x-slot>
        </x-modals.delete-confirmation>
    @endforeach
    <div class="modal fade hideableModal" id="inviteAgentModal" tabindex="-1" aria-labelledby="inviteAgentModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content p-2">
                <div class="modal-header py-0 px-1 border-0 ms-auto text-center">
                    <a href="javascript:void(0)"
                       class="text-decoration-none"
                       data-bs-dismiss="modal" aria-label="Close">
                       <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                    </a>
                </div>
                <form wire:submit.prevent="inviteTeamMember" class="modal-body">
                    <div class="card border-0">
                        <div class="card-body text-center">
{{--                            <x-jetstream::validation-errors />--}}
                            <div class="form-group mb-3">
                                <label for="" class="fs-20 fw-bold text-primary-light mb-1">Agents Name</label>
                                <x-input
                                    type="text"
                                    class="text-center fw-500 ph-light"
                                    name="name"
                                    wire:model="addTeamMemberForm.name"
                                    placeholder="Agent's Name"
                                />
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="fs-20 fw-bold text-primary-light mb-1">Agents Email Address</label>
                                <x-input
                                    type="text"
                                    class="text-center fw-500 ph-light"
                                    placeholder="Agent's Email Address"
                                    name="email"
                                    wire:model="addTeamMemberForm.email"
                                />
                            </div>
                            <x-button class="text-uppercase btn-primary-light-black-hover rounded-3 px-5">
                                <span wire:loading wire:target="inviteTeamMember">
                                    Sending...
                                </span>
                                <span wire:loading.remove wire:target="inviteTeamMember">
                                    Send
                                </span>
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
