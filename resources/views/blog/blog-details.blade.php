<x-guest-layout>
    <x-slot name="title">

    </x-slot>

    <div class="container mb-5">
        <div class="col mb-5">
            <a href="{{route('guest.blog')}}" class="btn btn-lg bg-white text-dark px-5 shadow-sm fs-14 fw-500 py-3 rounded-pill"><i class="fa fa-angle-left fs-16 text-primary-lighter me-2"></i>Back</a>
        </div>

        <div class="mb-5">
            <img class="w-100 shadow-sm rounded-15 mb-3" src="{{asset('storage/' . $blog->image) }}" alt="">
        </div>

        <div>
            <h1 class="h1 fw-bold">{{$blog->title}}</h1>
            <p class="fw-bold">{{$blog->created_at->format('d,M  Y')}}</p>

            <div class="mb-5 pb-5">
                {!! $blog->content !!}
            </div>
        </div>

    </div>

</x-guest-layout>
