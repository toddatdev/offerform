<div wire:submit.prevent="update" class="card border-0 mb-4 shadow-sm p-3">
    <div class="card-body">
        <h4 class="fw-bold text-primary-light text-capitalize">Social media Links

            {{--Start Popover--}}

            <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                    data-bs-container="body"
                    data-bs-toggle="popover"
                    data-bs-html="true"
               data-bs-content="<p>Social media Links ...</p>
               <br/><a href='#' class='openModalSocialMediaLinks text-decoration-none text-dark'
               >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
               aria-hidden="true">
            </button>

            <!-- Modal -->
            <div class="modal fade" id="socialMediaLinks" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 600px;">
                    <div class="modal-content">
                        <div class="modal-header border-0 text-center">
                            <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                            </button>
                        </div>

                        <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                        >
                            <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>

                            <div  class="first-time-user-popup-video"
                            >
                                <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                       controls>
                                    <source src="{{asset('video/offerform/social-media-links.mp4')}}" type="video/mp4">
                                </video>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{--End Popover--}}

        </h4>


        <hr>
        <div class="row mb-3">
            <div class="col-12 col-lg-2">
                <div class="socialicon">
                    <img class="" width="60" src="{{asset('img/menu-icons/facebook.png')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label for="" class="fw-500">Facebook link</label>
                    <x-input type="text" class="" placeholder="" wire:model.defer="state.facebook" name="facebook"/>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-lg-2">
                <div class="socialicon">
                    <img class="" width="50" src="{{asset('img/menu-icons/Instagram.png')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label for="" class="fw-500">Instagram link</label>
                    <x-input type="text" class="" placeholder="" wire:model.defer="state.instagram" name="instagram"/>
                </div>
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-12 col-lg-2">
                <div class="socialicon">
                    <img class="" width="60" src="{{asset('img/menu-icons/twitter.png')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label for="" class="fw-500">Twitter link</label>
                    <x-input type="text" class="" placeholder="" wire:model.defer="state.twitter" name="twitter"/>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-lg-2">
                <div class="socialicon">
                    <img class="" width="60" src="{{asset('img/menu-icons/youtube.png')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label for="" class="fw-500">YouTube link</label>
                    <x-input type="text" class="" placeholder="" wire:model.defer="state.youtube" name="youtube"/>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-lg-2">
                <div class="socialicon">
                    <img class="" width="60" src="{{asset('img/menu-icons/tiktok.png')}}" alt="">
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="form-group">
                    <label for="" class="fw-500">TikTok link</label>
                    <x-input type="text" class="" placeholder="" wire:model.defer="state.tiktok" name="tiktok"/>
                </div>
            </div>
        </div>

        <div class="text-start text-lg-end">
            <div class="">
                <x-jet-action-message class="text-success me-2" on="saved">
                    {{ __('Saved!') }}
                </x-jet-action-message>
                <a href="" class="btn btn-lg shadow-sm px-5 rounded-pill btn-setting-light" style="width: 170px;"
                   wire:click.prevent="update">

                    <span wire:loading.remove wire:target="update">
                        Save
                    </span>
                    <span wire:loading wire:target="update">
                        Save...
                    </span>
                </a>
            </div>
        </div>
    </div>

</div>
@push('scripts')

    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalSocialMediaLinks', function(){
                $('#socialMediaLinks').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

@endpush
