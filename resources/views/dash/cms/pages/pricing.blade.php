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

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between">
                    <div class="align-self-center">
                        <h3 class="fw-bold text-primary"><span class=""></span> Pricing Page</h3>
                    </div>
                    <div class="text-end">
{{--                        <x-button class="btn btn-lg btn-primary fs-16 px-2 px-lg-5" type="submit">Update Price Page--}}
{{--                            Setting--}}
{{--                        </x-button>--}}
                    </div>
                </div>
                <hr>

                <div class="home-page-setting">

{{--                    <div class="row mb-4">--}}
{{--                        <h4 class="text-primary fw-bold mb-4">Basic Info</h4>--}}
{{--                        <div class="form-group mb-3 col-12 col-md-6">--}}
{{--                            <label class="fw-bold">Page Title</label>--}}
{{--                            <x-input type="text" name="page_title" class="form-control" placeholder=""/>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-3 col-12 col-md-6">--}}
{{--                            <label class="fw-bold">Short Text</label>--}}
{{--                            <x-input type="text" name="short_text" class="form-control" placeholder=""/>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <hr class="pt-2 bg-primary">--}}

                    {{-- Package Row--}}

                    <div class="row mb-5">

                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary fw-bold">Card Info</h4>
                            {{--                                <a href="#"--}}
                            {{--                                   data-bs-target="#createPricingPlan"--}}
                            {{--                                   data-bs-toggle="modal"--}}
                            {{--                                   class="btn btn-primary">Create New Plan</a>--}}
                        </div>

                        <div class="modal fade" id="createPricingPlan" tabindex="-1" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Pricing Plan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">


                                        <form class="row" action="{{route('dash.pricing.store')}}" method="post">
                                            @csrf
                                            <div class="col-12 form-group mb-3">
                                                <label for="">Title</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>
                                            <div class="col-12 form-group mb-3">
                                                <label for="">Tagline</label>
                                                <input type="text" name="tagline" class="form-control" required>
                                            </div>
                                            <div class="col-12 form-group mb-3">
                                                <label for="">Features</label>
                                                <input type="text" name="features" class="form-control" required>
                                            </div>

                                            <div class="col-12 form-group mb-3">
                                                <button type="submit" class="btn btn-primary w-100">Create</button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>


                        @foreach($pricingPlans as $pricingPlan)
                            <div class="col-12 col-md-6 col-lg-4 mt-4">
                                <div class="card position-relative" style="min-height: 370px;">

                                    <div class="card-body text-center position-relative">
                                        <div class="text-start">
                                            <h4 class="fw-bold text-center">{{$pricingPlan->title}}</h4>
                                            <p class="text-center fw-500">{{$pricingPlan->tagline}}</p>

                                            @php
                                                $allPriceList =  json_decode(json_encode($pricingPlan->features),true);
                                            @endphp

                                            @if(is_array($allPriceList))
                                                <ul class="list-group list-group-flush">
                                                    @foreach($allPriceList as $p)
                                                        <li class="list-group-item">{{$p}}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button
                                    data-bs-target="#edit{{$pricingPlan->id}}Pricing"
                                    data-bs-toggle="modal"
                                    class="btn btn-primary-light-black-hover w-100 mt-1">Edit
                                </button>
                            </div>

                            <div class="modal fade" id="edit{{$pricingPlan->id}}Pricing" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New Pricing Plan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form class="row" action="{{route('dash.pricing.update',$pricingPlan->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-12 form-group mb-3">
                                                    <label for="">Title</label>
                                                    <input type="text" name="title" value="{{$pricingPlan->title}}"
                                                           class="form-control" required>
                                                </div>
                                                <div class="col-12 form-group mb-3">
                                                    <label for="">Tagline</label>
                                                    <input type="text" name="tagline" value="{{$pricingPlan->tagline}}"
                                                           class="form-control" required>
                                                </div>
                                                {{--                                                    <div class="col-12 form-group mb-3">--}}
                                                {{--                                                        <label for="">Features</label>--}}

                                                {{--                                                        <x-textarea type="text" rows="" id="features{{$pricingPlan->id}}Listing" name="hero_description" class="form-control form-control-lg"--}}
                                                {{--                                                                    placeholder="Pricing List">{!! $pricingPlan->feature ?? '' !!}</x-textarea>--}}

                                                {{--                                                    </div>--}}


                                                <div class="form-group email-id-row">

                                                    <label class="fw-600" for="">CTRL or CMD +CLick to Select or Unselect List</label>
                                                    @php
                                                        $allPriceList =  json_decode(json_encode($pricingPlan->features),true);
                                                    @endphp

                                                    @if(is_array($allPriceList))

                                                        <select name="features[]" multiple="multiple"
                                                                id="feature{{$pricingPlan->id}}Listing"
                                                                class="form-control">

                                                            @if(!is_null($allPriceList))
                                                                @foreach($allPriceList as $p)
                                                                    <option selected value="{{$p}}" class="">{{$p}}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>

                                                    @else

                                                        <select name="features[]" multiple="multiple" id="feature{{$pricingPlan->id}}Listing"
                                                                class="form-control">

                                                    @endif



                                                        </select>

                                                    <div class="col-12 form-group mb-3 mt-3">
                                                        <label for="">Enter Your Pricing Card List Item</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text"
                                                                   id="{{$pricingPlan->id}}" multiple="multiple"
                                                                   class="enter-feature-list form-control shadow-none"
                                                                   placeholder="Type list Name"/>

                                                            <div class="input-group-append">
                                                                <button class="btn btn-success px-4 addListBtn"
                                                                        data-id="{{$pricingPlan->id}}"
                                                                        type="button">Add
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger fs-16 fw-600 requiredField"
                                                              style="display: none">Please enter a value</span>
                                                    </div>

                                                    <div class="card mb-3">
                                                        <h6 class="p-2 fw-600">Your Pricing Card List</h6>
                                                        <ol class="all-feature-listing "
                                                            id="all-feature{{$pricingPlan->id}}-listing">

                                                        </ol>
                                                    </div>


                                                </div>

                                                <div class="col-12 form-group mb-3">
                                                    <button type="submit" class="btn btn-primary w-100">Update</button>
                                                </div>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endforeach

                    </div>

                    <hr class="pt-2 bg-primary">

                    <div class="row mb-5">

                        @if(Session::has('createdOrUpdatedFaq'))
                            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('createdOrUpdatedFaq') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary fw-bold">Key Featured Listing</h4>
                            <a href="#"
                               data-bs-toggle="modal" data-bs-target="#createKeyFeatureList"
                               class="btn btn-primary-light-black-hover fw-bold">Add New Key Feature</a>

                            <div class="modal fade" id="createKeyFeatureList" tabindex="-1"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New Key Feature</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row" action="{{route('dash.key-feature.store')}}"
                                                  method="post">
                                                @csrf
                                                <div class="col-12 form-group mb-3">

                                                    @php
                                                        $keyFeaturedType = \App\Models\Pages\KeyFeatureTypes::all();
                                                    @endphp
                                                    <div class="form-group mb-3">
                                                        <label for="">Select Type</label>
                                                        <select name="type" id="" class="form-control" required>
                                                            <option value="" readonly>Select Type...</option>
                                                            @if(isset($keyFeaturedType))
                                                                @foreach($keyFeaturedType as $kftl)
                                                                    <option
                                                                        value="{{$kftl->name}}">{{$kftl->name}}</option>
                                                                @endforeach
                                                            @endif

                                                        </select>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="">Title</label>
                                                        <input type="text" name="title" class="form-control" required>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="">ToolTip</label>
                                                        <input type="text" name="tooltip" class="form-control">
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-3">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="is_free"
                                                                   type="checkbox" id="free" value="1">
                                                            <label class="form-check-label" for="free">Free</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="is_premium"
                                                                   type="checkbox" id="premium" value="1">
                                                            <label class="form-check-label"
                                                                   for="premium">Premium</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" name="is_enterprise"
                                                                   type="checkbox" id="enterprises" value="1">
                                                            <label class="form-check-label" for="enterprises">EnterPrises</label>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-primary w-100" type="submit">Create</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-12 mt-4">
                            <div class="table-responsive">
                                <table class="table table-borderless plan-feature-table">
                                    <thead>
                                    <th style="width: 30%">Key features</th>
                                    <th style="width: 30%"></th>
                                    <th style="width: 20%">Free</th>
                                    <th style="width: 20%">Premium</th>
                                    <th style="width: 20%">Enterprise</th>
                                    <th style="width: 20%">Action</th>
                                    </thead>

                                    @php
                                        $formsType = \App\Models\Pages\KeyFeatureTypes::where('id',1)->get();
                                         $ShortFormVideoType = \App\Models\Pages\KeyFeatureTypes::where('id',2)->get();
                                         $clientExperienceType = \App\Models\Pages\KeyFeatureTypes::where('id',3)->get();
                                    @endphp


                                    @if(isset($formsType))
                                        @foreach($formsType as $kftl)
                                            <tbody>
                                            <tr class="border-top">
                                                <td class="text-primary fs-4">{{$kftl->name}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            @php
                                                $forms = \App\Models\Pages\KeyFeature::where('type','Forms')->get();
                                                $ShortFormVideo = \App\Models\Pages\KeyFeature::where('type','Short Form video')->get();
                                                $clientExperience = \App\Models\Pages\KeyFeature::where('type','Client Experience')->get();
                                            @endphp

                                            @if(isset($forms))
                                                @foreach($forms as $d)
                                                    <tr>
                                                        <td>{{$d->title}}</td>
                                                        <td>
                                                            <img src="{{asset('v1.1/pricing/question.png')}}"

                                                                 @if(!is_null($d->tooltip))
                                                                 data-bs-toggle="popover"
                                                                 data-bs-html="true"
                                                                 data-bs-trigger="hover focus"
                                                                 data-bs-content="{{$d->tooltip ?? ''}}"
                                                                 @endif

                                                                 class="bg-primary-light p-1 rounded" alt="" style="cursor: pointer">
                                                        </td>
                                                        <td>
                                                            @if($d->is_free == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($d->is_premium == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($d->is_enterprise == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                           <div class="btn-group">

                                                               <a href=""
                                                                  data-bs-toggle="modal"
                                                                  data-bs-target="#update{{$d->id}}KeyFeatureList"
                                                                  class="btn btn-sm btn-success outline-none text-white" title="Edit">
                                                                   <i class="fa fa-edit px-2"></i>
                                                               </a>
                                                               <form action="{{route('dash.key-feature.destroy',$d->id)}}" method="POST">
                                                                   @csrf
                                                                   @method('DELETE')
                                                                   <button type="submit"
                                                                           title="Delete"
                                                                           onclick="return confirm('Are you sure you want to delete this?')"
                                                                           class="btn btn-sm btn-danger outline-none" href="{{route('dash.key-feature.destroy',$d->id)}}"><i class="fa fa-trash px-2"></i></button>
                                                               </form>

                                                           </div>
                                                        </td>

                                                        <div class="modal fade" id="update{{$d->id}}KeyFeatureList" tabindex="-1"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Key Feature</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="row" action="{{route('dash.key-feature.update',$d->id)}}"
                                                                              method="post">
                                                                            @csrf
                                                                            @method('PUT')

{{--                                                                            <h3>{{$d->id}}</h3>--}}
                                                                            <div class="col-12 form-group mb-3">

                                                                                @php
                                                                                    $keyFeaturedType = \App\Models\Pages\KeyFeatureTypes::all();
                                                                                @endphp
                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Select Type</label>
                                                                                    <select name="type" id="" class="form-control" required>
                                                                                        <option value="" readonly>Select Type...</option>
                                                                                        @if(isset($keyFeaturedType))
                                                                                            @foreach($keyFeaturedType as $kftl)
                                                                                                <option
                                                                                                    {{ $kftl->id === 1 ? 'selected' : '' }}
                                                                                                    value="{{$kftl->name}}">{{$kftl->name}}</option>
                                                                                            @endforeach
                                                                                        @endif

                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Title</label>
                                                                                    <input type="text" name="title" value="{{$d->title}}" class="form-control" required>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <label for="">ToolTip</label>
                                                                                    <input type="text" name="tooltip" value="{{$d->tooltip}}" class="form-control">
                                                                                </div>

                                                                                <div class="d-flex justify-content-between mb-3">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_free"
                                                                                               {{ $d->is_free == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="free" value="1">
                                                                                        <label class="form-check-label" for="free">Free</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_premium"
                                                                                               {{ $d->is_premium == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="premium" value="1">
                                                                                        <label class="form-check-label"
                                                                                               for="premium">Premium</label>
                                                                                    </div>

                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_enterprise"
                                                                                               {{ $d->is_enterprise == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="enterprises" value="1">
                                                                                        <label class="form-check-label" for="enterprises">EnterPrises</label>
                                                                                    </div>
                                                                                </div>

                                                                                <button class="btn btn-primary w-100" type="submit">Update</button>

                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        @endforeach
                                    @endif

                                    @if(isset($ShortFormVideoType))
                                        @foreach($ShortFormVideoType as $kftl)
                                            <tbody>
                                            <tr class="border-top">
                                                <td class="text-primary fs-4">{{$kftl->name}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            @php
                                                $ShortFormVideo = \App\Models\Pages\KeyFeature::where('type','Short Form video')->get();
                                            @endphp

                                            @if(isset($ShortFormVideo))
                                                @foreach($ShortFormVideo as $d)
                                                    <tr>
                                                        <td>{{$d->title}}</td>
                                                        <td>
                                                            <img src="{{asset('v1.1/pricing/question.png')}}"

                                                                 @if(!is_null($d->tooltip))
                                                                 data-bs-toggle="popover"
                                                                 data-bs-html="true"
                                                                 data-bs-trigger="hover focus"
                                                                 data-bs-content="{{$d->tooltip ?? ''}}"
                                                                 @endif

                                                                 class="bg-primary-light p-1 rounded" style="cursor: pointer" alt="">
                                                        </td>
                                                        <td>
                                                            @if($d->is_free == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($d->is_premium == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($d->is_enterprise == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="btn-group">

                                                                <a href=""
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#update{{$d->id}}KeyFeatureList"
                                                                   class="btn btn-sm btn-success outline-none text-white" title="Edit">
                                                                    <i class="fa fa-edit px-2"></i>
                                                                </a>
                                                                <form action="{{route('dash.key-feature.destroy',$d->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            title="Delete"
                                                                            onclick="return confirm('Are you sure you want to delete this?')"
                                                                            class="btn btn-sm btn-danger outline-none" href="{{route('dash.key-feature.destroy',$d->id)}}"><i class="fa fa-trash px-2"></i></button>
                                                                </form>

                                                            </div>
                                                        </td>
                                                        <div class="modal fade" id="update{{$d->id}}KeyFeatureList" tabindex="-1"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Key Feature</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="row" action="{{route('dash.key-feature.update',$d->id)}}"
                                                                              method="post">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            {{--                                                                            <h3>{{$d->id}}</h3>--}}
                                                                            <div class="col-12 form-group mb-3">

                                                                                @php
                                                                                    $keyFeaturedType = \App\Models\Pages\KeyFeatureTypes::all();
                                                                                @endphp
                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Select Type</label>
                                                                                    <select name="type" id="" class="form-control" required>
                                                                                        <option value="" readonly>Select Type...</option>
                                                                                        @if(isset($keyFeaturedType))
                                                                                            @foreach($keyFeaturedType as $kftl)
                                                                                                <option
                                                                                                    {{ $kftl->id == 2 ? 'selected' : '' }}
                                                                                                    value="{{$kftl->name}}">{{$kftl->name}}</option>
                                                                                            @endforeach
                                                                                        @endif

                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Title</label>
                                                                                    <input type="text" name="title" value="{{$d->title}}" class="form-control" required>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <label for="">ToolTip</label>
                                                                                    <input type="text" name="tooltip" value="{{$d->tooltip}}" class="form-control">
                                                                                </div>

                                                                                <div class="d-flex justify-content-between mb-3">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_free"
                                                                                               {{ $d->is_free == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="free" value="1">
                                                                                        <label class="form-check-label" for="free">Free</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_premium"
                                                                                               {{ $d->is_premium == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="premium" value="1">
                                                                                        <label class="form-check-label"
                                                                                               for="premium">Premium</label>
                                                                                    </div>

                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_enterprise"
                                                                                               {{ $d->is_enterprise == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="enterprises" value="1">
                                                                                        <label class="form-check-label" for="enterprises">EnterPrises</label>
                                                                                    </div>
                                                                                </div>

                                                                                <button class="btn btn-primary w-100" type="submit">Update</button>

                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        @endforeach
                                    @endif

                                    @if(isset($clientExperienceType))
                                        @foreach($clientExperienceType as $kftl)
                                            <tbody>
                                            <tr class="border-top">
                                                <td class="text-primary fs-4">{{$kftl->name}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            @php
                                                $clientExperience = \App\Models\Pages\KeyFeature::where('type','Client Experience')->get();
                                            @endphp

                                            @if(isset($clientExperience))
                                                @foreach($clientExperience as $d)
                                                    <tr>
                                                        <td>{{$d->title}}</td>
                                                        <td>
                                                            <img src="{{asset('v1.1/pricing/question.png')}}"
                                                                 @if(!is_null($d->tooltip))
                                                                 data-bs-toggle="popover"
                                                                 data-bs-html="true"
                                                                 data-bs-trigger="hover focus"
                                                                 data-bs-content="{{$d->tooltip ?? ''}}"
                                                                 @endif
                                                                 class="bg-primary-light p-1 rounded" style="cursor:pointer;" alt="">
                                                        </td>
                                                        <td>
                                                            @if($d->is_free == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($d->is_premium == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($d->is_enterprise == 1)
                                                                <i class="fa fa-check bg-primary-light p-1 text-white  rounded-pill"></i>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="btn-group">

                                                                <a href=""
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#update{{$d->id}}KeyFeatureList"
                                                                   class="btn btn-sm btn-success outline-none text-white" title="Edit">
                                                                    <i class="fa fa-edit px-2"></i>
                                                                </a>
                                                                <form action="{{route('dash.key-feature.destroy',$d->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            title="Delete"
                                                                            onclick="return confirm('Are you sure you want to delete this?')"
                                                                            class="btn btn-sm btn-danger outline-none" href="{{route('dash.key-feature.destroy',$d->id)}}"><i class="fa fa-trash px-2"></i></button>
                                                                </form>

                                                            </div>
                                                        </td>
                                                        <div class="modal fade" id="update{{$d->id}}KeyFeatureList" tabindex="-1"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Update Key Feature</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="row" action="{{route('dash.key-feature.update',$d->id)}}"
                                                                              method="post">
                                                                            @csrf
                                                                            @method('PUT')

                                                                            {{--                                                                            <h3>{{$d->id}}</h3>--}}
                                                                            <div class="col-12 form-group mb-3">

                                                                                @php
                                                                                    $keyFeaturedType = \App\Models\Pages\KeyFeatureTypes::all();
                                                                                @endphp
                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Select Type</label>
                                                                                    <select name="type" id="" class="form-control" required>
                                                                                        <option value="" readonly>Select Type...</option>
                                                                                        @if(isset($keyFeaturedType))
                                                                                            @foreach($keyFeaturedType as $kftl)
                                                                                                <option
                                                                                                    {{ $kftl->id == 3 ? 'selected' : '' }}
                                                                                                    value="{{$kftl->name}}">{{$kftl->name}}</option>
                                                                                            @endforeach
                                                                                        @endif

                                                                                    </select>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <label for="">Title</label>
                                                                                    <input type="text" name="title" value="{{$d->title}}" class="form-control" required>
                                                                                </div>

                                                                                <div class="form-group mb-3">
                                                                                    <label for="">ToolTip</label>
                                                                                    <input type="text" name="tooltip" value="{{$d->tooltip}}" class="form-control">
                                                                                </div>

                                                                                <div class="d-flex justify-content-between mb-3">
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_free"
                                                                                               {{ $d->is_free == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="free" value="1">
                                                                                        <label class="form-check-label" for="free">Free</label>
                                                                                    </div>
                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_premium"
                                                                                               {{ $d->is_premium == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="premium" value="1">
                                                                                        <label class="form-check-label"
                                                                                               for="premium">Premium</label>
                                                                                    </div>

                                                                                    <div class="form-check form-check-inline">
                                                                                        <input class="form-check-input" name="is_enterprise"
                                                                                               {{ $d->is_enterprise == 1  ? 'checked' : '' }}
                                                                                               type="checkbox" id="enterprises" value="1">
                                                                                        <label class="form-check-label" for="enterprises">EnterPrises</label>
                                                                                    </div>
                                                                                </div>

                                                                                <button class="btn btn-primary w-100" type="submit">Update</button>

                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>

                                                @endforeach
                                            @endif

                                            </tbody>
                                        @endforeach
                                    @endif


                                </table>
                            </div>
                        </div>
                    </div>

                    <hr class="pt-2 bg-primary">

                    <div class="row mb-5">

                        @if(Session::has('createdOrUpdatedFaq'))
                            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('createdOrUpdatedFaq') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary fw-bold">Make Money With OfferForm Section</h4>
                        </div>
                            @php
                                $associationOrBrokerageOwner = \App\Models\Pages\PricingPage::first();
                            @endphp
                            <form class="row" action="{{route('dash.pricing-page.update',$associationOrBrokerageOwner->id)}}" method="POST"enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-12 col-lg-8 form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control mb-3" name="title" value="{{$associationOrBrokerageOwner->title ?? ''}}" >
                                    <label for="">Description</label>
                                    <textarea class="form-control mb-3" id="associateID" rows="5" name="description">{!! $associationOrBrokerageOwner->description ?? '' !!}</textarea>
                                    <label for="">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="col-12 col-lg-4 form-group">
                                    <img style="" class="img-fluid" src="{{isset($associationOrBrokerageOwner->image) ? URL::asset('storage/'.$associationOrBrokerageOwner->image) : 'v1.1/pricing/mobile-image.svg' }}" alt="">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-2 px-4">Update</button>
                                </div>
                            </form>

                    </div>

                    <hr class="pt-2 bg-primary">

                    <div class="row mb-5">

                        @if(Session::has('createdOrUpdatedFaq'))
                            <p class="alert fw-bold {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('createdOrUpdatedFaq') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h4 class="text-primary fw-bold">FAQs</h4>
                            <a href="#"
                               data-bs-toggle="modal" data-bs-target="#createFaq"
                               class="btn btn-primary-light-black-hover fw-bold">Add New FAQ</a>
                        </div>

                        <div class="col-12 mt-4">
                            @foreach($faqs as $faq)
                                <livewire:dash.faqs :faq="$faq" :wire:key="$faq->id" :loopIteration="$loop->iteration">
                            @endforeach
                        </div>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="createFaq" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Faq</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row" action="{{route('dash.faqs.store')}}" method="post">
                                        @csrf
                                        <div class="col-12 form-group mb-3">
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>

                                        <div class="col-12 form-group mb-3">
                                            <label for="">Description</label>
                                            <textarea name="description" id="" required class="form-control" cols="15"
                                                      rows="5"></textarea>
                                        </div>

                                        <div class="col-12 form-group mb-3">
                                            <button type="submit" class="btn btn-primary w-100">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    @push('scripts')



        {{--        <script>--}}

        {{--            $('#btnEmailForm').click(function (e) {--}}
        {{--                $("#resultForm").find('input[name=submission_type]').val('email');--}}

        {{--            });--}}

        {{--        </script>--}}

        {{--        <script>--}}
        {{--            $("#resultForm").bind("keypress", function (e) {--}}
        {{--                if (e.keyCode == 13) {--}}
        {{--                    return false;--}}
        {{--                }--}}
        {{--            });--}}
        {{--        </script>--}}


        <script>

            $('#featureListing').hide();

            $(document).on('click', '.addListBtn', function (e) {

                e.preventDefault();

                let pricingID = $(this).data('id');

                $('#featureListing').show();

                var getValue = $('#' + $(this).data('id')).val();

                if (getValue == '') {

                    $('.requiredField').addClass('d-block');

                } else {

                    $('#all-feature' + pricingID + '-listing').append(`<li class="email-ids">${getValue} <a href="#!"  data-id="${pricingID}"  class="cancel-list ps-4 text-danger fs-20 text-decoration-none fw-bold" data-plist="${getValue}">x</a></li>`);

                    $('#feature' + pricingID + 'Listing').append('<option selected value="' + getValue + '"> ' + getValue + ' </option>');

                    $('.requiredField').addClass('d-none');

                    $('#' + $(this).data('id')).val('');

                    $('#enter-feature' + pricingID + '-list').val('');
                }

            });

            $(document).on('click', '.cancel-list', function () {

                let el = $(this);

                let getPricingDataID = $(this).data('id');

                $('#feature' + getPricingDataID + 'Listing').children('option').each(function () {
                    if ($(this).val() === el.data('plist')) {
                        $(this).remove();
                    }
                });

                el.parent().remove();
            });

            $('#formEmail').on('keyup keypress', function (e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

        </script>

        <script>
            CKEDITOR.replace( 'associateID' );
        </script>

    @endpush

</x-app-layout>
