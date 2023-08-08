<x-app-layout>
    <x-slot name="header">
        <div class="container">

        </div>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 card border-0 shadow-sm rounded-15">
                <div class="row card-body mb-4 items-align-center">
                    <div class="col-md mb-4">
                        <h2 class="fw-bold text-primary">About us</h2>
                    </div>

                    <div class="col-md-auto ml-auto text-right">
                        <ul class="nav nav-pills justify-content-start">
                            <li class="nav-item ml-5">
                                <button type="button" class="btn btn-lg shadow fs-14 btn-primary rounded-pill px-3 "
                                        data-bs-toggle="modal" data-bs-target="#createAbout">
                                    Create New About
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createAbout" tabindex="-1"
                                     aria-labelledby="createTestimonialLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                    About us</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('dash.about.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-5">
                                                                <div class="form-group mb-3">
                                                                    <img class="img-fluid rounded-3"
                                                                         src="{{asset('img/dash/dummy-img.jpg')}}"
                                                                         alt="">
                                                                    <input type="file" id="image" required name="image"
                                                                           class="form-control mt-3" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-7">

                                                                <div class="form-group mb-3  align-self-end">
                                                                    <label for="simpleinput">Name</label>
                                                                    <input type="text" id="name" name="name"
                                                                           class="form-control" required
                                                                           placeholder="Name">
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label for="simpleinput">Designation</label>
                                                                    <input type="text" id="location" name="designation"
                                                                           class="form-control" required
                                                                           placeholder="Designation">
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label for="simpleinput">Company Title</label>
                                                                    <input type="text" id="location" name="company_title"
                                                                           class="form-control" required
                                                                           placeholder="Company Title"
                                                                    value="OfferForm">
                                                                </div>

                                                            </div>
                                                            <div class="form-group col-md-12 mb-3">
                                                                <label>Content</label>
                                                                <textarea name="content" required rows="8" cols="50"
                                                                          class="form-control" id="about-content"
                                                                          placeholder="Write Your Content here"
                                                                ></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-3">
                                                        <button type="submit"
                                                                class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                            Create
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

                        @if(Session::has('success'))
                            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                        @endif

                        @if(Session::has('status_success'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                        @endif

                        @if(Session::has('error'))
                            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
                        @endif

                        <table class="table border-0 table-hover bg-white ">
                            <thead>
                            <tr role="row">
                                <th style="width: 30px;">ID</th>
                                <th style="width: 130px;">Name</th>
                                <th style="width: 180px;">Designation</th>
                                <th style="width: 150px;">Company Title</th>
                                <th style="width: 300px;">Content</th>
                                <th style="width: 100px;">Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$abouts->isEmpty())
                                @foreach($abouts as $about)
                                    <tr class="">
                                        <td class="fw-bold text-primary-lighter">{{$about->id}}</td>
                                        <td class="fw-bold">{{$about->name}}</td>
                                        <td class="fw-bold">{{$about->designation}}</td>
                                        <td class="fw-bold">{{$about->company_title}}</td>
                                        <td class="fw-bold">{!! Str::words("$about->content", 8, ' ...') !!}</td>
                                        <td><img class="" style="width: 40px;"
                                                 src="{{ URL::asset('storage/' . $about->image) }}"/>
                                        </td>
                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="#" class="btn btn-sm btn-success fs-14 rounded-0 "
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editAbout{{ $about->id }}">
                                                    <i class="fa fa-edit px-1"></i>Edit
                                                </a>

                                                <form action="{{ route('dash.about.destroy',$about->id) }}"
                                                      method="POST"
                                                      class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        href="{{route('dash.about.destroy',$about->id)}}"
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
                                            <div class="modal fade" id="editAbout{{ $about->id }}"
                                                 tabindex="-1"
                                                 aria-labelledby="createTestimonialLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                                About us</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{route('dash.about.update', $about->id)}}"
                                                            method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-5">
                                                                    <div class="form-group mb-3">
                                                                        <img class="img-thumbnail rounded-3"
                                                                             src="{{ URL::asset('storage/'.$about->image) }}"
                                                                             alt="">
                                                                        <input type="file" id="image"
                                                                               name="image"
                                                                               class="form-control mt-3"
                                                                               placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-7">

                                                                    <div class="form-group mb-3  align-self-end">
                                                                        <label for="simpleinput">Name</label>
                                                                        <input type="text" id="name" name="name"
                                                                               value="{{$about->name}}"
                                                                               class="form-control" required
                                                                               placeholder="Name">
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="simpleinput">Designation</label>
                                                                        <input type="text" id="location" name="designation"
                                                                               class="form-control" required
                                                                               value="{{$about->designation}}"
                                                                               placeholder="Designation">
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="simpleinput">Company Title</label>
                                                                        <input type="text" id="location" name="company_title"
                                                                               class="form-control" required
                                                                               placeholder="Company Title"
                                                                               value="{{$about->company_title}}">
                                                                    </div>

                                                                </div>
                                                                <div class="form-group col-md-12 mb-3">
                                                                    <label>Content</label>
                                                                    <textarea name="content" rows="7" cols="50"
                                                                              class="form-control tinymce-editor">{{$about->content}}</textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                            <div class="modal-footer mt-3">
                                                                <button type="submit"
                                                                        class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                                    Update About
                                                                </button>
                                                            </div>
                                                        </form>
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

    @push('scripts')

        <script>
            CKEDITOR.replace( 'about-content' );

        </script>

    @endpush
</x-app-layout>
