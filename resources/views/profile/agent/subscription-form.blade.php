<div class="upGradePricingTable" id="upGradePricingTable">
    <div class="container">
        {{--      Individual Pricing      --}}
        <div class="my-5 pricing" id="pricing">
            <div class="text-center">
                <h1 class=""><img class="me-2" width="36" src="{{asset('img/menu-icons/carbon.svg')}}" alt="">Upgrade
                    your Plan</h1>
                <h5>Choose the plan that's right for your growing team!</h5>
                {{--         Monthly or Yealry Selectors           --}}
                <div
                    class="inner col-12 mx-auto tabsBtnHolder my-4 pb-5">
                    <div class="btn-group bg-primary rounded-pill px-0 shadow mb-2"
                         role="group"
                         aria-label="Basic example">
                        <button id="monthly"
                                type="button"
                                class="active btn subscription  px-5 text-white py-3 rounded-pill text-uppercase">
                            Monthly
                        </button>
                        <button
                            id="yearly"
                            type="button"
                            data-bs-html="true"
                            data-bs-toggle="tooltip" data-bs-placement="right" title="<span class='fs-20 px-3 py-2 d-inline-block'>Save up to 20%</span>"
                            class="btn rounded-pill subscription text-white px-5 py-3 btnYearlyTooltip text-uppercase">
                            Yearly
                        </button>
                    </div>
                    {{--                        <div class="align-self-center ms-5 position-relative mb-2 d-none" id="discountOffer">--}}
                    {{--                            <div class="triangle-left d-none d-lg-block"></div>--}}
                    {{--                            <p class="mb-0 py-3 px-5 px-lg-3 text-white" style="background-color: #000000">Save up to--}}
                    {{--                                <span style="color: #f0d22e">20%!</span></p>--}}
                    {{--                        </div>--}}
                </div>
            </div>

            {{--        Monthly Plans        --}}
            <div class="row monthlyPriceList animated mt-5 py-3">
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                    @include('partials.pricing-plans.monthly.free')
                    <div class="text-center mt-4">


                        {{--Start Popover--}}

                        <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                                data-bs-container="body"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                           data-bs-content="<p>This is our individual agent-free plan. It gives you access to all ...</p>
                           <a href='#!' class='openModalFreePlan text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                           aria-hidden="true">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="freePlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 600px;">
                                <div class="modal-content">
                                    <div class="modal-header border-0 text-center">
                                        <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                        </button>
                                    </div>

                                    <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                                    >
                                        <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                        <p class="text-primary-light fw-500">
                                            This is our individual agent-free plan. It gives you access to all the features OfferForm offers,
                                            It does have locked referral partner steps.  To remove those steps upgrade to a premium plan.
                                        </p>

                                        <div class="first-time-user-popup-video">
                                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                                   controls>
                                                <source src="{{asset('video/offerform/individual-quick-plan.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        {{--End Popover--}}

                        @if($user->subscribed('premium-personal-monthly') || $user->current_team_id)
                            <button
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                               wire:click.prevent="downGradeToFree('personal')"
                                {{ ($user->subscription('premium-personal-yearly') && $user->subscription('premium-personal-yearly')->onGracePeriod()) || ($user->subscription('premium-personal-monthly') && $user->subscription('premium-personal-monthly')->onGracePeriod()) ? 'disabled' : '' }}
                            >
                                <div wire:loading.remove wire:target="downGradeToFree">
                                    Downgrade to Free Plan
                                </div>
                                <div wire:loading wire:target="downGradeToFree">
                                    Downgrading...
                                </div>
                            </button>
                        @else
                            <button disabled
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover rounded-pill btn-header text-uppercase">
                                Your Current plan
                            </button>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                    @include('partials.pricing-plans.monthly.premium')
                    <div class="text-center mt-4">

                        {{--Start Popover--}}

                        <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                                data-bs-container="body"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                           data-bs-content="<p>This plan allows you to unlock the referral partner steps...</p>
                           <br/><a href='#!' class='openModalPremiumPlan text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                           aria-hidden="true">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="premiumPlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 600px;">
                                <div class="modal-content">
                                    <div class="modal-header border-0 text-center">
                                        <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                        </button>
                                    </div>

                                    <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                                    >
                                        <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                        <p class="text-primary-light fw-500">
                                            This plan allows you to unlock the referral partner steps.
                                        </p>

                                        <div class="first-time-user-popup-video">
                                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                                   controls>
                                                <source src="{{asset('video/offerform/individual-quick-premium-plan.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        {{--End Popover--}}


                        @if($user->subscribed('premium-personal-monthly'))
                            <button disabled
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase">
                                Your current plan
                            </button>
                        @else
                            <button
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                               data-bs-toggle="modal" data-bs-target="#upgradeToPersonalMonthlyPremiumModal"
                               wire:click="setPlanToSubscribe('premium', 'personal', 'month')"
                            >
                                Upgrade to premium
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{--        Yearly Plans        --}}
        <div class="row yearlyPriceList d-none animated mt-5 py-3">
            <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                @include('partials.pricing-plans.yearly.free')
                <div class="text-center mt-4">
                    @if($user->subscribed('premium-personal-yearly') || $user->current_team_id)
                        <button
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                           wire:click.prevent="downGradeToFree('personal')"
                            {{ ($user->subscription('premium-personal-yearly') && $user->subscription('premium-personal-yearly')->onGracePeriod()) || ($user->subscription('premium-personal-monthly') && $user->subscription('premium-personal-monthly')->onGracePeriod()) ? 'disabled' : '' }}
                        >
                            <div wire:loading.remove wire:target="downGradeToFree">
                                Downgrade to Free Plan
                            </div>
                            <div wire:loading wire:target="downGradeToFree">
                                Downgrading...
                            </div>
                        </button>
                    @else
                        <button disabled
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase">
                            Your Current plan
                        </button>
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                @include('partials.pricing-plans.yearly.premium')
                <div class="text-center mt-4">
                    @if($user->subscribed('premium-personal-yearly'))
                        <button disabled
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase">
                            Your current plan
                        </button>
                    @else
                        <button
                           class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                           data-bs-toggle="modal" data-bs-target="#upgradeToPersonalYearlyPremiumModal"
                           wire:click="setPlanToSubscribe('premium', 'personal', 'year')"
                        >
                            Upgrade to premium
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @if(($user->subscription('premium-personal-yearly') && $user->subscription('premium-personal-yearly')->onGracePeriod()) || ($user->subscription('premium-personal-monthly') && $user->subscription('premium-personal-monthly')->onGracePeriod()))
            <p class="text-center">
                You have been downgraded successfully. Your plan will automatically downgrade at next billing.
            </p>
        @endif
    </div>
    {{--    Team Plans    --}}
    <div class="container">
        <div class="my-4 pricing">
            <div class="text-center row mb-5 pb-4">
                <h1 class="">
                    <img class="me-2" width="42" src="{{asset('img/menu-icons/fluent-people-team.svg')}}" alt="">Change to a Team Plan</h1>
                <h5>Share Forms Amongst Your Team</h5>
            </div>
            <div class="row animated my-5 py-3">
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                    @include('partials.pricing-plans.monthly.team-or-brokerage')
                    <div class="text-center mt-4">



                        {{--Start Popover--}}

                        <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                                data-bs-container="body"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                           data-bs-content="<p>The free team plan gives you access to shared team...</p>
                           <a href='#!' class='openModalFreeTeamPlan text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                           aria-hidden="true">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="freeTeamPlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 600px;">
                                <div class="modal-content">
                                    <div class="modal-header border-0 text-center">
                                        <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                        </button>
                                    </div>


                                    <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                                    >
                                        <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                        <p class="text-primary-light fw-500">
                                            The free team plan gives you access to shared team forms and a manager profile
                                        </p>

                                        <div class="first-time-user-popup-video">
                                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                                   controls>
                                                <source src="{{asset('video/offerform/change-to-team-plan.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        {{--End Popover--}}


                        @if($user->subscribed('premium-team-monthly'))
                            <button
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                               wire:click.prevent="downGradeToFree('team')"
                               {{ $user->subscription('premium-team-monthly') && $user->subscription('premium-team-monthly')->onGracePeriod() ? 'disabled' : '' }}
                            >
                                <div wire:loading.remove wire:target="downGradeToFree">
                                    Downgrade to Free Plan
                                </div>
                                <div wire:loading wire:target="downGradeToFree">
                                    Downgrading...
                                </div>
                            </button>
                        @elseif($user->current_team_id)
                            <button disabled
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase">
                                Your current plan
                            </button>
                        @else
                            <a href="#"
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                               wire:click.prevent="downGradeToFree('team')"
                            >
                                Change to Team PLan
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-4 my-4 my-lg-0 mx-auto">
                    @include('partials.pricing-plans.yearly.team-or-brokerage')
                    <div class="text-center mt-4">


                        {{--Start Popover--}}

                        <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                                data-bs-container="body"
                                data-bs-toggle="popover"
                                data-bs-html="true"
                           data-bs-content="<p>A Team plan that allows you to unlock the referral ...</p>
                           <br/><a href='#!' class='openModalPremiumTeamPlan text-decoration-none text-dark'
                           >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                           aria-hidden="true">
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="premiumTeamPlan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 600px;">
                                <div class="modal-content">
                                    <div class="modal-header border-0 text-center">
                                        <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                        </button>
                                    </div>

                                    <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                                    >
                                        <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                        <p class="text-primary-light fw-500">
                                            A team plan that allows you to unlock the referral partner steps.
                                        </p>


                                        <div class="first-time-user-popup-video">
                                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                                   controls>
                                                <source src="{{asset('video/offerform/change-to-team-premium-plan.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        {{--End Popover--}}


                        @if($user->subscribed('premium-team-monthly'))
                            <button disabled
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase">
                                Your current plan
                            </button>
                        @else
                            <button
                               class="btn btn-lg fw-bold text-uppercase btn-primary-light-black-hover  rounded-pill btn-header text-uppercase"
                               data-bs-toggle="modal" data-bs-target="#upgradeToTeamMonthlyPremiumModal"
                               wire:click="setPlanToSubscribe('premium', 'team', 'month')"
                            >
                                UPGRADE TO Team PREMIUM
                            </button>
                        @endif
                    </div>
                </div>
                @if($user->subscription('premium-team-monthly') && $user->subscription('premium-team-monthly')->onGracePeriod())
                    <p class="text-center mt-3">
                        You have been downgraded successfully. Your plan will automatically downgrade at next billing.
                    </p>
                @endif
            </div>
        </div>

        {{--      Team Code Submit & Associate      --}}
        <div class="my-5 pb-5 text-center w-full-md-50">
            <h5 class="text-primary-light">Already a part of a brokerage or team? Enter your team code below. </h5>
            <div class="form-group my-4">
                <x-input type="text" class="rounded text-center primary-light-placeholder" name="teamCode" wire:model.lazy="teamCode"
                         placeholder="Enter Team/Broker Code Here"/>
            </div>
            <x-button class="btn btn-primary-light rounded-pill px-5"
                      wire:click.prevent="associateOrDisassociateWithTeam('associate')">
                <div wire:loading.remove wire:target="associateOrDisassociateWithTeam('associate')">
                    Submit
                </div>
                <div wire:loading wire:target="associateOrDisassociateWithTeam('associate')">
                    Submitting...
                </div>
            </x-button>
        </div>
    </div>
    @include('partials.pricing-plans.modals.pay-for-premium', ['type' => 'personal', 'per' => 'month'])
    @include('partials.pricing-plans.modals.pay-for-premium', ['type' => 'personal', 'per' => 'year'])
    @include('partials.pricing-plans.modals.pay-for-premium', ['type' => 'team', 'per' => 'month'])
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $(".subscription").click(function () {
                // remove classname 'active' from all li who already has classname 'active'
                $(".subscription.active").removeClass("active");
                // adding classname 'active' to current click li
                $(this).addClass("active");
            });

            // Subscriptions

            $("#monthly").click(function () {
                $(this).addClass('active');
                $("#yearly").removeClass('active')

                $(".monthlyPriceList").removeClass('d-none');
                $(".monthlyPriceList").addClass('fadeIn');
                $(".yearlyPriceList").addClass('d-none');

                $(".indicator").css("left", "2px");
                $("#discountOffer").addClass('d-none');
            })

            $("#yearly").click(function () {
                $(this).addClass('active');
                $("#monthly").removeClass('active');

                $(".yearlyPriceList").removeClass('d-none');
                $(".yearlyPriceList").addClass('fadeIn');
                $(".monthlyPriceList").addClass('d-none');

                $(".indicator").css("left", "163px");
                $("#discountOffer").removeClass('d-none');

            })

        });
    </script>

    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalFreePlan', function(){
                $('#freePlan').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalPremiumPlan', function(){
                $('#premiumPlan').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalFreeTeamPlan', function(){
                $('#freeTeamPlan').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalPremiumTeamPlan', function(){
                $('#premiumTeamPlan').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>
@endpush
