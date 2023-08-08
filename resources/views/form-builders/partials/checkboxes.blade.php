<div class="my-3 row">
    <div class="col-12 col-lg-10 px-3 px-lg-4 mb-3 mb-lg-5 mx-auto">
        <h3>Checkboxes Input - <a href="#" class="text-primary-light text-decoration-none">CLICK ME TO CHANGE TEXT</a>
        </h3>
        <p class="mt-4 mb-2 fw-bold">Use this input for asking a client to select one or multiple options</p>
        <p class="text-primary-light fs-18"><a href="#" class="text-decoration-none">- CLICK ME TO CHANGE TEXT</a></p>

        <div class="form pt-2 pt-lg-4 multiple-selected-values ">
            <div class="copyCheckbox hide position-relative">
                <div class="d-flex justify-content-between multiple-choice-options-list">
                    <div class="">
                        <img class="xmm-small-icon position-absolute" style="margin-left: -28px"
                             src="{{asset('img/form-builder/icons/grid.svg')}}" alt="">
                    </div>
                    <div class="">
                        <img class="xmm-small-icon position-absolute"
                             src="{{asset('img/form-builder/icons/thumbnail.svg')}}" alt="">
                    </div>
                </div>
                <div class="form-check mb-2 mb-lg-4 text-start pb-1">
                    <input class="form-check-input" type="checkbox" name="checkbox" id="checkbox">
                    <label class="form-check-label w-100" for="checkbox"
                           style="border-bottom: 1px solid #00000030 !important;">
                        <a href="#" class="text-decoration-none px-2 px-lg-3 text-primary-light fw-bold fs-18">OPTION 1 <span
                                class="text-primary-light fw-normal"> - CLICK TO CHANGE TEXT</span></a>
                    </label>
                </div>
            </div>

            <form action="action.php">
                <div class="input-group control-group multipleCheckBoxListing">

                </div>
            </form>

            <ul class="list-group list-group-horizontal add-more-button">
                <li class="list-group-item p-0 border-0 mt-1 text-start">
                    <i class="fa fa-plus fs-12 bg-primary-light text-white rounded-circle p-1 btn-plus "> </i>
                </li>

                <li class="list-group-item p-0 rounded-0 w-100 border-0 text-start"
                    style="border-bottom: 1px solid #00000030 !important;">
                    <a href="javascript:void(0)" type="button"
                       class="text-decoration-none px-2 px-lg-3 addMoreMultipleCheckBoxInput text-primary-light fs-18 ">CLICK
                        ME TO ADD MORE OPTIONS</a>
                </li>
            </ul>

        </div>
    </div>
</div>
