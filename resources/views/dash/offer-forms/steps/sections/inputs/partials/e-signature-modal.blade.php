<!-- Modal -->
<div
    class="modal fade hideableModal"
    id="eSignature"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
    x-data="{
        modalEventDetail: null,
        signature: null,
        signatureText: null
    }"
    @e-signature-modal.window="
        $('#eSignature').modal('show');
        $('.sign-tabs').removeClass('active');
        $('.sign-tabs').find('button').removeClass('active');
        $('.sign-tabs').attr('aria-selected', 'false');
        $('#introSign').addClass('active');
        $('#sign_clear').trigger('click');

        signature = null;
        signatureText = null;
        modalEventDetail = event.detail;
    "
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="border-0 bg-primary-light text-white d-flex justify-content-between align-items-center p-3">
                <span> </span>
                <h3>Adopt Your Signature</h3>
                <a href="javascript:void(0)"
                   class="text-decoration-none"
                   data-bs-dismiss="modal"
                   aria-label="Close"
                >
                    <img src="{{asset('v1.1/icons/white-cross-icon.svg')}}" width="32" alt="" />
                </a>
            </div>
            <div class="modal-body">
                <div class="card border-0">
                    <div class="card-body my-1 py-0">
                        <div class="sign my-3">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane sign-tabs active" id="introSign" role="tabpanel" aria-labelledby="introSign-tab">
                                  <div class="text-center">
                                      <p class="fw-500 mb-1">Confirm Your Signature</p>
                                      <p class="bg-primary-light text-white rounded py-2">Cody Tuma</p>
                                      <p class="bg-primary-lighter text-white rounded py-3 fs-32 quintessential-font fw-600">Cody Tuma</p>
                                  </div>
                                </div>
                                <div class="tab-pane sign-tabs" id="typeSign" role="tabpanel" aria-labelledby="typeSign-tab">
                                    <div class="d-flex justify-content-start align-items-center mb-3">
                                        <img src="{{asset('v1.1/icons/draw-sign.svg')}}" width="32" alt="" />
                                        <p class="mb-0 ms-3 fs-20 fw-500">Type Your Signature</p>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control form-control-lg py-4 bg-primary-lighter text-white outline-none text-center"
                                        x-model="signatureText"
                                    />
                                </div>
                                <div class="tab-pane sign-tabs" id="drawSign" role="tabpanel" aria-labelledby="drawSign-tab">
                                    <div class="d-flex justify-content-start align-items-center mb-3">
                                        <img src="{{asset('v1.1/icons/draw-sign.svg')}}" width="32" alt="">
                                        <p class="mb-0 ms-3 fs-20 fw-500">Draw Your Signature</p>
                                    </div>
                                    <div class="position-relative"
                                         @e-signature-modal.window="clear()"
                                        x-data="{
                                            signaturePadId: $id('signature'), // track the pad ID when showing notification
                                            signaturePad: null,
                                            ratio: null,
                                            // signature: null, // variable to save the signature
                                            init() {
                                                this.signaturePad = new SignaturePad($refs.canvas, {
                                                    penColor: '#ffffff',
                                                    backgroundColor: '#9C4EDD',
                                                });
                                                // load if the signature is not null (usefull to show the saved signature in db)
                                                if (this.signature) {
                                                    this.signaturePad.fromDataURL(this.signature, { ratio: this.ratio });
                                                }

                                                this.signaturePad.addEventListener('endStroke', () => {
                                                    signatureText = null;
                                                    signature = this.signaturePad.toDataURL();
                                                })
                                            },
                                            save() {
                                                this.signature = this.signaturePad.toDataURL(); // save as data:image/png;base64,...
                                                this.$dispatch('signature-saved', this.signaturePadId); // notify saved
                                            },
                                            clear() {
                                                this.signaturePad.clear(); // clear the signature pad
                                                this.signature = null;
                                            },
                                            resizeCanvas() {
                                                this.ratio = Math.max(window.devicePixelRatio || 1, 1);
                                                this.$refs.canvas.width = this.$refs.canvas.offsetWidth * this.ratio;
                                                this.$refs.canvas.height = this.$refs.canvas.offsetHeight * this.ratio;
                                                this.$refs.canvas.getContext('2d').scale(this.ratio, this.ratio);
                                            }
                                        }"
                                        @resize.window="resizeCanvas"
                                    >

                                        <a href="#" x-on:click.prevent="clear()" class="text-sm font-medium text-gray-700 underline position-absolute sign-cross-icon" id="sign_clear">
                                            <img src="{{asset('v1.1/icons/dark-cross-icon.svg')}}" class="w-14" alt="">
                                        </a>

                                       <div class="text-center bg-primary-light py-2 rounded signature-pad" >
                                           <canvas
                                               x-ref="canvas"
                                               class="rounded bg-primary-light text-white border"
                                               style="color: #000000; border-style: dashed !important;height: 150px !important;"
                                           ></canvas>
                                       </div>


{{--                                        <div class="flex mt-2 space-x-2">--}}
{{--                                           --}}
{{--                                            <a href="#" x-on:click.prevent="save()" class="text-sm font-medium text-gray-700 underline">--}}
{{--                                                Save--}}
{{--                                            </a>--}}
{{--                                            <!-- A notification component to indicate if it is saved -->--}}
{{--                                            <span--}}
{{--                                                x-data="{--}}
{{--                                                    open: false,--}}
{{--                                                    saved(e) {--}}
{{--                                                        // can have multiple in the same page. Only show it's parent event--}}
{{--                                                        if (e.detail !== this.signaturePadId) {--}}
{{--                                                            return;--}}
{{--                                                        }--}}
{{--                                                        this.open = true;--}}
{{--                                                        setTimeout(() => { this.open = false }, 900);--}}
{{--                                                    }--}}
{{--                                                }"--}}
{{--                                                x-show="open"--}}
{{--                                                @signature-saved.window="saved"--}}
{{--                                                x-transition--}}
{{--                                                class="text-sm font-medium text-green-700"--}}
{{--                                                style="display:none"--}}
{{--                                            >--}}
{{--                                                Saved !--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <p>
                            By Clicking adopt I have read and understand OfferForms terms of service. I agree my electronic signature and initials shall have
                            the same force and effect as my written signature.
                        </p>
                        <div class="sign-tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs border-bottom-0 justify-content-center  mb-3" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                </li>
                                <li class="nav-item mx-2 mb-3 mbl-lg-1" role="presentation">
                                    <button
                                        class="nav-link rounded-pill px-3"
                                        id="typeSign-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#typeSign"
                                        type="button"
                                        role="tab"
                                        aria-controls="typeSign"
                                        aria-selected="true"
                                    >
                                        <img
                                            src="{{asset('v1.1/icons/type-icon.svg')}}"
                                            class="w-22 me-2"
                                            alt=""
                                        />
                                        Type Signature
                                    </button>
                                </li>
                                <li class="nav-item mx-2 mb-3 mbl-lg-1" role="presentation">
                                    <button
                                        class="nav-link rounded-pill px-3"
                                        id="drawSign-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#drawSign"
                                        type="button"
                                        role="tab"
                                        aria-controls="drawSign"
                                        aria-selected="false"
                                    >
                                        <img
                                            src="{{asset('v1.1/icons/draw-icon.svg')}}"
                                            class="w-22 me-2"
                                            alt=""
                                        />
                                        Adopt and sign
                                    </button>
                                </li>
                            </ul>
                            <button class="btn btn-primary-light-black-hover w-100 rounded" @click.prevent="modalEventDetail.wireTarget.call('submitSignature', signatureText || signature, modalEventDetail.isBuyer2)" wire:loading.attr="disabled">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

