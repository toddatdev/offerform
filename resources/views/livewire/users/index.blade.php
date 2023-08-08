<div class="container my-4">
    <div class="row mb-3">
        <div class="form-group col-12 my-1 ">
            <div class="input-group border bg-white px-2 border-0 shadow-sm rounded-pill">
                <div class="input-group-prepend border-0 align-self-center">
                    <button id="button-addon4" type="button" class="btn btn-link text-dark rounded-circle">
                        <div wire:target="search" wire:loading>
                            <x-spinner class="me-2" />
                        </div>
                        <img class="w-17" src="{{asset('img/menu-icons/search-icon.svg')}}" alt="" wire:loading.remove wire:target="search">
                    </button>
                </div>
                <x-input
                    type="text"
                    placeholder="Search Users by name"
                    class="rounded-pill border-0 px-2"
                    wire:model.debounce.500ms="search"
                />
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
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
                    <th scope="col" class="text-center text-capitalize">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="align-self-center align-items-center">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img class="img-fluid rounded-circle"
                                         src="{{ $user->profile_photo_url }}" alt="{{ $user->full_name }}"
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
                        <td class="text-center text-capitalize d-grid">
                           <a href="#" class="btn btn-primary-light btn-sm" wire:click.prevent="loginAs({{$user->id}})">
                               <span wire:loading wire:target="loginAs({{$user->id}})">Logging in...</span>
                               <span wire:loading.remove wire:target="loginAs({{$user->id}})">Login as '{{ $user->first_name }}'</span>
                           </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
