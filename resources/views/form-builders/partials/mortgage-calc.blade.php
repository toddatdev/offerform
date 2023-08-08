<div class="my-3 row mortgage-cal">
    <div class="col-12 col-lg-9 px-3 px-lg-4 mb-3 mb-lg-5 mx-auto">
        <h3>Mortgage calculator module - <a href="#" class="text-primary-light text-decoration-none">CLICK ME TO CHANGE TEXT</a></h3>

        <p class="mt-4 mb-2 fw-bold">This mortgage calculator will give an estemated monthly payment. Your clients can
            click advanced screen to set their own taxes, insurance,ect. <a href="#" class="text-decoration-none">-
                CLICK ME TO CHANGE TEXT</a></p>

        <hr>


        <div class="form pt-2 pt-lg-4 ">
            <h5>How Much Do You Want To Offer?</h5>
            <div class="form-group my-3 mb-3 pb-2 pb-lg-0">
                <x-input type="text" placeholder="$ Enter Offer Amount"/>
            </div>

            <div class="form-group my-3 pb-2 pb-lg-0">
                <x-input type="range" class="form-range border-0" id="percentage_amount"/>

            </div>
        </div>


        <div class="form row pt-2 pt-lg-4 ">
            <h5>What’s Your Down Payment?</h5>
            <div class="form-group col-12 col-md-7 col-lg-10 mb-1 pb-2 pb-lg-0">
                <x-input type="text" placeholder="$ Enter Offer Amount"/>
            </div>

            <div class="form-group col-12 col-md-5 col-lg-2  mb-2 pb-2 pb-lg-0">
                <x-input type="text" placeholder="%"/>
            </div>

            <div class="form-group col-12 my-3 pb-2 pb-lg-0">
                <x-input type="range" class="form-range border-0" id="percentage_amount"/>

            </div>


            <div class=" my-3">

                <canvas id="myChart"></canvas>
                <div class="donut-inner">
{{--                    <p class="percent">75<small>%</small></p>--}}
{{--                    <p class="price">¥ 7,500,000 </p><p>/ ¥ 10,000,000</p>--}}
                </div>

            </div>

            <div class="">
                <h6 class="mt-3 fw-bold">Based on Today’s Average interest rate</h6>

                <h3 class="text-primary-light fw-bolder my-3">3.75%</h3>

                <p class="text-primary-light fw-400">Click <a href="#">advanced</a> to change your interest rate, taxes, and
                    insurance.</p>

                <a href="#" class="btn btn-primary-light text-uppercase mx-auto rounded-3">Advanced</a>
            </div>


        </div>


    </div>
</div>
