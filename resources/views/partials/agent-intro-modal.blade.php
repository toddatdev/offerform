
<div class="d-flex {{$class ?? ''}}">
    <div class="my-2 my-lg-0 align-self-center">

        @if(isset($agent->profile_photo_url))
            <img src="{{$agent->profile_photo_url}}"
                 class="agent-popup-image" alt="Offer Form">
        @else
            <span
                class="text-uppercase rounded-circle d-flex justify-content-center align-items-center bg-primary-lighter text-white text-center fw-500 fs-20 me-2"
                style="height: 55px; width: 55px;border: 5px solid #00000030">
                        {{Str::limit($agent->first_name, 1, '')}}{{Str::limit($agent->last_name, 1, '')}}
                    </span>
        @endif

    </div>
    <div class="d-flex flex-column flex-lg-row align-self-center">
        <div class="flex-grow-1 ms-3">
            <ul class="fa-ul text-start">

                @if(!is_null($agent->full_name))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1 text-primary-light fs-14">
                      <span class="fa-li">
                          <img class="w-18 me-2" src="{{asset('img/menu-icons/broker.svg')}}" alt="">
                    </span>
                        {{ $agent->full_name }}
                    </li>
                @endif

                @if(!is_null($agent->phone))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                      <span class="fa-li">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/call.svg')}}" alt="">
                    </span>
                        {{ $agent->phone }}
                    </li>
                @endif

                @if(!is_null($agent->email))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                    <span class="fa-li">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/mail.svg')}}" alt="">
                    </span>
                        {{ $agent->email}}
                    </li>
                @endif

                @if(!is_null($agent->address))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                    <span class="fa-li">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/map.svg')}}" alt="">
                    </span>
                        {{ $agent->address }}
                    </li>
                @endif
                @isset($agent->other_inputs['team_name'])
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                        <span class="fa-li">
                            <img class="w-20 me-2" src="{{asset('img/menu-icons/team.svg')}}" alt="">
                        </span>
                        {{ $agent->other_inputs['team_name'] ?? '' }}
                    </li>
                @endisset
            </ul>
        </div>
        <div class="flex-grow-1 ms-3">
            <ul class="fa-ul text-start mt-1">
                @if(isset($agent->other_inputs['website']) && !is_null($agent->other_inputs['website']))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                    <span class="fa-li">
                        <img class="w-17 me-2"
                             src="{{asset('img/menu-icons/globe-icon.svg')}}" alt="">
                    </span>
                        {{ $agent->other_inputs['website'] }}
                    </li>
                @endif

                @if(isset($agent->other_inputs['position']) && !is_null($agent->other_inputs['position']))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                    <span class="fa-li">
                        <img class="w-17 me-2" src="{{asset('img/menu-icons/broker.svg')}}" alt="">
                    </span>
                        {{ $agent->other_inputs['position'] }}
                    </li>
                @endif

                @if(isset($agent->other_inputs['licenseNumber']) && !is_null($agent->other_inputs['licenseNumber']))
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                    <span class="fa-li">
                        <img class="w-17 me-2" src="{{asset('img/menu-icons/hash.svg')}}" alt="">
                    </span>
                        {{ $agent->other_inputs['licenseNumber'] }}
                    </li>
                @endif

                @isset($agent->other_inputs['brokerage_name'])
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                    <span class="fa-li">
                        <img class="w-18 me-2" src="{{asset('img/menu-icons/multiple-user.svg')}}" alt="">
                    </span>
                        {{ $agent->other_inputs['brokerage_name'] ?? '' }}
                    </li>
                @endisset

                @isset($agent->other_inputs['miscellaneous'])
                    <li class="mb-1 mb-lg-2 fs-12 fw-500 pt-1">
                        <span class="fa-li">
                            <img class="w-20 me-2" src="{{asset('img/menu-icons/fill.svg')}}" alt="">
                        </span>
                        {{ $agent->other_inputs['miscellaneous'] }}
                    </li>
                @endisset

            </ul>
        </div>
    </div>
</div>

@if(isset($agent->other_inputs['agent_bio']) && !is_null($agent->other_inputs['agent_bio']))
    <div class="content mt-2">
        <h5 class="text-primary-light text-center d-block d-lg-none">Learn More About Me:</h5>
        <p class="fs-14 fw-500 text-start" x-data="{showTextLessOrMore: false}">
            <span class="less" x-show="!showTextLessOrMore">{{ Str::limit($agent->other_inputs['agent_bio'], 300, '') }}</span>
            @if (strlen($agent->other_inputs['agent_bio']) > 300)
                <span id="more" style="display: none;" x-show="showTextLessOrMore">{{ $agent->other_inputs['agent_bio'] }}</span>
                <a
                    href="javascript:void(0)"
                    class="fw-bold text-decoration-none border-0 outline-none fs-14 py-0 my-0"
                    @click.prevent="showTextLessOrMore = !showTextLessOrMore"
                >
                    Read <span x-show="!showTextLessOrMore">More...</span><span x-show="showTextLessOrMore">Less</span>
                </a>
            @endif
        </p>
    </div>
@endif

@php
    $eid = $eid ?? time();
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
                else $refs.local_{{$eid}}.pause();
            } else {
                this.playableUrl = this.videoUrl;
                this.isPlaying = true;

                if (this.ytPlayer !== null)  this.ytPlayer.load('{{ $vid }}', true);
                else $refs.local_{{$eid}}.play();

            }
        }
    }"
    x-init="
        @if(!is_null($vid))
            ytPlayer = new YTPlayer('#yt{{$eid}}player');
        @endif
    "
    @click.away="isPlaying ? playOrPauseVideo() : ''"
    >
        <div class="rounded-15 mt-2"
             x-show="!isPlaying"
             style="background-image: url('{{ $bg }}');
                 background-position: center; background-size: cover; background-repeat: no-repeat; height: 180px">
            <div class="text-center text-white px-2 px-lg-5 py-2  d-flex align-items-center justify-content-center"
                 style="height: 180px">
                <div>
                    <h5 class="fw-normal d-none d-lg-block mb-2"
                    style="text-shadow: 2px 2px 5px #000000;"
                    >Click here to learn more about {{ $agent->full_name }}</h5>
                    <a
                        href="javascript:void(0)"
                        @click.prevent="playOrPauseVideo()"
                    >
                        <i class="fa fa-play bg-white p-3 fs-16 text-center rounded-circle text-primary shadow"></i>
                    </a>
                    <h5 class="fw-normal d-none d-lg-block mt-2"
                        style="text-shadow: 2px 2px 5px #000000;"
                    >Click Play</h5>
                </div>
            </div>
        </div>

        <div class="rounded-15 mt-2" x-show="isPlaying" style="display:none; height: 180px">
            @if(!is_null($vid))
                <div class="w-100 rounded-15" id="yt{{$eid}}player" style="height: 180px;"></div>
            @else
                <video class="rounded-15" controls width="100%" height="180" x-ref="local_{{$eid}}">
                    <source src="{{ video_url($agent->video) }}" type="video/mp4" />
                    Your browser does not support HTML video.
                </video>
{{--                                <iframe class="w-100 rounded-15" frameborder allowfullscreen="1" id="clickForMoreInfo"--}}
{{--                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
{{--                                        height="180"--}}
{{--                                        :src="`${playableUrl}?autoplay=1`">--}}
{{--                                </iframe>--}}
            @endif
        </div>
    </div>
@endif


{{--Social Media Links--}}

@if(
    isset($agent->links['instagram']) ||
    isset($agent->links['twitter']) ||
    isset($agent->links['youtube']) ||
    isset($agent->links['facebook'])||
    isset($agent->links['tiktok'])
)
    <div class=" my-4 mx-0 mx-lg-4">
        <h4 class="text-primary-light d-none d-lg-block">Follow Me on Social Media</h4>
        <div
            class="my-4 d-flex justify-content-evenly justify-content-lg-between social-icon social-icons-agent-modal">
            @isset($agent->links['instagram'])
                <a href="{{ $agent->links['instagram']  ?? '#' }}" target="_blank">
                    <img src="{{asset('img/menu-icons/social-icons/instagram.svg')}}" class="w-34" alt=""/>
                </a>
            @endisset
            @isset($agent->links['twitter'])
                <a href="{{ $agent->links['twitter']  ?? '#' }}" target="_blank">
                    <img src="{{asset('img/menu-icons/social-icons/twitter.svg')}}" class="w-34" alt=""/>
                </a>
            @endisset
            @isset($agent->links['youtube'])
                <a href="{{ $agent->links['youtube']  ?? '#' }}" target="_blank">
                    <img src="{{asset('img/menu-icons/social-icons/youtube.svg')}}" class="w-34" alt=""/>
                </a>
            @endisset

            @isset($agent->links['tiktok'])
                <a href="{{ $agent->links['tiktok']  ?? '#' }}" target="_blank">
                    <img src="{{asset('img/menu-icons/social-icons/tiktok2.jpg')}}" class="w-34" alt=""/>
                </a>
            @endisset

            @isset($agent->links['facebook'])
                <a href="{{ $agent->links['facebook']  ?? '#' }}" target="_blank">
                    <img src="{{asset('img/menu-icons/social-icons/facebook.svg')}}" class="w-34" alt=""/>
                </a>
            @endisset

        </div>
    </div>
@endif
