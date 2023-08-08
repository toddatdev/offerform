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

                <form action="{{ is_null($homes) ? route('dash.home.store') : route('dash.home.update', $homes->id )}}"
                      method="post" enctype="multipart/form-data">

                    @if(is_null($homes))
                        @csrf
                    @else
                        @csrf
                        @method('PUT')
                    @endif

                    <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                            <h3 class="fw-bold text-primary"><span class="{{ is_null($homes) ? 'text-success' : 'text-primary-lighter'}}"></span> Home Page Settings</h3>
                        </div>
                        <div class="text-end">
                            <x-button class="btn btn-lg btn-primary fs-16 px-2 px-lg-5" type="submit">Update Home
                                Page Setting
                            </x-button>
                        </div>
                    </div>
                    <hr>

                    <div class="home-page-setting">
                        <div class="row mb-4">
                            <div class="section-heading my-2">
                                <h4 class="fw-bold text-primary-light">Hero Section</h4>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">

                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->hero_image) ? asset('storage/' . $homes->hero_image) : asset('v1.1/images/header-bg.png')}}" alt="">
                                    <label class="fw-bold" for="">Upload Hero Image</label>
                                    <x-input type="file" id="hero_image" name="hero_image" class="form-control mt-3" placeholder=""/>
                                </div>

                                    <div class="form-group mb-3">
                                        <img class="img-thumbnail  rounded-3" src="{{isset($homes->video) ? asset('storage/' . $homes->video) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                        <label class="fw-bold hero_video_link" for="">Upload Video</label>
                                        <x-input type="file" id="hero_video_link" name="hero_video_link" class="form-control mt-3" placeholder=""/>
                                    </div>

                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold">Hero Title</label>
                                    <x-input type="text" id="hero_title" name="hero_title"
                                             value="{{$homes->hero_title ?? ''}}"
                                             class="form-control form-control-lg" placeholder="Hero Title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hero_sub_title" class="fw-bold">Hero Sub Title</label>
                                    <x-input type="text" id="hero_sub_title" name="hero_sub_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->hero_sub_title ?? ''}}"
                                             placeholder="Hero SubTitle"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="hero_description" class="fw-bold">Hero Description</label>
                                    <x-textarea type="text" rows="" id="hero_description" name="hero_description" class="form-control form-control-lg"
                                                placeholder="Hero Description">{!! $homes->hero_description ?? '' !!}</x-textarea>
                                </div>

                            </div>
                        </div>

                        {{-- Looping Gif Steps section--}}


                        <hr class="pt-2 bg-primary">
                        <div class="row mb-4">
                            <div class="section-heading mb-3 mt-2">
                                <h4 class="fw-bold text-primary-light">Looping Gif Section</h4>
                            </div>

                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_one_step_first_image) ? asset('storage/' . $homes->sec_one_step_first_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section one step first image</label>
                                    <input type="file" id="sec_one_step_first_image"
                                           name="sec_one_step_first_image" class="form-control mt-3">
                                </div>

                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step first
                                        title</label>
                                    <x-input type="text" id="sec_one_step_first_title" name="sec_one_step_first_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_one_step_first_title ?? ''}}"
                                             placeholder="section one step first title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_first_desc" class="fw-bold text-capitalize">section one
                                        step
                                        first description</label>
                                    <x-textarea type="text" rows="6" id="sec_one_step_first_desc"
                                                name="sec_one_step_first_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section one step first description">{!! $homes->sec_one_step_first_desc ?? '' !!}</x-textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <iframe
                                        src="{{isset($homes->section_one_video_link) ? asset('storage/' . $homes->section_one_video_link) : asset('img/dash/dummy_video_img.png')}}"
                                        allowfullscreen
                                        autoplay="false"
                                        sandbox=""
                                        class="w-100"

                                    ></iframe>
                                    <label class="fw-bold text-capitalize" for="">section one step first video</label>
                                    <input type="file" id="sec_one_step_first_video"
                                           name="sec_one_step_first_video" class="form-control mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_one_step_second_image) ? asset('storage/' . $homes->sec_one_step_second_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section one step second image</label>
                                    <input type="file" id="sec_one_step_second_image"
                                           name="sec_one_step_second_image" class="form-control mt-3">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step second
                                        title</label>
                                    <x-input type="text" id="sec_one_step_second_title" name="sec_one_step_second_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_one_step_second_title ?? ''}}"
                                             placeholder="section one step second title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_second_desc" class="fw-bold text-capitalize">section one
                                        step second description</label>
                                    <x-textarea type="text" rows="6" id="sec_one_step_second_desc"
                                                name="sec_one_step_second_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section one step second description">{!! $homes->sec_one_step_second_desc ?? '' !!}</x-textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <iframe
                                        src="{{isset($homes->sec_one_step_second_video) ? asset('storage/' . $homes->sec_one_step_second_video) : asset('img/dash/dummy_video_img.png')}}"
                                        allowfullscreen
                                        autoplay="false"
                                        sandbox=""
                                        class="w-100"
                                    ></iframe>
                                    <label class="fw-bold text-capitalize" for="">section one step second video</label>
                                    <input type="file" id="sec_one_step_second_video"
                                           name="sec_one_step_second_video"
                                           class="form-control mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_one_step_third_image) ? asset('storage/' . $homes->sec_one_step_third_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section one step third image</label>
                                    <input type="file" id="sec_one_step_third_image"
                                           name="sec_one_step_third_image" class="form-control mt-3">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step third
                                        title</label>
                                    <x-input type="text" id="sec_one_step_third_title" name="sec_one_step_third_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_one_step_third_title ?? ''}}"
                                             placeholder="section one step third title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_second_desc" class="fw-bold text-capitalize">section one
                                        step third description</label>
                                    <x-textarea type="text" rows="6" id="sec_one_step_third_desc"
                                                name="sec_one_step_third_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section one step third description">{!! $homes->sec_one_step_third_desc ?? ' '!!}</x-textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <iframe
                                        src="{{isset($homes->sec_one_step_third_video) ? asset('storage/' . $homes->sec_one_step_third_video) : asset('img/dash/dummy_video_img.png')}}"
                                        allowfullscreen
                                        autoplay="false"
                                        sandbox=""
                                        class="w-100"
                                    ></iframe>
                                    <label class="fw-bold text-capitalize" for="">section one step third video</label>
                                    <input type="file" id="sec_one_step_third_video"
                                           name="sec_one_step_third_video" class="form-control mt-3">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_one_step_fourth_image) ? asset('storage/' . $homes->sec_one_step_fourth_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section one step fourth image</label>
                                    <input type="file" id="sec_one_step_fourth_image"
                                           name="sec_one_step_fourth_image" class="form-control mt-3">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step fourth
                                        title</label>
                                    <x-input type="text" id="sec_one_step_fourth_title" name="sec_one_step_fourth_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_one_step_fourth_title ?? ''}}"
                                             placeholder="section one step fourth title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_second_desc" class="fw-bold text-capitalize">section one
                                        step fourth description</label>
                                    <x-textarea type="text" rows="6" id="sec_one_step_fourth_desc"
                                                name="sec_one_step_fourth_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section one step fourth description">{!! $homes->sec_one_step_fourth_desc ?? '' !!}</x-textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <iframe
                                        src="{{isset($homes->sec_one_step_fourth_video) ? asset('storage/' . $homes->sec_one_step_fourth_video) : asset('img/dash/dummy_video_img.png')}}"
                                        allowfullscreen
                                        autoplay="false"
                                        sandbox=""
                                        class="w-100"
                                    ></iframe>
                                    <label class="fw-bold text-capitalize" for="">section one step fourth video</label>
                                    <input type="file" id="sec_one_step_fourth_video"
                                           name="sec_one_step_fourth_video" class="form-control mt-3">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_one_step_fifth_image) ? asset('storage/' . $homes->sec_one_step_fifth_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section one step fifth image</label>
                                    <input type="file" id="sec_one_step_fifth_image"
                                           name="sec_one_step_fifth_image" class="form-control mt-3">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step fifth
                                        title</label>
                                    <x-input type="text" id="sec_one_step_fifth_title" name="sec_one_step_fifth_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_one_step_fifth_title ?? ''}}"
                                             placeholder="section one step fifth title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_second_desc" class="fw-bold text-capitalize">section one
                                        step fifth description</label>
                                    <x-textarea type="text" rows="6" id="sec_one_step_fifth_desc"
                                                name="sec_one_step_fifth_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section one step fifth description">{!! $homes->sec_one_step_fifth_desc ?? '' !!}</x-textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <iframe
                                        src="{{isset($homes->sec_one_step_fifth_video) ? asset('storage/' . $homes->sec_one_step_fifth_video) : asset('img/dash/dummy_video_img.png')}}"
                                        allowfullscreen
                                        autoplay="false"
                                        sandbox=""
                                        class="w-100"
                                    ></iframe>
                                    <label class="fw-bold text-capitalize" for="">section one step fourth video</label>
                                    <input type="file" id="sec_one_step_fifth_video"
                                           name="sec_one_step_fifth_video" class="form-control mt-3">
                                </div>
                            </div>
                        </div>



                        <hr class="pt-2 bg-primary">
                        <div class="row mb-4">
                            <div class="section-heading mb-3 mt-2">
                                <h4 class="fw-bold text-primary-light">How it Works</h4>
                            </div>

                            <div class="form-group mb-3">
                                <label for="hero_title" class="fw-bold text-capitalize">how it works title</label>
                                <x-input type="text" id="how_it_works_title" name="how_it_works_title"
                                         class="form-control form-control-lg"
                                         value="{{$homes->how_it_works_title ?? ''}}"
                                         placeholder="how it works title"/>
                            </div>


                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_two_step_first_image) ? asset('storage/' . $homes->sec_two_step_first_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section Two step first image</label>
                                    <input type="file" id="sec_two_step_first_image"
                                           name="sec_two_step_first_image" class="form-control mt-3">
                                </div>
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section Two step first
                                        title</label>
                                    <x-input type="text" id="sec_two_step_first_title" name="sec_two_step_first_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_two_step_first_title ?? ''}}"
                                             placeholder="section two step first title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_first_desc" class="fw-bold text-capitalize">section one
                                        step
                                        first description</label>
                                    <x-textarea type="text" rows="6" id="sec_two_step_first_desc"
                                                name="sec_two_step_first_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section two step first description">{!! $homes->sec_two_step_first_desc ?? '' !!}</x-textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-12 col-lg-9">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step second
                                        title</label>
                                    <x-input type="text" id="sec_two_step_second_title" name="sec_two_step_second_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_two_step_second_title ?? ''}}"
                                             placeholder="section two step second title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_second_desc" class="fw-bold text-capitalize">section one
                                        step second description</label>
                                    <x-textarea type="text" rows="6" id="sec_two_step_second_desc"
                                                name="sec_two_step_second_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section two step second description">{!! $homes->sec_two_step_second_desc ?? '' !!}</x-textarea>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_two_step_second_image) ? asset('storage/' . $homes->sec_two_step_second_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section one step second image</label>
                                    <input type="file" id="sec_two_step_second_image"
                                           name="sec_two_step_second_image" class="form-control mt-3">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-12 col-lg-3">
                                <div class="form-group mb-3">
                                    <img class=" img-thumbnail  rounded-3" src="{{isset($homes->sec_two_step_third_image) ? asset('storage/' . $homes->sec_two_step_third_image) : asset('img/dash/dummy-img.jpg')}}" alt="">
                                    <label class="fw-bold text-capitalize" for="">section two step third image</label>
                                    <input type="file" id="sec_two_step_third_image"
                                           name="sec_two_step_third_image" class="form-control mt-3">
                                </div>
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="form-group mb-3">
                                    <label for="hero_title" class="fw-bold text-capitalize">section one step third
                                        title</label>
                                    <x-input type="text" id="sec_two_step_third_title" name="sec_two_step_third_title"
                                             class="form-control form-control-lg"
                                             value="{{$homes->sec_two_step_third_title ?? ''}}"
                                             placeholder="section two step third title"/>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sec_one_step_second_desc" class="fw-bold text-capitalize">section one
                                        step third description</label>
                                    <x-textarea type="text" rows="6" id="sec_two_step_third_desc"
                                                name="sec_two_step_third_desc"
                                                class="form-control form-control-lg"
                                                placeholder="section two step third description">{!! $homes->sec_two_step_third_desc ?? ' '!!}</x-textarea>
                                </div>
                            </div>
                        </div>

                        <hr class="">
                        <div class="text-end my-4">
                            <x-button class="btn btn-lg btn-primary fs-16 px-2 px-lg-5" type="submit">Update Home
                                Page Setting
                            </x-button>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            CKEDITOR.replace( 'hero_description' );
            CKEDITOR.replace( 'sec_one_step_first_desc' );
            CKEDITOR.replace( 'sec_one_step_second_desc' );
            CKEDITOR.replace( 'sec_one_step_third_desc' );
            CKEDITOR.replace( 'sec_one_step_fourth_desc' );
            CKEDITOR.replace( 'agent_sec_first_des' );
            CKEDITOR.replace( 'agent_sec_second_des' );
            CKEDITOR.replace( 'agent_sec_third_des' );
            CKEDITOR.replace( 'sec_two_step_first_desc' );
            CKEDITOR.replace( 'sec_two_step_second_desc' );
            CKEDITOR.replace( 'sec_two_step_third_desc' );

        </script>
    @endpush

</x-app-layout>
