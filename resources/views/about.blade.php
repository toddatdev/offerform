<x-guest-layout>
    <x-slot name="title" data-aos="fade-up">
        About Us

    </x-slot>

    <div class="container about-us mb-100">

        @if(!$abouts->isEmpty())

            @foreach ($abouts as $about)
                @if($loop->iteration % 2 != 0)
                    <div class="row py-5">
                        <div class="col-md-6 col-lg-7 align-self-center py-sm-3" data-aos="fade-right">
                            <p class="">
                               {!! $about->content !!}
                            </p>

                            <div class="about-person-info">
                                <h5 class="fw-bold">{{$about->name}}</h5>
                                <h5 class="fw-bold">{{$about->designation}}</h5>
                                <h5 class="fw-bold">{{$about->company_title}}</h5>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-5 align-self-center py-sm-3" data-aos="fade-left">
                            <div class="about-person-image text-center">
                                <img class="img-fluid rounded-circle"
                                     src="{{ URL::asset('storage/' . $about->image) }}"
                                     alt="">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row py-5">

                        <div class="col-md-6 col-lg-5 align-self-center" data-aos="fade-left">
                            <div class="about-person-image text-center py-sm-3">
                                <img class="img-fluid rounded-circle"
                                     src="{{ URL::asset('storage/' . $about->image) }}"
                                     alt="">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-7 align-self-center py-sm-3" data-aos="fade-right">
                            <p>
                                {!! $about->content !!}
                            </p>

                            <div class="about-person-info">
                                <h5 class="fw-bold">{{$about->name}}</h5>
                                <h5 class="fw-bold">{{$about->designation}}</h5>
                                <h5 class="fw-bold">{{$about->company_title}}</h5>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach




        @endif

    </div>

</x-guest-layout>
