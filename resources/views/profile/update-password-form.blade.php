<form wire:submit.prevent="updatePassword" class="card border-0 mb-4 shadow-sm p-3 notificationTab" id="notificationTab">
    <div class="card-body">


        <h4 class="fw-bold text-primary-light text-center">Change Password

            {{--Start Popover--}}

            <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                    data-bs-container="body"
                    data-bs-toggle="popover"
                    data-bs-html="true"
               data-bs-content="<p>You can change your password...</p>
               <br/><a href='#' class='openModalChangePassword text-decoration-none text-dark'
               >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
               aria-hidden="true">
            </button>

            <!-- Modal -->
            <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                You can change your password here
                            </p>

                            <div class="first-time-user-popup-video">
                                <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                       controls>
                                    <source src="{{asset('video/offerform/change-password.mp4')}}" type="video/mp4">
                                </video>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{--End Popover--}}


        </h4>

        <!-- Modal -->
        <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 600px;">
                <div class="modal-content">
                    <div class="modal-header border-0 text-center">
                        <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                        </button>
                    </div>
                    <div class="modal-body firstTimeSetupChecklist px-3 mt-1">
                        <div class="first-time-user-popup-video">
                            <video width="100%" height="320" class="stopVideoOnModalHide rounded-3 object-cover" controls>
                                <source src="{{asset('video/offerform/change-password.mp4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
           @role('agent')
                <div class="form-group col-12  col-lg-4 ">
                    <label for="" class="fw-500 fs-14">Current Password</label>
                    <x-input type="password" wire:model.defer="state.current_password" name="current_password" autocomplete="current-password"
                             class="rounded"/>
                </div>
            @endrole

            <div class="form-group col-12 @role('agent') col-lg-4 @else col-lg-6 @endrole ">
                <label for="" class="fw-500 fs-14">New Password</label>
                <x-input type="password" name="password" wire:model.defer="state.password" class="rounded"  autocomplete="new-password" />
            </div>
            <div class="form-group col-12 @role('agent') col-lg-4 @else col-lg-6 @endrole ">
                <label for="" class="fw-500 fs-14">Confirm Password</label>
                <x-input type="password" name="password_confirmation" wire:model.defer="state.password_confirmation" autocomplete="new-password" class="rounded"/>
            </div>
        </div>
        <div class="col-12 mt-4">
            <x-jet-action-message class="mr-3 text-success fw-bold" on="saved">
                {{ __('Your password has been changed successfully.') }}
            </x-jet-action-message>
            <div class="button text-start text-lg-end">
                <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-primary-light"
                   wire:click.prevent="updatePassword">
                    <div wire:loading.remove wire:target="updatePassword">
                        Update
                    </div>
                    <div wire:loading wire:target="updatePassword">
                        Updating...
                    </div>
                </a>
            </div>
        </div>
    </div>
</form>

@push('scripts')


    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalChangePassword', function(){
                $('#changePassword').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>
@endpush
