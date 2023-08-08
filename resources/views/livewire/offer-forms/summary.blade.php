<div class="{{ !$isPdfMode ? 'container' : 'container-fluid' }} my-5">
    @push('stylesheets')
        <style>
            .collapsed img {
                transform: rotate(180deg);
            }
        </style>
    @endpush
    @if(!$isPrefill)
        <div class="row mb-4">
            <div
                class="col-{{ !$isPdfMode ? '12' : '6' }} col-lg-6"
                @if(!$isPdfMode)
                    x-data="{address: '{{ $this->variables[\App\Models\OfferForms\OfferFormOffer::VAR_PROPERTY_ADDRESS] ?? $this->variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_ADDRESS] ?? '' }}'}"
                    x-init="
                        if (address !== '') {
                            googleMaps.load().then((google) => {
                                let geocoder = new google.maps.Geocoder();
                                let map;

                                let latlng = new google.maps.LatLng(-34.397, 150.644);
                                let mapOptions = {zoom: 16, center: latlng};
                                map = new google.maps.Map(document.getElementById('map'), mapOptions);

                                geocoder.geocode( { 'address': address}, function(results, status) {
                                    if (status === 'OK') {
                                    map.setCenter(results[0].geometry.location);
                                        var marker = new google.maps.Marker({
                                            map: map,
                                            position: results[0].geometry.location
                                        });
                                    } else {
                                        alert('Geocode was not successful for the following reason: ' + status);
                                    }
                                });

                            })
                        }
                    "
                @endif
            >
                <h5 class="fw-bold">
                    <img class="rounded-circle rounded-icon shadow-sm me-2"
                         src="{{ $isPdfMode ? public_path('img/agent/icons/map.svg') : asset('img/agent/icons/map.svg')}}"
                         alt="">
                    {{ $this->variables[\App\Models\OfferForms\OfferFormOffer::VAR_PROPERTY_ADDRESS] ?? $this->variables[\App\Models\OfferForms\OfferFormOffer::VAR_FORM_ADDRESS] ?? '' }}
                </h5>
                <div class="thumbnail my-2 shadow{{ $isPdfMode ? '' : '-sm'}} rounded"

                     style="background-image: url({{ $isPdfMode ? public_path('img/agent/completed-offerforms/cof2.png') : '/img/agent/completed-offerforms/cof2.png' }});background-position:
                         center;background-size: cover;background-repeat: no-repeat; height: 275px"

                    id="map"
                     wire:ignore
                >

                </div>
            </div>
            <div class="col-{{ !$isPdfMode ? '12' : '6' }} col-lg-6">
                <h5 class="fw-bold">
                    <img class="rounded-circle rounded-icon shadow-sm me-2"
                         src="{{ $isPdfMode ? public_path('img/menu-icons/agent-icon.svg') : asset('img/menu-icons/agent-icon.svg')}}"
                         alt="">
                    Agent Contact Information
                </h5>
                <div class="card border-0 py-4 shadow{{ $isPdfMode ? '' : '-sm'}}" style="height: 275px">
                    <div class="card-body d-flex justify-content-between">
                        <div class="align-self-center">
                            <img class="rounded-circle summery-profile"
                                 src="{{ $isPdfMode ? $agent->profile_photo_path_for_pdf : $agent->profile_photo_url }}"
                                 alt=""
                            />
                        </div>
                        <div class="text-end">
                            <h3 class="text-primary-light fw-bold">{{ $agent->full_name }}</h3>
                            <p class="fw-bold fs-18">{{ $agent->phone }}</p>
                            <p>{{ $agent->email }}</p>
                            <p>{{ $agent->address }}</p>
                            <p>{{ $agent->other_inputs['website'] ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(!$isPdfMode)
        <div class="text-end">
            <div class="mb-4 btn-group gap-2">
                <a href="javascript:void(0)"
                   class="btn btn-primary-light-black-hover d-none px-4 rounded expandBtn fw-bold mb-2 mb-lg-0">Expand
                    All
                    <img src="{{asset('v1.1/icons/collapsed-white-icon.svg')}}" class="w-20 mt0-5 ms-2"
                         style="transform: rotate(180deg)" alt=""> </a>
                <a href="javascript:void(0)"
                   class="btn btn-primary-light-black-hover px-4 rounded collapseBtn fw-bold mb-2 mb-lg-0">Collapse All
                    <img src="{{asset('v1.1/icons/collapsed-white-icon.svg')}}" class="w-20 mt0-5 ms-2" alt=""></a>
            </div>
        </div>
    @endif

    {{-- Checkbox check to all [Start] --}}
    @if($offer->status && !$isPdfMode)
        <div class="position-relative mb-5 pb-2 mb-lg-0">
            <div class="form-group fw-bold position-absolute checkall-card mb-5 mb-lg-0" style="left: -110px; top: 7px">
                <label for="toggleAllCheckbox" class="mt-15">Check All</label> <input type="checkbox"
                                                                                      class="buyer-info-checkbox summery-checkbox form-check-input"
                                                                                      wire:model.defer="checkedAll"
                                                                                      wire:change="toggleAllCheckbox"
                                                                                      id="toggleAllCheckbox"/>
            </div>
        </div>
    @endif
    {{-- Checkbox check to all [End] --}}
    @php
        $prefillEditableSections = collect([]);
    @endphp
    {{--  Categorized [Start]  --}}
    @foreach($categorizedSections as $categorizedSection)
        @php
            $prefillEditableSections = $prefillEditableSections->merge($categorizedSection['sections']);
        @endphp
        @includeWhen(count($categorizedSection['sections']) > 0, 'livewire.offer-forms.partials.summary.category', ['image' => $isPdfMode ? public_path("storage/{$categorizedSection['category']->image}") : asset("storage/{$categorizedSection['category']->image}"), 'name' => $categorizedSection['category']->name, 'sections' => $categorizedSection['sections'], 'submitted' => $offer->status])
    @endforeach
    {{--  Categorized [End]  --}}

    {{-- Checkbox check to all [End] --}}
    @includeWhen(count($uncategorizedSections) > 0, 'livewire.offer-forms.partials.summary.category', ['image' => $isPdfMode ? public_path("img/dash/offer-forms/dash.svg") : asset("img/dash/offer-forms/dash.svg"), 'name' => 'Uncategorized', 'sections' => $uncategorizedSections, 'submitted' => $offer->status])
    {{--  Uncategorized [End]  --}}



    @if(count($uncategorizedSections) > 0)
        @php
            $prefillEditableSections = $prefillEditableSections->merge($uncategorizedSections);
        @endphp
    @endif
    @if($isPrefill)
        @include('livewire.offer-forms.partials.summary.section-edit-carousel-modal', ['sections' => $prefillEditableSections])
    @endif

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('.expandBtn').click(function () {
                    $('.collapsedOrExpandSection').collapse('show');
                    $('.expandBtn').addClass('d-none');
                    $('.collapseBtn').removeClass('d-none');
                });

                $('.collapseBtn').click(function () {
                    $('.collapsedOrExpandSection').collapse('hide');
                    $('.expandBtn').removeClass('d-none');
                    $('.collapseBtn').addClass('d-none');
                });
            })
        </script>
    @endpush
</div>

