<div>
    @push('stylesheets')
        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }

            .donut-inner {

            }

            .donut-inner .percent {
                font-size: 65px;
                margin-bottom: 3px;
                margin-top: 0;
                font-weight: bolder;
            }

            .donut-inner .percent small {
                font-size: 35px;
                font-weight: bolder;
                font-family: Arial;
            }

            .donut-inner .price {
                margin: 0;
                font-size: 30px;
            }
        </style>
    @endpush

    @auth
        @includeWhen($routeIsPreview, 'livewire.offer-forms.steps.partials.preview-form-back-button')
        @includeWhen(!$routeIsPreview && strpos($offerFormOffer->slug, 'view-form-') !== false, 'livewire.offer-forms.steps.partials.view-form-back-button')
    @else
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
    @endauth


    <div class="{{ $summary ? '' : 'd-none' }} " style="">

        <div class="card rounded-3 border-0 shadow mb-4">
            <div class="card-body text-center py-4">
                <h4 class="mb-4" style="line-height: 30px;">Please review the details below for accuracy. </h4>
                <p class="mb-0 fw-400 fs-16">
                    If you have questions on any of the terms of would like to edit your answer,
                    just click on the item.</br> When finished click submit to send your form to
                    <b>{{ $agent->full_name }}</b>
                </p>
            </div>
        </div>

        <div class="card rounded-3 border-0 shadow mb-4">
            <div class="card-body">
                @if($offerFormOffer)
                    <livewire:offer-forms.summary view-type="buyer" :offer-form="$offerForm" :offer="$offerFormOffer"/>
                @endif
            </div>
        </div>


        @php
            $bg = asset('img/dash/offer-forms/how-much-to-offer.png');
            $vid = null;
            if ($thumbnailUrl = youtube_video_thumbnail($agent->video)) {
                $bg = $thumbnailUrl;
                $vid = youtube_video_id_from_url($agent->video);
            } elseif (!is_null($agent->video) && Storage::disk('public')->exists($agent->video) && Storage::disk('public')->exists(str_replace('.mp4', '.png', $agent->video))) {
                $bg = Storage::disk('public')->url(str_replace('.mp4', '.png', $agent->video));
            }
        @endphp

        {{-- youtube video check --}}
        @if(!is_null($agent->video))
            <div
                x-data="{
                    videoUrl: '{{ video_url($agent->video) }}',
                    thumbnailUrl: '{{$bg}}',
                    playableUrl: '{{$bg}}',
                    isPlaying: false,
                    ytPlayer: null,
                    playOrPauseVideo() {
                        if(this.isPlaying) {
                            this.isPlaying = false;
                            this.playableUrl = this.thumbnailUrl;
                            if (this.ytPlayer !== null) this.ytPlayer.pause();
                            else $refs.local_summary.pause();
                        } else {
                            this.playableUrl = this.videoUrl;
                            this.isPlaying = true;
                            if (this.ytPlayer !== null)  this.ytPlayer.load('{{ $vid }}', true);
                            else $refs.local_summary.play();

                        }
                    }
                }"
                x-init="
                    @if(!is_null($vid))
                        ytPlayer = new YTPlayer('#ytsummaryplayer');
                    @endif
                "
                @click.away="isPlaying ? playOrPauseVideo() : ''"
                style="height: 320px"
            >
                <div class="rounded-15 mt-2"
                     x-show="!isPlaying"
                     style="background-image: url('{{ $bg }}');
                         background-position: center; background-size: cover; background-repeat: no-repeat; height: 320px">
                    <div
                        class="text-center text-white px-2 px-lg-5 py-2  d-flex align-items-center justify-content-center"
                        style="height: 320px">
                        <div>
                            <h5 class="fw-normal d-none d-lg-block mb-2">Learn More About {{ $agent->full_name }}</h5>
                            <a
                                href="javascript:void(0)"
                                @click.prevent="playOrPauseVideo()"
                            >
                                <i class="fa fa-play bg-white p-3 fs-16 text-center rounded-circle text-primary shadow"></i>
                            </a>
                            <h5 class="fw-normal d-none d-lg-block mt-2">Click Play</h5>
                        </div>
                    </div>
                </div>

                <div class="py-3 rounded-15 mt-2 bg-white" x-show="isPlaying" style="display: none">
                    @if(!is_null($vid))
                        <div class="w-100 rounded-15" id="ytsummaryplayer" style="height: 320px;"></div>
                    @else
                        <video controls width="100%" height="320" x-ref="local_summary">
                            <source src="{{ video_url($agent->video) }}" type="video/mp4"/>
                            Your browser does not support HTML video.
                        </video>
                        {{--                        <iframe class="w-100 rounded-15" frameborder="0" allowfullscreen="1" id="clickForMoreInfo"--}}
                        {{--                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                        {{--                                height="320"--}}
                        {{--                                :src="`${playableUrl}?autoplay=1`">--}}
                        {{--                        </iframe>--}}
                    @endif
                </div>
            </div>
        @endif

        <div class="card rounded-3 border-0 shadow my-5" x-data="">
            <div class="card-body">
                <div class="row mb-4 mt-2">

                    @if($offerFormOffer && $offerFormOffer->textSignature() !== null)
                        <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                            <div class="row">
                                <div class="col-8 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center"
                                         style="background-color: #9C4EDD50">
                                        <a href="#!" class="text-decoration-none"
                                           @click.prevent="$dispatch('e-signature-modal', {wireTarget: @this, isBuyer2:  false})"
                                        >
                                            <h4 class="text-dark mb-0 text-center btn-signature fw-bold">
                                                {{ $offerFormOffer && $offerFormOffer->textSignature() !== null ? $offerFormOffer->textSignature() : 'Click here to type signature' }}
                                            </h4>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-4 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center"
                                         style="background-color: #9C4EDD80">
                                        <div>
                                            <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                            @if($offerFormOffer && $offerFormOffer->textSignature() !== null && $offerFormOffer->signed_at !== null)
                                                <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at->timezone(session('ip_position:timezone', 'UTC'))->format('m/d/y g:i A') }}</p>
                                            @else
                                                <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:--
                                                    --</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                            <div class="row">
                                <div class="col-8 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center"
                                         style="background-color: #9C4EDD50">
                                        <a href="#!" class="text-decoration-none"
                                           @click.prevent="$dispatch('e-signature-modal', {wireTarget: @this, isBuyer2: false})"
                                        >
                                            @if($offerFormOffer && $offerFormOffer->pngSignature() !== null)
                                                <img src="{{ $offerFormOffer->pngSignature()  }}"
                                                     style="height: 50px !important;"/>
                                            @else
                                                <h4 class="text-dark mb-0 text-center btn-signature fw-bold">Click
                                                    here to draw signature</h4>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="col-4 px-0 align-self-center">
                                    <div class="h-60 d-flex justify-content-center align-items-center"
                                         style="background-color: #9C4EDD80">
                                        <div>
                                            <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                            @if($offerFormOffer && $offerFormOffer->pngSignature() !== null && $offerFormOffer->signed_at !== null)
                                                <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at->format('m/d/y g:i A') }}</p>
                                            @else
                                                <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:--
                                                    --</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($offerFormOffer && ($offerFormOffer->getVariable(\App\Models\OfferForms\OfferFormOffer::VAR_ADDITIONAL_BUYER_FIRST_NAME) !== '' || $offerFormOffer->getVariable(\App\Models\OfferForms\OfferFormOffer::VAR_ADDITIONAL_BUYER_LAST_NAME) !== ''))
                        @if($offerFormOffer && $offerFormOffer->textSignature2() !== null)
                            <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                                <div class="row">
                                    <div class="col-8 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center"
                                             style="background-color: #9C4EDD50">
                                            <a href="#!" class="text-decoration-none"
                                               @click.prevent="$dispatch('e-signature-modal', {wireTarget: @this, isBuyer2:  true})"
                                            >
                                                <h4 class="text-dark mb-0 text-center btn-signature fw-bold">
                                                    {{ $offerFormOffer && $offerFormOffer->textSignature2() !== null ? $offerFormOffer->textSignature2() : 'Click here to type signature' }}
                                                </h4>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-4 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center"
                                             style="background-color: #9C4EDD80">
                                            <div>
                                                <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                                @if($offerFormOffer && $offerFormOffer->textSignature2() !== null && $offerFormOffer->signed_at_2 !== null)
                                                    <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at_2->timezone(session('ip_position:timezone', 'UTC'))->format('m/d/y g:i A') }}</p>
                                                @else
                                                    <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:--
                                                        --</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-md-6 col-lg-5 mb-3 mb-lg-0 mx-auto">
                                <div class="row">
                                    <div class="col-8 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center"
                                             style="background-color: #9C4EDD50">
                                            <a href="#!" class="text-decoration-none"
                                               @click.prevent="$dispatch('e-signature-modal', {wireTarget: @this, isBuyer2: true})"
                                            >
                                                @if($offerFormOffer && $offerFormOffer->pngSignature2() !== null)
                                                    <img src="{{ $offerFormOffer->pngSignature2()  }}"
                                                         style="height: 50px !important;"/>
                                                @else
                                                    <h4 class="text-dark mb-0 text-center btn-signature fw-bold">Click
                                                        here to draw signature</h4>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 px-0 align-self-center">
                                        <div class="h-60 d-flex justify-content-center align-items-center"
                                             style="background-color: #9C4EDD80">
                                            <div>
                                                <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                                                @if($offerFormOffer && $offerFormOffer->pngSignature2() !== null && $offerFormOffer->signed_at_2 !== null)
                                                    <p class="mb-0 fs-10 text-dark fw-bold">{{ $offerFormOffer->signed_at_2->format('m/d/y g:i A') }}</p>
                                                @else
                                                    <p class="mb-0 fs-10 text-dark fw-bold text-center">--/--/-- --:--
                                                        --</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <p class="mb-0 fw-bold text-center">Agrees that all the information I provided is accurate.</p>
            </div>
        </div>


        <div class="card rounded-3 border-0 shadow my-5">
            <div class="card-body">
                <p class="mb-0 fw-bold text-center">By clicking submit I ensure all inputted information is accurate and
                    I agree
                    <a href="{{route('guest.terms-and-conditions')}}" target="_blank"
                       class="text-primary-light text-decoration-none">terms and conditions</a> of this website .
                </p>
            </div>
        </div>

    </div>


    <div class="{{ $summary ? 'd-none' : '' }}">
        <div class="d-grid gap-4 mb-5" wire:sortable="changeSectionSortOrder">
            @if($offerFormOffer)
                @php
                    $query = $offerForm->getOfferFormStepsQuery(false, $offerFormOffer)->first();
                    $mediaConfig = [
                        'title' => 'My custom message for you',
                        'subtitle' => 'Click Play to learn more',
                        'include_background_overlay' => '1',
                        'image_center' => '1',
                    ];
                    if (youtube_video_id_from_url($offerFormOffer->video) !== null) {
                        $mediaConfig['youtube'] = $offerFormOffer->video;
                    } else {
                        $mediaConfig['video'] = $offerFormOffer->video;
                    }
                @endphp
                @if(!is_null($offerFormOffer->note) && $offerFormOffer->note !== '' && $query && $query->slug === $offerFormStep->slug)
                    <div class="container form-builder">
                        <div class="shadow form-builder-card bg-white" style="border-left: none !important;">
                            <div class="card-body text-center py-3">
                                <div class="short-and-long-description" style="position: relative">
                                    <h4 class="mb-2" style="line-height: 30px;">Note</h4>
                                    {!! $offerFormOffer->note !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(!is_null($offerFormOffer->video) && $query && $query->slug === $offerFormStep->slug)
                    <div class="container form-builder">
                        <div class="shadow form-builder-card bg-white" style="border-left: none !important;">
                            <div class="card-body text-center p-0">
                                @include('dash.offer-forms.steps.sections.medias.video', ['mediaConfig' => $mediaConfig, 'routeIsEdit' => false])
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @foreach($stepSections as $stepSection)
                <livewire:offer-forms.steps.step-section
                    :step-section="$stepSection"
                    :loop-index="$loop->index"
                    :route-is-edit="$routeIsEdit"
                    :route-is-preview="$routeIsPreview"
                    :offer-form-offer="$offerFormOffer"
                    :required-fields-not-filled="$requiredFieldsNotFilled"
                    :key="$stepSection->id"
                />
            @endforeach
        </div>
    </div>

    {{--    Footer [Start]   --}}
    @if(($routeIsPreview && is_null($offerFormStep->referral_partner_id)) || !$routeIsPreview)
        <div class="{{ request()->get('hide', 'none') === 'footer' ? 'd-none' : '' }}">
            @php
                $query = $offerForm->getOfferFormStepsQuery(false, $offerFormOffer);
                $stepSlugs = $query->pluck('slug')->toArray();
                $totalStepCount = count($stepSlugs);

                $currentStepNo = array_search($offerFormStep->slug, $stepSlugs) + 1;
                $percent = 0;
                try {
                    $percent = ($currentStepNo / $totalStepCount) * 100;
                } catch (DivisionByZeroError $e) {
                    Log::error('Division By Zero: ' . $e->getMessage());
                }
            @endphp
            <div
                class="container rounded-35 {{ $summary ? '' : 'fixed-bottom' }}  rounded-pill-none px-3 px-lg-4 py-3 shadow offerForm-bootom-nav"
                style="margin-bottom: 5px !important; background-color: #4F405B;max-width: 980px;">
                <div class="row text-white">
                    <div
                        class="col-12 col-lg-5 my-1 my-lg-0 order-3 order-lg-1 align-self-center text-end text-lg-start">
                        {{--                    @if($routeIsPreview)--}}
                        {{-- Preview as Agent or Form Builder --}}
                        {{--                        <div class="d-flex justify-content-between d-lg-block" >--}}
                        {{--                            <a href="#" class="btn btn-lg btn-primary-lighter text-white px-3 px-lg-3 rounded-pill w-96 fs-12 me-2 text-uppercase"--}}
                        {{--                               data-bs-toggle="modal" data-bs-target="#sendFormByEmail{{ $offerForm->id }}Modal">--}}
                        {{--                                <img src="{{asset('img/menu-icons/mail-icon.svg')}}" class="w-15 me-1 img-none-sm" alt=""> Email</a>--}}
                        {{--                            <a href="#" class="btn btn-lg btn-primary-lighter text-white px-3 px-lg-3 rounded-pill w-96 fs-12  text-uppercase"--}}
                        {{--                               data-bs-toggle="modal" data-bs-target="#sendFormByPhone{{ $offerForm->id }}Modal">--}}
                        {{--                                <img src="{{asset('img/menu-icons/text-icon.svg')}}" class="me-1 img-none-sm" style="width: 12px" alt=""> Text</a>--}}
                        {{--                        </div>--}}
                        {{--                    @if($agent)--}}
                        {{-- View as Agent --}}
                        <div class="">
                            <p class="mb-0 d-none d-lg-block fs-13">Questions? Contact your agent below</p>
                            <p class="mb-0 d-flex d-lg-block fs-13 justify-content-between">
                                <a href="tel:{{ $agent->phone }}"
                                   class="text-decoration-none me-1 btn-white-hover-primary-light">
                                    <img src="{{asset('img/menu-icons/qs-call.svg')}}" class="w-18 me-2 svgIcon"
                                         alt="">Call {{ ucfirst($agent->first_name) }}
                                </a>
                                <a href="mailto:{{ $agent->email }}"
                                   class="text-decoration-none ms-1 btn-white-hover-primary-light">
                                    <img src="{{asset('img/menu-icons/qs-mail.svg')}}" class="w-18 me-2 svgIcon"
                                         alt="">Email {{ ucfirst($agent->first_name) }}
                                </a>
                            </p>
                        </div>
                        {{--                    @endif--}}
                    </div>
                    <div
                        class="col-12 col-lg-2 px-2 px-lg-1 order-2 align-self-center my-lg-0 text-center  position-relative"
                        wire:ignore
                    >

                        <div class="d-none d-lg-block">
                            <p class="mb-2 fs-18  p-step d-none d-lg-block">{{ $currentStepNo }}
                                / {{ $totalStepCount }}</p>
                            <div class="outer-progress-bar">
                                <div class="progress position-relative" style="height: 5px">
                                    <div
                                        class="progress-bar"
                                        role="progressbar"
                                        style="width: {{ $percent }}%"
                                        aria-valuenow="{{ $percent }}"
                                        aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                    <p class="mb-2 fs-18 p-step-progress d-block d-lg-none">{{ $currentStepNo }}
                                        / {{ $totalStepCount }}</p>
                                </div>
                            </div>
                        </div>

                        @php
                            $stepCount = (int) $percent;
                        @endphp

                        <div class="d-block d-lg-none preview-mobile-progress-bar position-relative">
                            <div
                                class="progress-circle mx-auto position-absolute p{{ $stepCount }} {{$stepCount <= 50 ? 'bg-white': 'bg-primary-light d-180'}}">
                            <span
                                class="fs-14 text-white {{$stepCount > 50 ? 'd-180': ''}}">{{ $currentStepNo }} / {{ $totalStepCount }}</span>
                                <div class="left-half-clipper">
                                    <div class="first50-bar"></div>
                                    <div
                                        class="value-bar {{$stepCount <= 50 ? 'border-primary-light': 'border-white'}} "></div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-12 col-lg-5 order-1 order-lg-3 align-self-center text-end">
                        <div class="d-flex d-lg-block justify-content-between">
                            @if(request()->routeIs('guest.offer-form') && $summary)
                                <a
                                    href="#"
                                    wire:click.prevent="toggleSummary()"
                                    class="btn btn-lg btn-primary-lighter text-white px-3 px-lg-3 rounded-pill fs-12 w-96 fw-500 text-uppercase">
                                    PREV
                                </a>
                            @endif
                            @if($currentStepNo > 1)
                                @if(!$routeIsPreview)
                                    @if(!$summary)
                                        <a
                                            href="{{ route('guest.offer-form', [$offerForm->slug, $stepSlugs[$currentStepNo - 2], $offerFormOffer->slug]) }}"
                                            class="btn btn-lg btn-primary-lighter text-white px-3 px-lg-3 rounded-pill fs-12 w-96 me-2 fw-500 text-uppercase">
                                            PREV
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('dash.offer-forms.step.preview', [$offerForm->slug, $stepSlugs[$currentStepNo - 2]]) }}"
                                       class="btn btn-lg btn-white-black-hover px-3 px-lg-3 rounded-pill fs-12 w-96 fw-500 text-uppercase">PREV</a>
                                @endif
                            @endif
                            @if($currentStepNo < $totalStepCount)
                                <a href="javascript:void(0)"
                                   class="btn bg-transparent
                                px-3  fs-12 me-2 outline-none d-block d-lg-none">
                                </a>
                                <a href="#"
                                   wire:click.prevent="gotoNextStep"
                                   class="btn btn-lg btn-primary-light text-white px-3 px-lg-3 rounded-pill fs-12 ms-2 w-96 fw-500 text-uppercase nextButtonForPreview">
                                <span wire:loading.remove wire:target="gotoNextStep">
                                    NEXT
                                </span>
                                    <span wire:loading wire:target="gotoNextStep">
                                    <x-spinner class="me-1 spinner"/>NEXT
                                </span>
                                </a>

                            @elseif(!$routeIsPreview)
                                @if($summary)
                                    <a href="#"
                                       wire:click.prevent="gotoNextStep"
                                       class="btn btn-lg btn-primary-lighter text-white px-3 px-lg-3 rounded-pill fs-12 ms-2 w-96 text-uppercase">
                                        <span wire:loading wire:target="submit,gotoNextStep">Submitting...</span>
                                        <span wire:loading.remove wire:target="submit,gotoNextStep">Submit</span>
                                    </a>
                                @elseif(isset($stepSlugs[$currentStepNo - 1]))
                                    <a href="#"
                                       wire:click.prevent="toggleSummary('{{ route('guest.offer-form', [$offerForm->slug, $stepSlugs[$currentStepNo - 1], $offerFormOffer->slug]) }}')"
                                       class="btn btn-lg btn-primary-lighter text-white px-3 px-lg-3 rounded-pill fs-12 ms-2 w-96 text-uppercase">
                                        NEXT
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Required Fields Alert Modal     --}}
        <div class="modal fade" wire:ignore.self id="requiredFieldsNotFilledModal" data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1" aria-labelledby="requiredFieldsNotFilledModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Required Fields</h5>
                        <button type="button" class="btn-modal btn-primary-light rounded-pill" data-bs-dismiss="modal"
                                aria-label="Close">X
                        </button>
                    </div>
                    <div class="modal-body">

                        @foreach($requiredFieldsNotFilled as $key => $field)

                            <p class="fw-500 mb-3 pb-2 w-100 border-bottom text-decoration-none requiredFieldMessage"
                               data-id="requiredFieldMessage{{$key}}">
                                <a href="#" class="text-decoration-none btn-dark-hover-primary">
                                    <i class="fa fa-circle me-2 rounded-circle text-primary-light bg-primary-light"
                                       aria-hidden="true"></i>
                                    {{ $field }}
                                </a>
                            </p>

                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-primary-light rounded-pill px-5"
                                data-bs-dismiss="modal">Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Buyer Alert Modal   --}}
        <div class="modal fade" wire:ignore.self id="onFormSubmitModal" data-bs-backdrop="static"
             data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="onFormSubmitModalLabel" aria-hidden="true" x-data>
            <div class="modal-dialog modal-lg " style="max-width: 620px;">
                <div class="modal-content rounded-30">

                    <div class="modal-header border-0 pb-0 ms-auto">
                        <a href="javascript:void(0)"
                           class="text-decoration-none"
                           data-bs-dismiss="modal" aria-label="Close" @click.prevent="window.location = '/'">
                            <img src="{{asset('img/menu-icons/cross-icon.svg')}}" class="w-30" alt="">
                        </a>
                    </div>

                    <div class="modal-body text-center px-2 px-lg-5 py-2 py-lg-5 submitModal">

                        {{--                    <button type="button" class="btn-close position-absolute top-0 end-0 mt-3 me-3"--}}
                        {{--                            data-bs-dismiss="modal" aria-label="Close" @click.prevent="window.location = '/'"></button>--}}

                        <div class="">
                            <i class="fa fa-check bg-primary p-3 p-lg-4 fa-3x rounded-circle text-white"></i>
                            <h5 class="fw-bold text-primary my-2">Congratulations</h5>
                            <p class="fs-18 text-capitalize">Congratulations! Your offer can now be reviewed by <span
                                    class="font-bold">{{ $agent->full_name }}</span></p>
                        </div>

                        @include('partials.agent-intro-modal')

                    </div>
                </div>
            </div>
        </div>
</div>




@push('modals')
    @if($routeIsPreview)
        <livewire:offer-forms.send-modal :by="'Email'" :offer-form="$offerForm"/>
        <livewire:offer-forms.send-modal :by="'Phone'" :offer-form="$offerForm"/>
    @endif
    @include('dash.offer-forms.steps.sections.inputs.partials.e-signature-modal')
@endpush




@push('scripts')
    <script>
        $(function () {
            window.livewire.on('offerform-submitted', (text) => {
                $('#onFormSubmitModal').modal('show');
            });

            window.livewire.on('goto-next-step', (showModal = false) => {
                if (showModal) {
                    $('#requiredFieldsNotFilledModal').modal('show');
                } else {

                    @if($currentStepNo < $totalStepCount)
                        @if($routeIsPreview)
                        window.location = "{{ route('dash.offer-forms.step.preview' , [$offerForm->slug, $stepSlugs[$currentStepNo]]) }}";
                    @else
                        window.location = "{{ route('guest.offer-form' , [$offerForm->slug, $stepSlugs[$currentStepNo], $offerFormOffer->slug]) }}";
                    @endif
                    @elseif(!$routeIsPreview)
                    @this.
                    submit();
                    @endif
                }
            });
        })
    </script>
@endpush
@endif
