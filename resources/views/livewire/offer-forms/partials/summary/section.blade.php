<div class="card-body row position-relative rounded-2 p-0 mb-3">
    @if($submitted && !$isPdfMode)
        <div class="form-group fw-bold position-absolute buyer-content-information ">
            <input
                type="checkbox"
                class="buyer-info-checkbox summery-checkbox form-check-input expect-all-checkboxes"
                value="{{ $section->id }}"
                wire:change="onChangeCheckbox"
                wire:model.defer="selectedFieldsToExport"
            />
        </div>
    @endif

    <div class=" @if($submitted) col-12 @else col-12  col-md-9 col-lg-11  px-1 px-lg-1 mb-2 mb-lg-0 @endif">
        <div class="col-inner bg-primary-light text-white rounded px-3 py-3">
            <div class="row">
                <div class="col-{{ !$isPdfMode ? '12' : '6' }} col-md-6 mb-2 mb-lg-0 d-flex align-items-center">
                    <div class="rounded-circle p-1 me-2">
                        <img
                            class="w-22"
                            src="{{ $image ?? ($isPdfMode ? public_path('img/agent/icons/buyer.svg') : asset('img/agent/icons/buyer.svg'))}}"
                            {{--                            src="{{ $isPdfMode ? public_path('img/agent/icons/glyph-price.svg') : asset('img/agent/icons/glyph-price.svg') }}"--}}
                            alt=""
                            style="filter: brightness(0) invert(1)"
                        />
                    </div>
                    <p class="mb-0 text-white">
                        @php
                            $label = str_replace($variablesReplaceFrom, $this->variablesReplaceTo, $section->title ?? strip_tags($section->short_description));
                        @endphp
                        {!! $label  !!}
                    </p>
                </div>
                <div
                    class="col-{{ !$isPdfMode ? '12 text-center' : '6 text-end' }} col-md-6 text-md-end align-self-center">
                    <span class="text-white mb-0 fw-bolder py-1 px-2 rounded"
                          style="{{ $submitted ?  'background-color: #5A1E9A' : ''}}">
                        {!! section_user_response($section, $submitted)  !!}
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if(!$submitted)
        <div class="col-12 col-md-3 col-lg-1 px-1 px-lg-1 mb-2 mb-lg-0">
            <a href="#"
               class="text-decoration-none prefill-carousel-modal"
               data-bs-toggle="modal"
               @if($isPrefill) data-bs-target="#prefillCarouselModal" data-section-id="{{ $section->offer_form_section_id }}" @else data-bs-target="#editSection{{ $section->id }}Modal" @endif
            >
                <div class="inner-col bg-primary-lighter text-center text-white p-0 rounded py-3" style="height: 100%">
                    <p
                        class="mb-0 mt-1"
                    >
                        <img
                            src="{{asset('img/menu-icons/white-pencil.svg')}}" class="w-14 me-1 me-lg-2"
                            alt=""/>
                        {{ $isPrefill ? 'Fill' : 'Edit' }}
                    </p>

                </div>
            </a>
        </div>
        @includeWhen(!$isPrefill, 'livewire.offer-forms.partials.summary.section-edit-modal')
    @endif
</div>

