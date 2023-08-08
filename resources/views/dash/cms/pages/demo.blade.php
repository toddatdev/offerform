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
                        <h2 class="fw-bold text-primary">Demo</h2>
                    </div>

                    <div class="col-md-auto ml-auto text-right">
                        <ul class="nav nav-pills justify-content-start">
                            <li class="nav-item ml-5">
                                <button type="button" class="btn btn-lg shadow fs-14 btn-primary rounded-pill px-3 "
                                        data-bs-toggle="modal" data-bs-target="#createDemo">
                                    Create New Demo
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createDemo" tabindex="-1"
                                     aria-labelledby="createTestimonialLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                    About us</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="{{route('dash.demos.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-4">
                                                                <div class="form-group mb-3">
                                                                    <img class="img-fluid rounded-3"
                                                                         src="{{asset('img/dash/dummy-img.jpg')}}"
                                                                         alt="">
                                                                    <label for="">Upload Video</label>
                                                                    <input type="file" id="video" required name="video"
                                                                           class="form-control mt-3" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-8">

                                                                <div class="form-group mb-3  align-self-end">
                                                                    <label for="simpleinput">Select User</label>
                                                                    <x-select name="user_id" id="" required>
                                                                        <option value="">Select user...</option>
                                                                        @foreach($users as $user)
                                                                            <option
                                                                                value="{{$user->id}}">{{$user->name}}</option>
                                                                        @endforeach
                                                                    </x-select>
                                                                </div>

                                                                <input type="hidden" value="0" name="status">

                                                                <div class="form-group mb-3  align-self-end">
                                                                    <label for="simpleinput">Title</label>
                                                                    <input type="text" id="title" name="title"
                                                                           class="form-control form-control-lg" required
                                                                           placeholder="Pick a Slot"
                                                                           value="Pick a Slot">
                                                                </div>
                                                                <div class="form-group col-md-12 mb-3">
                                                                    <label>Short Description</label>
                                                                    <textarea name="description" required rows="8"
                                                                              cols="50"
                                                                              class="form-control" id="about-content"
                                                                              placeholder="Pick a time for a 1 on 1 live demo with us"
                                                                    ></textarea>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-3">
                                                        <button type="submit"
                                                                class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                            Create Demo
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
                                <th style="width: 130px;">User Name</th>
                                <th style="width: 230px;">Title</th>
                                <th style="width: 300px;">Short Description</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 100px;">Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$demos->isEmpty())
                                @foreach($demos as $demo)
                                    <tr class="">
                                        <td class="fw-bold text-primary-lighter">{{$demo->id}}</td>
                                        <td class="fw-bold">{{$demo->user->name}}</td>
                                        <td class="fw-bold">{{$demo->title}}</td>
                                        <td class="fw-bold">{!! Str::limit("$demo->description", 30, ' ...') !!}</td>

                                        <td class="fw-bold   {{ $demo->status == 0 ? 'text-danger' : 'text-success'}}">
                                            {{ $demo->status == 0 ? 'Inactive' : 'Active'}}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success fs-14 rounded-0 "
                                               data-bs-toggle="modal"
                                               data-bs-target="#showVideo{{$demo->id }}">
                                                <img src="{{asset('img/dash/dummy_video_icon.jpg')}}"
                                                     style="width: 30px" alt="">
                                            </a>
                                        {{--                                            <iframe class=" " src="{{ URL::asset('storage/' . $demo->video) }}" style="width: 50px; height: 50px"></iframe>--}}
                                        {{--                                            <iframe class="embed-responsive-item " src="{{ URL::asset('storage/' . $demo->video) }}"></iframe>--}}
                                        <!-- Modal -->
                                            <div class="modal fade" id="showVideo{{$demo->id }}"
                                                 data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                 aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe class="embed-responsive-item w-100" style="height: 500px"
                                                                    src="{{ URL::asset('storage/' . $demo->video) }}"></iframe>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="#" class="btn btn-sm btn-success fs-14 rounded-0 "
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editdemo{{$demo->id }}">
                                                    <i class="fa fa-edit px-1"></i>Edit
                                                </a>

                                                <form action="{{ route('dash.demos.destroy',$demo->id) }}"
                                                      method="POST"
                                                      class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        href="{{route('dash.demos.destroy',$demo->id)}}"
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
                                            <div class="modal fade" id="editdemo{{$demo->id }}" tabindex="-1"
                                                 aria-labelledby="createTestimonialLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                                About us</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form action="{{route('dash.demos.update', $demo->id)}}" method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-12 col-lg-4">
                                                                            <div class="form-group mb-3">
                                                                                <iframe class="embed-responsive-item"
                                                                                        src="{{ URL::asset('storage/' . $demo->video) }}"></iframe>
                                                                                <input type="file" id="video" name="video"
                                                                                       class="form-control mt-3" placeholder=""
                                                                                >
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-lg-8">

                                                                            <div class="form-group mb-3  align-self-end">
                                                                                <label for="simpleinput">Select User</label>
                                                                                <x-select name="user_id" id="">
                                                                                    <option value="">Select user...</option>
                                                                                    @foreach($users as $user)
                                                                                        <option
                                                                                            value="{{$user->id}}">{{$user->name}}</option>
                                                                                    @endforeach
                                                                                </x-select>
                                                                            </div>

                                                                            <input type="hidden" value="0" name="status">

                                                                            <div class="form-group mb-3  align-self-end">
                                                                                <label for="simpleinput">Title</label>
                                                                                <input type="text" id="title" name="title"
                                                                                       class="form-control form-control-lg" required
                                                                                       placeholder="Pick a Slot"
                                                                                       value="{{$demo->title}}">
                                                                            </div>
                                                                            <div class="form-group col-md-12 mb-3">
                                                                                <label>Short Description</label>
                                                                                <textarea name="description" required rows="8"
                                                                                          cols="50"
                                                                                          class="form-control" id="about-content"
                                                                                          placeholder="Pick a time for a 1 on 1 live demo with us"
                                                                                >{!! $demo->description !!}</textarea>
                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer mt-3">
                                                                    <button type="submit"
                                                                            class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                                        Create Demo
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

    @push('scripts')
    @endpush
</x-app-layout>
