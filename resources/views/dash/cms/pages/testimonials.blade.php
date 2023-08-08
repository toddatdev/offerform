<x-app-layout>
    <x-slot name="header">
        <div class="container">

        </div>
    </x-slot>
    <div class="container">

        @if(Session::has('success'))
            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
        @endif

        @if(Session::has('status_success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
        @endif

        @if(Session::has('error'))
            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif


        <div class="row justify-content-center">
            <div class="col-12 card border-0 shadow-sm rounded-15">
                <div class="row card-body mb-4 items-align-center">
                    <div class="col-md mb-4">
                        <h2 class="fw-bold text-primary">All Testimonial</h2>
                    </div>

                    <div class="col-md-auto ml-auto text-right">
                        <ul class="nav nav-pills justify-content-start">
                            <li class="nav-item ml-5">
                                <button type="button" class="btn btn-lg shadow fs-14 btn-primary rounded-pill px-3 "
                                        data-bs-toggle="modal" data-bs-target="#createTestimonial">
                                    Create New Testimonial
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createTestimonial" tabindex="-1"
                                     aria-labelledby="createTestimonialLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                    Testimonial</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('dash.testimonials.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">

                                                            <div class="col-12 col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <img class=" rounded-3" style="width: 100%;height: 250px"
                                                                         src="{{asset('img/dash/dummy-img.jpg')}}"
                                                                         alt="">
                                                                    <label class="fw-500" for="">Upload Testimonial image</label>
                                                                    <input type="file" id="image" name="image"
                                                                           class="form-control mt-3" placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-6">
                                                                <div class="form-group mb-3">
                                                                    <img class=" rounded-3" style="width: 100%;height: 250px"
                                                                         src="{{asset('img/dash/settings/setting-profile-video.jpg')}}"
                                                                         alt="">
                                                                    <label class="fw-500" for="">Upload Testimonial Video</label>
                                                                    <input type="file" id="video" required name="video"
                                                                           class="form-control mt-3" placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-lg-4">

                                                                <div class="form-group mb-3  align-self-end">
                                                                    <label for="simpleinput">Name</label>
                                                                    <x-input type="text" id="name" name="name"
                                                                             class="form-control" required
                                                                             placeholder="Name"/>
                                                                </div>

                                                            </div>

                                                                <div class="col-12 col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="simpleinput">Location</label>
                                                                        <x-input type="text" id="location" name="location"
                                                                                 class="form-control" required
                                                                                 placeholder="Location"/>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-lg-4">
                                                                    <div class="form-group mb-3 ">
                                                                        <label for="simpleinput">Status</label>
                                                                        <x-select name="active" id="" class="form-control">
                                                                            <option value="1">Active</option>
                                                                            <option value="0">InActive</option>
                                                                        </x-select>
                                                                    </div>
                                                                </div>

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label>Comment</label>
                                                                <textarea name="comment" required rows="8" cols="50"
                                                                          class="form-control tinymce-editor"
                                                                          placeholder="Write Your Comment here"
                                                                ></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-3">
                                                        <button type="submit"
                                                                class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                            Create Testimonial
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <!-- Slide Modal -->

                    <div class="table-responsive">
                        <table class="table border-0 table-hover bg-white ">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Image</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$testimonials->isEmpty())
                                @foreach($testimonials as $testimonial)
                                    <tr class="">
                                        <td class="fw-bold text-primary-lighter">{{$testimonial->id}}</td>
                                        <td class="fw-bold">{{$testimonial->name}}</td>
                                        <td class="fw-bold">{{$testimonial->location}}</td>
                                        {{--                                    <td style="font-size: 12px">{{$testimonial->slug}}</td>--}}
                                        <td><img class="" style="width: 40px;"
                                                 src="{{ URL::asset('storage/' . $testimonial->image) }}"/>
                                        </td>
                                        <td class="fw-bold">{!! Str::words("$testimonial->comment", 8, ' ...') !!}</td>

                                        <td class="{{ $testimonial->active  == 1? 'text-success': 'text-danger'}} fw-bold">
                                            {{ $testimonial->active  == 1? 'Active': 'InActive'}}

                                        </td>

                                        <td class="fw-bold">{{$testimonial->created_at->format('d-M-Y')}}</td>
                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="#" class="btn btn-sm btn-success fs-14 rounded-0 "
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editTestimonialPost{{ $testimonial->id }}">
                                                    <i class="fa fa-edit px-1"></i>Edit
                                                </a>

                                                <form action="{{ route('dash.testimonials.destroy',$testimonial->id) }}"
                                                      method="POST"
                                                      class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        href="{{route('dash.testimonials.destroy',$testimonial->id)}}"
                                                        onclick="return confirm('Are you sure you want to delete this?')"
                                                        type="submit"
                                                        title="Delete Job Post"
                                                        class="btn btn-sm btn-danger fs-14 btn-danger rounded-0"
                                                    >
                                                        <i class="fa fa-trash px-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editTestimonialPost{{ $testimonial->id }}"
                                                 tabindex="-1"
                                                 aria-labelledby="createTestimonialLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                                Testimonial</h5>
                                                            <button type="button" class="btn-close btnStopVideoOnModalHide"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{route('dash.testimonials.update', $testimonial->id)}}"
                                                                method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')


                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="col-12 col-lg-6">
                                                                            <div class="form-group mb-3">
                                                                                <img class="img-fluid rounded-3"
                                                                                     src="{{ URL::asset('storage/'.$testimonial->image) }}"
                                                                                     alt=""
                                                                                     style="width: 100%;height: 250px">
                                                                                <label class="fw-500" for="">Upload Testimonial image</label>
                                                                                <input type="file" id="image"
                                                                                       name="image"
                                                                                       class="form-control mt-3"
                                                                                       placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-lg-6">
                                                                            <div class="form-group mb-3">
                                                                                <video width="100%" height="250" class="stopVideoOnModalHide rounded-3 object-cover"
                                                                                       controls>
                                                                                    <source src="{{isset($testimonial->video) ? URL::asset('storage/'.$testimonial->video) : '' }}"
                                                                                            type="video/mp4">
                                                                                </video>
                                                                                <label class="fw-500" for="">Upload Testimonial Video</label>
                                                                                <input type="file" id="video" name="video"
                                                                                       class="form-control mt-3" placeholder="">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-12 col-lg-4">
                                                                            <div
                                                                                class="form-group mb-3 align-self-end">
                                                                                <label for="simpleinput">Name</label>
                                                                                <x-input type="text" id="name"
                                                                                         name="name"
                                                                                         value="{{$testimonial->name}}"
                                                                                         class="form-control" required
                                                                                         placeholder="Name"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-lg-4">

                                                                            <div class="form-group mb-3">
                                                                                <label
                                                                                    for="simpleinput">Location</label>
                                                                                <x-input type="text" id="location"
                                                                                         name="location"
                                                                                         value="{{$testimonial->location}}"
                                                                                         class="form-control" required
                                                                                         placeholder="Location"/>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-lg-4">

                                                                            <div class="form-group mb-3">
                                                                                <label for="simpleinput">Status</label>
                                                                                <x-select name="active" id=""
                                                                                          class="form-control">
                                                                                    <option value="1">Active</option>
                                                                                    <option value="0">InActive</option>
                                                                                </x-select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group col-md-12 mb-3">
                                                                            <label>Comment</label>
                                                                            <textarea name="comment" rows="7" cols="50"
                                                                                      class="form-control tinymce-editor">{{$testimonial->comment}}</textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer mt-3">
                                                                    <button type="submit"
                                                                            class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                                        Update Testimonial
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->

    </div>

    @push('scripys')

        <script>
            $(".btnStopVideoOnModalHide").click(function () {
                $('.stopVideoOnModalHide').trigger('pause');
            });
        </script>

    @endpush

</x-app-layout>

