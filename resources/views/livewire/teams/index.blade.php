<div class="container my-4">
    <div class="row mb-3">
        <div class="form-group col-12 col-md-8 col-lg-8 my-1 ">
            <x-input
                type="text"
                placeholder="Search Team by name"
                class="rounded-pill border-0 px-3 shadow-sm"
                wire:model.debounce.500ms="search"
            />
        </div>
        {{-- Add Button to change view here --}}
        <div class="form-group col-12 col-md-4 col-lg-4 my-1 btn-group">
            <a href="#"
               class="btn btn-lg me-2 bg-white btn-header rounded-pill fw-bold shadow-sm fs-14 text-capitalize"
               id="teamDisplayAsDropdownMenu"
               data-bs-toggle="dropdown"
               aria-expanded="false"
            >
                <span class="text-dark fw-bold fs-14 text-capitalize">
                    <img class="w-18 me-2" src="{{ asset('img/menu-icons/' . ($displayAs === 'compact' ? 'compact' : 'grid-icon-color') .'.svg') }}" alt="{{ $displayAs }}"> {{ $displayAs }}
                </span>
            </a>

            <ul class="dropdown-menu bg-white border-0 rounded-3 mt-2 py-0 text-white shadow"
                aria-labelledby="sorting">
                <li>
                    <a class="dropdown-item fw-500 fs-14" href="#" wire:click.prevent="changeDisplayAs('compact')">
                        <img class="w-17 me-2" src="{{ asset('img/menu-icons/compact.svg') }}" alt="Compact">
                        Compact
                    </a>
                </li>
                <li>
                    <a class="dropdown-item fw-500 fs-14" href="#" wire:click.prevent="changeDisplayAs('grid')">
                        <img class="w-16 me-2" src="{{ asset('img/menu-icons/grid-icon-color.svg') }}" alt="Grid">
                        Grid
                    </a>
                </li>
            </ul>
            <a href="{{ route('dash.teams.create') }}"
               class="btn btn-lg bg-white ms-2 btn-header rounded-pill fw-bold shadow-sm fs-14 text-capitalize">
                + Add New Team
            </a>
        </div>
    </div>

    @if($displayAs === 'grid')
        <div class="row">
            @foreach($teams as $team)
                    <div class="col-12 col-md-6 col-lg-4 mb-5">
                        <div class="card rounded-3 border-0 shadow-sm">
                            <img
                                class="img-fluid"
                                src="{{ asset("storage/$team->image") }}"
                                onerror="this.src = '/img/dash/team/t1.png'"
                                alt="{{ $team->name }}"
                            />
                            <div class="card-body">
                                <h5><a href="{{ route('dash.teams.edit', $team->id) }}" class="text-decoration-none">{{ $team->name }}</a></h5>
                                <p>No. of Agents: {{ $team->no_of_agents}}</p>
                                <p>Free plan</p>
                                <p>Team code : {{ $team->code}}</p>
                                <p>Contact: <b class="ms-3">{{ $team->contact_name}} {{ $team->contact_phone}}</b></p>
                                <p class="fw-bold">{{ $team->address}}</p>
                            </div>
                        </div>
                    </div>

            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-borderless ">
                    <thead>
                    <tr class="border-bottom">
                        <th scope="col">Name<img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col">No. of Agents<img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col">Team Code<img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col">Contact<img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col">Address<img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                        <th scope="col">Free or Paid By Team<img src="{{asset('img/menu-icons/double-arrow.svg')}}" class="w-10 ms-1" alt=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td class="fw-500">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img class="img-fluid rounded-circle"
                                             src="{{ asset("storage/$team->image") }}" alt="{{ $team->name }}"
                                             onerror="this.src = '/img/dash/users/user-icon.png'"
                                             style="width: 40px"
                                        />
                                    </div>
                                    <div class="flex-grow-1 ms-3 fw-bold">
                                        <a href="{{ route('dash.teams.edit', $team->id) }}" class="text-decoration-none text-dark"> {{ $team->name }} </a>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-500">{{ $team->no_of_agents }}</td>
                            <td class="fw-500">{{ $team->code }}</td>
                            <td class="fw-500">{{ $team->contact_name }} {{ $team->contact_phone }}</td>
                            <td class="fw-500">{{ $team->address }}</td>
                            <td class="fw-500"><span class="badge bg-primary ">Free</span></td>
{{--                            <td class="fw-500 text-center">--}}
{{--                                <x-button class="btn-link py-0 my-0" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{ $user->id ?? 0 }}Modal">--}}
{{--                                    <i class="fa fa-trash text-danger" aria-hidden="true"></i>--}}
{{--                                </x-button>--}}
{{--                            </td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

