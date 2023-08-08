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
                        <h2 class="fw-bold text-primary">All Blog Posts</h2>
                    </div>

                    <div class="col-md-auto ml-auto text-right">
                        <ul class="nav nav-pills justify-content-start">
                            <li class="nav-item ml-5">
                                <button type="button" class="btn btn-lg shadow fs-14 btn-primary rounded-pill px-3 "
                                        data-bs-toggle="modal" data-bs-target="#createBlog">
                                    Create New Blog
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="createBlog" tabindex="-1" aria-labelledby="createBlogLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-primary" id="exampleModalLabel">Blog</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('dash.blogs.store')}}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group mb-3 col-md-6">
                                                                <label for="simpleinput">Blog Title</label>
                                                                <input type="text" id="title" name="title"
                                                                       class="form-control" required
                                                                >
                                                            </div>
                                                            <input type="hidden" id="title" name="slug"
                                                                   class="form-control">

                                                            <div class="form-group mb-3 col-md-6">
                                                                <label for="simpleinput">Blog Image</label>
                                                                <input type="file" id="image" name="image" required
                                                                       class="form-control">
                                                            </div>
                                                            <input type="hidden" value="1" name="active"
                                                                   class="form-control">

                                                            <div class="form-group col-md-12">
                                                                <label>Content</label>
                                                                <textarea name="content" rows="10" cols="50"
                                                                          class="form-control" id="blog-content"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-3">
                                                        <button type="submit"
                                                                class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                            Create Blog
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

                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$blogs->isEmpty())
                                @foreach($blogs as $blog)
                                    <tr class="">
                                        <td class="fw-bold text-primary-lighter">{{$blog->id}}</td>
                                        <td class="fw-bold">{{$blog->title}}</td>
                                        <td class="fw-bold">{{$blog->slug}}</td>
                                        {{--                                    <td style="font-size: 12px">{{$blog->slug}}</td>--}}
                                        <td><img class="" style="width: 40px;"
                                                 src="{{ URL::asset('storage/' . $blog->image) }}"/></td>

                                        <td class="{{ $blog->active  == 1? 'text-success': 'text-danger'}} fw-bold">
                                            {{ $blog->active  == 1? 'Active': 'InActive'}}

                                        </td>
                                        <td class="text-primary fw-bold">{{$blog->user->name}}</td>
                                        <td class="fw-bold">{{$blog->created_at->format('d-M-Y')}}</td>
                                        <td>

                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="#" class="btn btn-sm btn-success fs-14 rounded-0 "
                                                   data-bs-toggle="modal" data-bs-target="#editBlogPost{{ $blog->id }}">
                                                    <i class="fa fa-edit px-1"></i>Edit
                                                </a>

                                                <form action="{{ route('dash.blogs.destroy',$blog->id) }}"
                                                      method="POST"
                                                      class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button href="{{route('dash.blogs.destroy',$blog->id)}}"
                                                            onclick="return confirm('Are you sure you want to delete this?')"
                                                            type="submit"
                                                            title="Delete Job Post"
                                                            class="btn btn-sm btn-danger fs-14 btn-danger rounded-0"
                                                    >
                                                        <i class="fa fa-trash px-1"></i>Delete Blog
                                                    </button>
                                                </form>
                                            </div>


                                            <!-- Modal -->
                                            <div class="modal fade" id="editBlogPost{{ $blog->id }}" tabindex="-1"
                                                 aria-labelledby="createBlogLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-primary" id="exampleModalLabel">
                                                                Blog</h5>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('dash.blogs.update', $blog->id)}}"
                                                                  method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="form-group mb-3 col-md-6">
                                                                            <label for="simpleinput">Blog Title</label>
                                                                            <input type="text" id="title" name="title"
                                                                                   value="{{$blog->title}}"
                                                                                   class="form-control">
                                                                        </div>
                                                                        <input type="hidden" id="title" name="slug"
                                                                               class="form-control">

                                                                        <div class="form-group mb-3 col-md-6">
                                                                            <img width="7%" class=""
                                                                                 src="{{ URL::asset('storage/'.$blog->image) }}">
                                                                            <label for="simpleinput">Blog Image</label>
                                                                            <input type="file" id="location"
                                                                                   name="image"
                                                                                   value="" class="form-control">
                                                                        </div>

{{--                                                                        <input type="hidden" value="1" name="active"--}}
{{--                                                                               class="form-control">--}}
                                                                        <div class="form-group mb-3 col-md-12">
                                                                            <label for="">Staus </label>
                                                                            <x-select name="active" id="">
                                                                                <option value="1" {{ $blog->active == 1 ? 'selected' : '' }}>Active</option>
                                                                                <option value="0" {{ $blog->active == 0 ? 'selected' : '' }}>InActive</option>
                                                                            </x-select>
                                                                        </div>

                                                                        <div class="form-group col-md-12">
                                                                            <label>Content</label>
                                                                            <textarea name="content" rows="10" cols="50"
                                                                                      class="form-control" id="blog-content">{{$blog->content}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer mt-3">
                                                                    <button type="submit"
                                                                            class="btn btn-primary btn-lg fs-14 rounded-pill px-3">
                                                                        Update Blog
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

        <script>
            CKEDITOR.replace( 'blog-content' );

        </script>

    @endpush

</x-app-layout>
