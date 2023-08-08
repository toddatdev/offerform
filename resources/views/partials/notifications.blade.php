<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel"
     style="width: 550px;"
     x-data="{
        clearing: false,
        async clearNotifications() {
            res = await (await fetch('{{ route('dash.clear-notifications')}}')).json();
            if(res.status === 'ok') {
                document.getElementById('notifications').innerHTML = '<p class=\'text-muted text-center\'>You reached the end!</p>';
            }
        }
    }"
>
    <div class="offcanvas-body p-0 border-0">
        <div class="row bg-white border rounded-3" style="min-height: 100%;max-width: 100%;">
            <div class="col-1 text-center pe-0">
                <div class=" align-items-center" style="border-bottom: 1px solid #A1A1A1; height: 60px">
                    <button type="button"
                            class="text-reset bg-transparent border-0 rounded-0 p-0 align-items-center align-self-center"
                            data-bs-dismiss="offcanvas" aria-label="Close">
                        <img src="{{asset('img/menu-icons/notifcation-arrow.svg')}}" class="w-18 mx-auto mt-4" alt="">
                    </button>
                </div>
            </div>
            <div class="col-11 px-0" style="border-left: 1px solid #A1A1A1;background-color: #F7F7FD">
                <div class="d-flex align-items-center bg-white px-3  justify-content-between"
                     style="border-bottom: 1px solid #A1A1A1; height: 60px">
                    <h5 class="fw-bold mb-0">Notification</h5>
                    <div class="">
                        <a href="{{ route('dash.settings') }}#notificationTab" class="text-decoration-none notificationSetting">
                            <img class="w-22 me-3" src="{{asset('img/menu-icons/setting-gray.svg')}}"
                                 alt="Settings" />
                        </a>
                        <div x-show="clearing" :class="{ 'd-inline-block' : clearing}">
                            <x-spinner />
                        </div>
                        <img
                            class="w-22 me-3"
                            src="{{asset('img/menu-icons/trash-gray.svg')}}"
                            style="cursor: pointer"
                            alt=""
                            x-show="!clearing"
                            @click.prevent="clearing = true; await clearNotifications(); clearing = false;"
                        />
                    </div>
                </div>

                <div class="notification-card mx-2 px-3 py-5"
                     id="notifications"
                     >
                    @foreach(auth()->user()->notifications()->orderByDesc('created_at')->limit(100)->get() as $notification)
                        <div style="cursor: pointer" class="card rounded-3 mb-4" @click.prevent="window.location = '{{  $notification['data']['link_to_offer'] ?? '#' }}?notify-ref={{ $notification->id }}'">
                            <div class="card-body d-flex">
                                <div class="me-3">
                                    <img class="w-24"
                                         src="{{ asset('img/menu-icons/icon-park-outline.svg') }}" alt=""
                                         style="filter: grayscale(0)">
                                </div>
                                <div class="">
                                    <div class="border-bottom">
                                        <h5 class="fw-bold">New OfferForm <span
                                                class="fs-14 fw-normal text-primary-light ms-2">{{  $notification['data']['offer_form_name'] ?? '' }}</span>
                                        </h5>
                                    </div>
                                    <p class="mb-0 text-primary-light fw-500 fs-14">
                                        {{  $notification['data']['property_address'] }}
                                    </p>
                                    <p class="mb-0 fs-14 fw-500 ">{{  $notification['data']['buyer_name'] ?? '' }}</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0 fw-500 ">{{  $notification['data']['agent_name'] ?? '' }}</p>
                                        <p class="mb-0 text-muted">{{ $notification->created_at->format('m/d/y | h:i a') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <p class="text-muted text-center">You reached the end!</p>
                </div>

            </div>
        </div>
    </div>
</div>
