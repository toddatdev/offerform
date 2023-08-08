<x-app-layout>

    <x-slot name="header">
        <div class="container my-3">
            <div class="row">
                <div class="form-group col-12 col-md-8 col-lg-8 my-1 ">
                    <x-input type="text" placeholder="Search User by name"
                             class="rounded-pill border-0 px-3 shadow-sm"/>
                </div>
                <div class="form-group col-12 col-md-4 col-lg-4 my-1 btn-group">
                    <a href="{{route('dash.referral-partners.create', $referralPartnerType->slug)}}" class="btn btn-lg rounded-pill bg-white btn-header fw-bold shadow-sm mx-1 fs-14">
                        +Add New Title Company
                    </a>
                    <x-button class="bg-white btn-header fw-bold shadow-sm mx-1 fs-14">
                        Grid
                    </x-button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container my-4 ">

        <h3>Data not found!</h3>

    </div>
</x-app-layout>
