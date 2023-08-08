<x-guest-layout>
    <x-slot name="title" data-aos="fade-up">

            {{$termsAndConditions->title ?? 'Terms And Conditions'}}


    </x-slot>

    <div class="container about-us mt-5 pt-5 mb-100">

        {!! $termsAndConditions->content ?? '' !!}

    </div>

</x-guest-layout>
