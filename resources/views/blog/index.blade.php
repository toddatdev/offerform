<x-guest-layout>
    <x-slot name="title">
        Blogs
    </x-slot>

    <div class="container mt-lg-5 mb-5 blog-cols">

{{--        <p class="text-center w-full-md-75" data-aos="fade-down"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum--}}
{{--            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of--}}
{{--            type and scrambled it to make a type specimen book.--}}
{{--        </p>--}}

        @if(!$blogs->isEmpty())
            <div class="row blog-row mt-5" data-aos="fade-up" style="margin-bottom: 200px">
                <h1 class="text-center mt-3 mb-5" data-aos="fade-up"> Discover all things Real Estate and Real</br> Estate Education</h1>
                @foreach($blogs as $blog)
                    <div class="col-12 md-6 col-lg-4 my-3">
                        @include('blog.card')
                    </div>
                @endforeach
            </div>
        @endif

    </div>

</x-guest-layout>
