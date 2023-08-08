<div class="container my-4 pb-5 ">

    @role('agent')
    <div class="form-group ">
        <a href="{{ route('dash.offer-forms.completed') }}"
           class="btn btn-lg rounded-pill btn-white-black-hover fw-bold shadow-sm mx-1 pe-4  fs-14">
            <i class="fa fa-angle-left pe-3"></i> Back
        </a> <span class="">
                  {{--Start Popover--}}
                <button class="fa fa-question-circle text-decoration-none ms-2 fs-22 text-primary-light p-2 pop border-0 bg-transparent"
                        data-bs-container="body"
                        data-bs-toggle="popover"
                        data-bs-html="true"
                        data-bs-content="<p>Categories dictate what order information...</p>
                   <a href='#' class='openModalOfferCategories text-decoration-none text-dark'
                   >Click <span class='text-primary fw-bold text-decoration-underline'>HERE</span> For Even More Info</a>"
                        aria-hidden="true">
                </button>

            <!-- Modal -->
                <div class="modal fade" id="formCategories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"
{{--                     x-data="{isPlaying: false}"--}}
                >
                    <div class="modal-dialog" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal-header border-0 text-center">
                                <button type="button" class="btn-modal btnStopVideoOnModalHide  btn-primary-light-black-hover rounded-circle fs-12" data-bs-dismiss="modal" aria-label="Close">X
                                </button>
                            </div>


                            <div class=" modal-body firstTimeSetupChecklist text-center px-lg-5 pt-0" style="margin-top: 15px"

                            >
                                <h4 class="text-primary-light">OfferForm Quick tip! <img src="{{asset('img/menu-icons/quick-guide.svg')}}" class="w-28 ms-2" alt=""></h4>
                                <p class="text-primary-light fw-500">
                                    Categories dictate what order information shows up on your summary page.
                                     You can rearrange them in whatever order you would like.
                                </p>

                                <div class="first-time-user-popup-video">
                                    <video width="100%" height="320" class="stopVideoOnModalHide rounded-15 object-cover"
                                           controls>
                                        <source src="{{asset('video/offerform/form-categories.mp4')}}" type="video/mp4">
                                    </video>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>

                {{--End Popover--}}

        </span>
    </div>
    @endrole

    @role('admin')
    <div class="form-group ">
        <a href="{{ route('dash.offer-forms.index') }}"
           class="btn btn-lg rounded-pill btn-white-black-hover fw-bold shadow-sm mx-1 pe-4  fs-14">
            <i class="fa fa-angle-left pe-3"></i> Back
        </a>
        </span>
    </div>
    @endrole


    <h3 class="text-center fw-bold mb-5 mt-3">

        @role('admin')
        <img class="img-fluid mx-2" width="34" src="{{asset('logo/iconic.png')}}" alt="">
        @endrole

        @role('agent')
        <img class="img-fluid mx-2" width="28" src="{{asset('img/agent/icons/category-primary.svg')}}" alt="">
        @endrole


        {{ !auth()->user()->hasRole('agent') ? 'Admin ' : '' }}Form Categories

    </h3>

    <div wire:sortable="changeSectionSortOrder">
        {{--   Category Item     --}}
        @foreach($categories as $item)
            <div
                class="bg-primary-light py-3 category-card mb-4 rounded-2 px-3"
                wire:sortable.item="{{ $item->id }}"
            >
                <livewire:categories.form :id="$item->id" :key="$loop->index . time()"/>
            </div>
            @if(($item->user_id !== null && auth()->user()->hasRole('agent')) || auth()->user()->hasRole(['admin', 'super-admin']))
                <x-modals.delete-confirmation :id="$item->id" :action='"destroy($item->id)"' :key="time().$item->id"/>
            @endif
        @endforeach

        {{--  Add New Category Item   --}}
        <div
            class="bg-primary-lighter py-3 bg-primary-light-hover category-card mb-4 rounded-2 px-3"
        >
            <livewire:categories.form :key="time()"/>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        // window.onscroll = function (ev) {
        //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        //         window.livewire.emit('load-more');
        //     }
        // };
    </script>


    <script>
        $(".btnStopVideoOnModalHide").click(function(){
            $('.stopVideoOnModalHide').trigger('pause');
        });
    </script>

    <script>
        $(document).ready(function () {

            // Attach Button click event listener
            $(document).on('click', '.openModalOfferCategories', function(){
                $('#formCategories').modal('show');
                $(this).parents(".popover").popover('hide');
            });
        });
    </script>

{{--    <script>--}}
{{--        $(function () {--}}
{{--            var h = $(window).height();--}}
{{--            document.addEventListener('drag', function (e) {--}}
{{--                var mousePosition = e.pageY - $(window).scrollTop();--}}
{{--                var topRegion = 220;--}}
{{--                var bottomRegion = h - 220;--}}
{{--                if (e.which === 1 && (mousePosition < topRegion || mousePosition > bottomRegion)) {    // e.wich = 1 => click down !--}}
{{--                    var distance = e.clientY - h / 2;--}}
{{--                    distance = distance * 0.1; // <- velocity--}}
{{--                    $(document).scrollTop(distance + $(document).scrollTop());--}}
{{--                } else {--}}
{{--                    $(document).unbind('mousemove');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

@endpush
