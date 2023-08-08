<div class="modal fade"
     id="prefillCarouselModal"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="prefillCarouselModalLabel"
     aria-hidden="true"
     wire:ignore.self
>
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-3">
            <div class="modal-header border-0 pb-0 ms-auto">
                <a href="javascript:void(0)"
                   class="text-decoration-none"
                   data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                </a>

            </div>
            <div class="modal-body">
                <div id="prefillCarouselFade" class="carousel slide carousel-slide" data-bs-ride="carousel" data-bs-interval="false">
                    <div class="carousel-inner">
                        @php
                            $sectionIds = [];
                        @endphp
                        @foreach($sections as $section)
                            @continue(in_array($section->offer_form_section_id, $sectionIds))
                            @php
                                $sectionIds[] = $section->offer_form_section_id;

                                $ss = $section;
                                if (str_contains($section->slug, 'mortgage-calculator') || str_contains($section->slug, 'seller-financing')) {
                                    $sid = str_replace(['mortgage-calculator-', 'seller-financing-', '-offer-amount', '-down-payment'], ['', '', '', ''], $section->slug);

                                    $ss = \App\Models\OfferForms\OfferFormSubmittedSection::find($sid);

                                }

                                if ($section->getSubType() === 'logic') {
                                    $ss = \App\Models\OfferForms\OfferFormSection::find($section->offer_form_section_id);
                                }
                            @endphp
                            <div class="carousel-item bg-white {{ $loop->iteration === 1 ? 'active' : ''}}" id="slide-{{ $section->offer_form_section_id }}" wire:ignore.self>
                                <livewire:offer-forms.steps.step-section
                                    :step-section="$ss"
                                    :loop-index="$loop->index"
                                    :route-is-edit="false"
                                    :route-is-preview="false"
                                    :key="time().$ss->id"
                                    :offer-form-offer="$offer"
                                    :required-fields-not-filled="[]"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3 align-items-center">
                    <x-button class="btn-primary-light-black-hover px-4 me-3" data-bs-target="#prefillCarouselFade" data-bs-slide="prev"><i class="fa fa-arrow-left me-2"></i>Previous</x-button>
                    <x-button
                        id="prefillCarouselTabPress"
                        class="btn-primary-light-black-hover px-5"
                        data-bs-target="#prefillCarouselFade"
                        data-bs-slide="next">Next<i class="fa fa-arrow-right ms-2"></i> </x-button>
                </div>
                <p class="mb-0 text-center mt-2">Press Tab to go to next question</p>

            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
        <script>
            $(function () {
               $(document).keyup(function(e){
                   if (e.which === 9) {
                       e.preventDefault();
                       $('#prefillCarouselTabPress').trigger('click');
                   }
               });

               $(document).on('click', '.prefill-carousel-modal', function (e) {
                    let sectionId = $(this).data('section-id');
                    $('.carousel-item').removeClass('active');
                    $(`#slide-${sectionId}`).addClass('active');


                   $('.form-builder').children('.card').removeClass('shadow');
               });


            });
        </script>
    @endpush
@endonce
