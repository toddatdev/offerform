{{--                    @push('modals')--}}
@php
    $ss = $section;
    if (str_contains($section->slug, 'mortgage-calculator') || str_contains($section->slug, 'seller-financing')) {
        $sid = str_replace(['mortgage-calculator-', 'seller-financing-', '-offer-amount', '-down-payment'], ['', '', '', ''], $section->slug);

        $ss = \App\Models\OfferForms\OfferFormSubmittedSection::find($sid);

    }
@endphp

<!-- Modal -->
<div class="modal fade" id="editSection{{ $section->id }}Modal" tabindex="-1"
     aria-labelledby="editSection{{ $section->id }}ModalLabel"
     aria-hidden="true">
    <div class="modal-dialog max-width-980">
        <div class="modal-content rounded-20">
            <div class="modal-header border-0 ms-auto pb-0">
                <a href="javascript:void(0)"
                   class="text-decoration-none"

                   data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30 svg-hover-black" alt="">
                </a>
            </div>
            <div class="modal-body buyer-final-summery-page p-0">
                <livewire:offer-forms.steps.step-section
                    :step-section="$ss"
                    :loop-index="($loop->parent ? $loop->parent->index : 0) + $loop->index"
                    :route-is-edit="false"
                    :key="time().$ss->id"
                    :offer-form-offer="$offer"
                    :required-fields-not-filled="[]"
                />
            </div>
        </div>
    </div>
</div>


{{--                    <div class="modal fade" id="editSection{{ $section->id }}Modal" tabindex="-1"--}}
{{--                         aria-labelledby="editSection{{ $section->id }}ModalLabel"--}}
{{--                         aria-hidden="true">--}}
{{--                        <div class="modal-dialog modal-xl">--}}
{{--                            <div class="modal-content rounded-30 border-0 bg-transparent">--}}
{{--                                <livewire:offer-forms.steps.step-section--}}
{{--                                    :step-section="$ss"--}}
{{--                                    :loop-index="($loop->parent ? $loop->parent->index : 0) + $loop->index"--}}
{{--                                    :route-is-edit="false"--}}
{{--                                    :key="time().$ss->id"--}}
{{--                                    :offer-form-offer="$offer"--}}
{{--                                    :required-fields-not-filled="[]"--}}
{{--                                />--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                        @endpush--}}
