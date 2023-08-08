<div class="my-3 row">
    <div class="col-12 col-lg-10 px-3 px-lg-4 mb-3 mb-lg-5 mx-auto">
        <h3>Logic Input - <a href="#" class="text-primary-light text-decoration-none">CLICK ME TO CHANGE TEXT</a>
        </h3>
        <p class="mt-4 mb-2 fw-bold">Use this input for asking a client to select one option from a number of different
            choices</p>
        <p class="text-primary-light fs-18"><a href="#" class="text-decoration-none">- CLICK ME TO CHANGE TEXT</a></p>

        <div class="form pt-2 pt-lg-4 multiple-selected-values ">
            <div class="copyLogicList mb-3 mb-lg-0 hide position-relative">
                <div class="d-flex justify-content-between justify-content-lg-start multiple-choice-options-list">
                    <div class="">
                        <img class="xmm-small-icon position-absolute" style="margin-left: -28px"
                             src="{{asset('img/form-builder/icons/grid.svg')}}" alt="">
                    </div>
                    <div class="">
                        <a href="#">
                            <img class="xmm-small-icon position-absolute"
                                 src="{{asset('img/form-builder/icons/pencil.svg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="form-check ps-0 ps-lg-3 mb-2 mb-lg-4 text-start pb-1 btn-group-lg">

                    <a href="#" class="btn btn-primary-light btn-logic-option my-2 my-lg-0  px-5 mx-0 mx-lg-2 rounded-pill fw-normal py-2  text-uppercase">Logic
                        option
                    </a>

                    <select name="" class="px-5 py-2 my-2 my-lg-0 mx-0 mx-lg-2 rounded-2 fw-500 select-logic-option" id="" style="border-color: #555555">
                        <option value="">If Selected Show:</option>
                        <option value="">If Selected Show:</option>
                        <option value="">If Selected Show:</option>
                    </select>

                </div>
            </div>

            <form action="action.php">
                <div class="input-group control-group multipleLogicListing">

                </div>
            </form>

            <div class="text-start">
                <a href="javascript:void(0)" type="button"
                   class="btn btn-primary-lighter text-white rounded-pill py-2 ms-0 ms-lg-4 px-5 btn-logic-option addLogicBtn text-uppercase ">Add Logic
                    <i class="fa fa-plus px-2  text-white"></i> </a>
            </div>

        </div>
    </div>
</div>
