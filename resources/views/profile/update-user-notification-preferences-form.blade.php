<div class="card border-0 mb-4 shadow-sm p-3 " id="">
    <div class="card-body px-2 px-lg-5 ">

        <h4 class="fw-bold text-primary-light text-center">Notifications

            {{--Start Popover--}}

            <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                data-bs-container="body"
                data-bs-toggle="popover"
                data-bs-html="true"
               data-bs-content="<p>How notifications work and how to turn them on ...</p>
               <br/><a href='#' class='openModalNotification text-decoration-none text-dark'
               >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
               aria-hidden="true">
            </button>

            <!-- Modal -->
            <div class="modal fade" id="notificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                                How notifications work and how to turn them on or off.
                            </p>

                            <div class="first-time-user-popup-video"

                            >
                                <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                       controls>
                                    <source src="{{asset('video/offerform/notifications.mp4')}}" type="video/mp4">
                                </video>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            {{--End Popover--}}

        </h4>

        <!-- Modal -->
        <div class="modal fade" id="notifications" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 600px;">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                        </button>
                    </div>
                    <div class="modal-body firstTimeSetupChecklist px-3 mt-1">
                        <div class="first-time-user-popup-video">
                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-3 object-cover" controls>
                                <source src="{{asset('video/offerform/notifications.mp4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between my-4 notification-card">
            <div class="form-group text-center">
                <h6 class="fw-bold">Email</h6>
                <div class="form-check form-switch">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="email"
                        name="email"
                        wire:model.defer="state.email"
                        wire:change.debounce.500ms="update"
                    />
                </div>
            </div>

            <div class="form-group text-center">
                <h6 class="fw-bold">TC Email</h6>
                <div class="form-check form-switch">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="tc_email"
                        wire:model="state.tc_email"
                        wire:change.debounce.500ms="update"
                    />
                </div>
            </div>

            <div class="form-group text-center">
                <h6 class="fw-bold">Text </h6>
                <div class="form-check form-switch">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="text"
                        wire:model="state.text"
                        wire:change.debounce.500ms="update"
                    />
                </div>
            </div>

            <div class="form-group text-center">
                <h6 class="fw-bold">Client email</h6>
                <div class="form-check form-switch">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="user_email"
                        wire:model="state.user_email"
                        wire:change.debounce.500ms="update"
                    />
                </div>
            </div>
            @if($ownedTeam)
                <div class="form-group  text-center">
                    <h6 class="fw-bold">Team notifications</h6>
                    <div class="form-check form-switch">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="team"
                            wire:model="state.team"
                            wire:change.debounce.500ms="update"
                        />
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <x-jet-action-message class="text-success" on="saved">
            {{ __('Updated successfully!') }}
        </x-jet-action-message>
        <div wire:loading wire:target="update">
            Updating...
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.notificationSetting').click(function () {
            if(location.hash == "#notificationTab"){
                $('html, body').animate({
                    scrollTop: $(".notificationTab").offset().top
                }, 1000);
            }
        });
    </script>

    <script>
        $('.upGradePricingTable').click(function () {
            if(location.hash == "#upGradePricingTable"){
                $('html, body').animate({
                    scrollTop: $(".upGradePricingTable").offset().top
                }, 1000);
            }
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
            $(document).on('click', '.openModalNotification', function(){
                $('#notificationModal').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>
@endpush
