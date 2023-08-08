<x-app-layout>
    <div class="container my-3">
{{--        <h6 class="fw-bold ">--}}
{{--            <a href="#" class="text-decoration-none text-dark"--}}
{{--               data-bs-toggle="modal" data-bs-target="#quickGuideTip"--}}
{{--            >--}}
{{--                <i class="fa fa-question-circle ms-2 fs-22 text-primary-light p-2"--}}
{{--                   data-bs-toggle="popover" data-bs-trigger="hover"--}}
{{--                   data-bs-content="This will allow you to pass information from OfferForm to your other systems."--}}
{{--                   aria-hidden="true">--}}
{{--                </i>--}}

{{--                Click here to watch the set-up guide--}}
{{--            </a>--}}
{{--        </h6>--}}

{{--        <div class="modal fade" id="quickGuideTip" aria-hidden="true"--}}
{{--             aria-labelledby="exampleModalToggleLabel" tabindex="-1">--}}
{{--            <div class="modal-dialog modal-dialog-centered agentModal" style="max-width: 700px;">--}}
{{--                <div class="modal-content rounded-30">--}}

{{--                    <div class="modal-header border-0 ms-auto pb-0">--}}
{{--                        <a href="javascript:void(0)"--}}
{{--                           class="text-decoration-none"--}}
{{--                           style="z-index: 999"--}}
{{--                           data-bs-dismiss="modal" aria-label="Close">--}}
{{--                            <img src="{{asset('img/menu-icons/cross-icon.svg')}}"--}}
{{--                                 class="w-30 svg-hover-black" alt="">--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                    <div class=" modal-body text-center px-lg-5 pt-0" style="margin-top: -25px">--}}
{{--                        <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>--}}
{{--                        <p class="text-primary-light fw-500">--}}
{{--                            This is an OfferForm quick tip. It pop ups when a user clicks on the question mark tips. We will have a how to video and educational tip.--}}
{{--                        </p>--}}


{{--                        <div class="rounded-15 mt-2"--}}
{{--                             x-show="!isPlaying"--}}
{{--                             style="background-image: url({{asset('img/dash/offer-forms/how-much-to-offer.png')}});--}}
{{--                                 background-position: center; background-size: cover; background-repeat: no-repeat; height: 270px">--}}
{{--                            <div class="text-center text-white px-2 px-lg-5 py-2  d-flex align-items-center justify-content-center"--}}
{{--                                 style="height: 270px">--}}
{{--                                <div>--}}
{{--                                    <h5 class="fw-normal d-none d-lg-block mb-2">Click here to learn more about</h5>--}}
{{--                                    <a--}}
{{--                                        href="javascript:void(0)"--}}
{{--                                        @click.prevent="playOrPauseVideo()"--}}
{{--                                    >--}}
{{--                                        <i class="fa fa-play bg-white p-3 fs-16 text-center rounded-circle text-primary shadow"></i>--}}
{{--                                    </a>--}}
{{--                                    <h5 class="fw-normal d-none d-lg-block mt-2">Click Play</h5>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @role('agent')
            <livewire:profile.agent.profile-form :user="$user"/>
            <livewire:profile.update-password-form :user="$user"/>
            <livewire:profile.update-user-notification-preferences-form :user="$user"/>
            <livewire:profile.agent.team-association-management-form :user="$user"/>
            <livewire:profile.update-user-social-media-links-form :user="$user"/>
            <livewire:profile.agent.integrations-form :user="$user"/>
            <livewire:profile.agent.subscription-form :user="$user"/>
        @else
            <livewire:profile.admin.profile-form :user="$user"/>
        @endrole
    </div>

    @include('partials.first-time-setup-checklist')
    @include('partials.team-account-setup')


    @push('scripts')

    @endpush


    @push('scripts')
        @role('agent')
            @if(request()->has('first'))
                <script>
                    $(function () {
                        @if($user->teams()->first() || $user->ownedTeams()->first())
                            $('#teamAccountSetup').modal('show');
                        @else
                            $('#firstTimeSetupChecklist').modal('show');
                        @endif
                    });
                </script>
            @endif
            <script>
                $(document).ready(function () {
                    window.Livewire.on('team-manager', (link) => {
                        $('#team-manager').attr('href', link);
                    })
                });
            </script>
        @endrole
    @endpush

</x-app-layout>
