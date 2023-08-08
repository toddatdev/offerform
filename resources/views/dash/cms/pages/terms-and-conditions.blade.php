<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="container mb-5 pb-5">
        <div class="card shadow-sm border-0 rounded-15">
            <div class="card-body">

                @if(Session::has('success'))
                    <p class="alert fw-bold {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                @endif

                @if(Session::has('error'))
                    <p class="alert fw-bold {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                @endif

                <form action="{{ is_null($termsAndConditions) ? route('dash.terms-and-conditions.store') : route('dash.terms-and-conditions.update', $termsAndConditions->id )}}"
                      method="post" enctype="multipart/form-data">

                    @if(is_null($termsAndConditions))
                        @csrf
                    @else
                        @csrf
                        @method('PUT')
                    @endif

                    <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                            <h3 class="fw-bold text-primary">
                                <span class="{{ is_null($termsAndConditions) ? 'text-success' : 'text-primary-lighter'}}"></span> Terms And Conditions Page Settings</h3>
                        </div>
                    </div>
                    <hr>

                    <div class="home-page-setting">
                        <div class="row mb-4">
                            <div class="section-heading my-2">
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="title" class="fw-bold">Title</label>
                                    <x-input type="text" id="hero_title" name="title"
                                             value="{{$termsAndConditions->title ?? 'Terms and Conditions'}}"
                                             class="form-control form-control-lg" placeholder="Page Title"/>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="content" class="fw-bold">Content</label>
                                    <x-textarea type="text" rows="" id="content" name="content"
                                                class="form-control form-control-lg"
                                                placeholder="content">{!! $termsAndConditions->content ?? '' !!}</x-textarea>
                                </div>

                            </div>
                        </div>

                        <hr class="pt-2 bg-primary">
                        <div class="text-end my-4">
                            <x-button class="btn btn-lg btn-primary fs-16 px-2 px-lg-5" type="submit">Update Page Setting
                            </x-button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            CKEDITOR.replace( 'content' );
        </script>
    @endpush

</x-app-layout>
