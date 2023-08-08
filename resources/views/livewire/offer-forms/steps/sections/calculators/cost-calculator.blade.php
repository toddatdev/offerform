<div class="mt-4 mb-100 w-full-md-7 row mortgage-cal">
    <div class="col-12 col-lg-11 mb-3 mb-lg-5 mx-auto">
        <hr class="mt-5 pt-1 bg-dark">
        <div class="row py-3">
            <div class="col-12 col-lg-5">
                <p class="fs-14 text-primary-light">*Based upon your previously inputted info :</p>
                <p class="bg-primary-light fw-400 p-2 mb-0 rounded-3 text-white mb-4">Your Purchase Price:
                    <b>${{ number_format($yourPurchaseCost) }}</b></p>
                <p class="bg-primary-light fw-400 p-2 mb-0 rounded-3 text-white mb-4">Your Down payment:
                    <b>${{ number_format($yourDownPayment) }}</b></p>
                <p class="bg-primary-light fw-400 p-2 mb-0 rounded-3 text-white mb-4">Your Mortgage Amount:
                    <b>${{ number_format($yourMortgageAmount) }}</b></p>

                <div class="total-closing-cost">
                    <div class="outer-cost shadow p-3 my-auto rounded-circle" style="background-color: #C04EDD">
                        <p class="fs-18 text-white fw-light">Your</br> Total Closing Costs </br>
                            <span class="fw-bold"
                                  style="font-size: 26px">$ {{ number_format($yourTotalClosingCost) }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="row mb-3">
                    <div class="col-12 col-lg-1">
                        <div class="text-start text-lg-center mb-2 mb-lg-0 mt-2">
                            <i class="fa fa-check p-2 fa-1x text-primary-light rounded-circle"
                               style="background-color: #EBDFF5"></i>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item border-0 ">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button
                                        class="accordion-button btn-primary-light-black-hover outline-none rounded-3 py-2 px-4  fw-500"
                                        type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                        Loan Fees <span class="ms-auto">${{ number_format($totalLoanFree) }}</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne"
                                     class="accordion-collapse collapse show mt-3 rounded-3"
                                     aria-labelledby="panelsStayOpen-headingOne">
                                    <div class="accordion-body rounded-3" style="background-color: #EBDFF5">
                                        <div class="row mb-3">
                                            <div class="col-2">
{{--                                                <i--}}
{{--                                                    class="fa fa-question-circle text-primary-light fs-20"--}}
{{--                                                    aria-hidden="true">--}}
{{--                                                </i>--}}
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="Points are a fee you pay to your lender to lower your interest rate."
                                                   aria-hidden="true"></i>

                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Points</h6>
                                            </div>
                                            <div class="col-4   ">
                                                <input
                                                    type="text"
                                                    class="bg-white border-0 w-100 rounded-2 outline-none text-primary-light text-start fw-bold px-2"
                                                    placeholder="$0"
                                                    wire:model="points"
                                                    wire:change="calculateLoanFee"
                                                />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="This is the total dollar amount you have paid to reduce your interest rate. This is optional not all loan have this."
                                                   aria-hidden="true"></i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Points Amount</h6>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="pointsAmount"
                                                        wire:change="calculateLoanFee"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="This is the fee you pay your lender for processing your loan.  Typically 0.5-1 % of the loan amount."
                                                   aria-hidden="true">
                                                </i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Lender Origination Fee</h6>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="lenderOriginationFee"
                                                        wire:change="calculateLoanFee"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>
                                                {{--                                                <input--}}
                                                {{--                                                    type="text"--}}
                                                {{--                                                    class="bg-white border-0 rounded-2 w-100 text-primary-light text-start fw-bold px-2"--}}
                                                {{--                                                    placeholder="$0"--}}
                                                {{--                                                    wire:model="lenderOriginationFee"--}}
                                                {{--                                                    wire:change="calculateLoanFee"--}}
                                                {{--                                                />--}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="This fee covers the cost to have an appraiser estimate a home's market value."
                                                   aria-hidden="true">
                                                </i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Appraisal Fee</h6>
                                            </div>
                                            <div class="col-4">

                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="appraisalFee"
                                                        wire:change="calculateLoanFee"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>

                                                {{--                                                <input--}}
                                                {{--                                                    type="text"--}}
                                                {{--                                                    class="bg-white border-0 rounded-2 w-100 text-primary-light text-start fw-bold px-2"--}}
                                                {{--                                                    placeholder="$0"--}}
                                                {{--                                                    wire:model="appraisalFee"--}}
                                                {{--                                                    wire:change="calculateLoanFee"--}}
                                                {{--                                                />--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1">
                        <div class="text-start mt-2 mr-10-0" style="margin-left: -10px">
                            <i class="fa fa-question-circle fa-question-rounded p-2 fa-1x bg-primary-light text-white rounded-circle"
                               data-bs-toggle="popover" data-bs-trigger="hover"
                               data-bs-content="These fees are compensation for executing the loan. Loan origination fees are quoted as a percentage of the total loan typically %1 of the loan "
                               aria-hidden="true"></i>
                        </div>
                    </div>
                    <hr class="my-3 pt-1 bg-dark hr-90">
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-1">
                        <div class="text-start text-lg-center mb-2 mb-lg-0 mt-2">
                            <i class="fa fa-check p-2 fa-1x text-primary-light rounded-circle"
                               style="background-color: #EBDFF5"></i>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                    <button
                                        class="accordion-button btn-primary-light-black-hover outline-none rounded-3 py-2 px-4  fw-500"
                                        type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                        Title & Escrow Fees <span
                                            class="ms-auto">${{ number_format($totalTitleEscrowFee) }}</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo"
                                     class="accordion-collapse collapse show mt-3 rounded-3"
                                     aria-labelledby="panelsStayOpen-headingTwo">
                                    <div class="accordion-body rounded-3" style="background-color: #EBDFF5">
                                        <div class="row mb-3">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="This is a required fee by most lenders. It protects you and the lender from any title defects that could arise in the future."
                                                   aria-hidden="true">
                                                </i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Lenders Title Insurance</h6>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="lenderTitleInsurance"
                                                        wire:change="calculateTitleEscrowFee"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>
                                                {{--                                                <input--}}
                                                {{--                                                    type="text"--}}
                                                {{--                                                    class="bg-white border-0 rounded-2 text-primary-light text-start fw-bold w-100"--}}
                                                {{--                                                    placeholder="$0"--}}
                                                {{--                                                    wire:model="lenderTitleInsurance"--}}
                                                {{--                                                    wire:change="calculateTitleEscrowFee"--}}
                                                {{--                                                />--}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="These fees cover things like paperwork, title reports, transfer of funds, and anything else needed to close on your new property."
                                                   aria-hidden="true">
                                                </i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Escrow Amount</h6>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="escrowAmount"
                                                        wire:change="calculateTitleEscrowFee"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>
                                                {{--                                                <input--}}
                                                {{--                                                    type="text"--}}
                                                {{--                                                    class="bg-white border-0 rounded-2 text-primary-light text-start fw-bold w-100"--}}
                                                {{--                                                    placeholder="$0"--}}
                                                {{--                                                    wire:model="escrowAmount"--}}
                                                {{--                                                    wire:change="calculateTitleEscrowFee"--}}
                                                {{--                                                />--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1">
                        <div class="text-start mt-2 mr-10-0" style="margin-left: -10px">
                            <i class="fa fa-question-circle fa-question-rounded p-2 fa-1x bg-primary-light text-white rounded-circle"
                               data-bs-toggle="popover" data-bs-trigger="hover"
                               data-bs-content="These fees cover all the services provided by the title and escrow company to help close your transaction."
                               aria-hidden="true"></i>
                        </div>
                    </div>
                    <hr class="my-3 pt-1 bg-dark hr-90">
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-1">
                        <div class="text-start text-lg-center mb-2 mb-lg-0 mt-2">
                            <i class="fa fa-check p-2 fa-1x text-primary-light rounded-circle"
                               style="background-color: #EBDFF5"></i>
                        </div>
                    </div>
                    <div class="col-12 col-lg-10">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                    <button
                                        class="accordion-button btn-primary-light-black-hover outline-none rounded-3 py-2 px-4  fw-500"
                                        type="button"
                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree"
                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                        Pre-Paid Expenses <span
                                            class="ms-auto">${{ number_format($totalPrepaidExpenses) }}</span>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree"
                                     class="accordion-collapse collapse show mt-3 rounded-3"
                                     aria-labelledby="panelsStayOpen-headingThree">
                                    <div class="accordion-body rounded-3" style="background-color: #EBDFF5">

                                        <div class="row mb-3">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="Typically your lender will require you to pay the premium for one year’s worth of homeowners insurance at closing."
                                                   aria-hidden="true">
                                                </i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Home Owners Insurance</h6>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="homeOwnersInsurance"
                                                        wire:change="calculatePrepaidExpenses"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>
                                                {{--                                                <input--}}
                                                {{--                                                    type="text"--}}
                                                {{--                                                    class="bg-white border-0 rounded-2 text-primary-light text-start fw-bold w-100"--}}
                                                {{--                                                    placeholder="$0"--}}
                                                {{--                                                    wire:model="homeOwnersInsurance"--}}
                                                {{--                                                    wire:change="calculatePrepaidExpenses"--}}
                                                {{--                                                />--}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fa fa-question-circle text-primary-light fs-20"
                                                   data-bs-toggle="popover" data-bs-trigger="hover"
                                                   data-bs-content="You will be responsible to pay the remaining taxes for this calendar year at the time of closing."
                                                   aria-hidden="true">
                                                </i>
                                            </div>
                                            <div class="col-6 text-start">
                                                <h6 class="fw-bold fs-12">Property Tax Amount</h6>
                                            </div>
                                            <div class="col-4">
                                                <div class="input-group flex-nowrap">
                                                    <span
                                                        class="input-group-text bg-white p-0 fw-bold text-primary-light px-1 border-0"
                                                        id="addon-wrapping"
                                                        style="border-bottom-right-radius: 0; border-top-right-radius: 0">$</span>
                                                    <input
                                                        type="text"
                                                        class="bg-white border-0 outline-none w-100 text-primary-light text-start fw-bold px-0"
                                                        placeholder="$0"
                                                        wire:model="propertyTaxAmount"
                                                        wire:change="calculatePrepaidExpenses"
                                                        style="border-bottom-left-radius: 0;border-top-left-radius: 0;border-bottom-right-radius: 5px;border-top-right-radius: 5px;"
                                                    />
                                                </div>
                                                {{--                                                <input--}}
                                                {{--                                                    type="text"--}}
                                                {{--                                                    class="bg-white border-0 rounded-2 text-primary-light text-start fw-bold w-100"--}}
                                                {{--                                                    placeholder="$0"--}}
                                                {{--                                                    wire:model="propertyTaxAmount"--}}
                                                {{--                                                    wire:change="calculatePrepaidExpenses"--}}
                                                {{--                                                />--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1">
                        <div class="text-start mt-2 mr-10-0" style="margin-left: -10px">
                            <i class="fa fa-question-circle fa-question-rounded p-2 fa-1x bg-primary-light text-white rounded-circle"
                               data-bs-toggle="popover" data-bs-trigger="hover"
                               data-bs-content="Prepaid costs are paid at closing and placed into an escrow account to cover  future expenses you will have with your new property."
                               aria-hidden="true"></i>
                        </div>
                    </div>
                    <hr class="my-3 pt-1 bg-dark hr-90">
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-1">

                    </div>

                    <div class="col-12 col-lg-10">
                        <p class="text-white bg-primary-light p-3 rounded-3 ">Total Closing Cost<span
                                class="px-5 fw-bold">${{ number_format($yourTotalClosingCost) }}</span>
                        </p>
                    </div>
                    <div class="col-12 col-lg-1">
                        <div class="text-start mt-2 mr-10-0" style="margin-left: -10px">
                            <i class="fa fa-question-circle fa-question-rounded p-2 fa-1x bg-primary-light text-white rounded-circle"
                               data-bs-toggle="popover" data-bs-trigger="hover"
                               data-bs-content="This is the total of all your closing costs. Typically this money is paid out of pocket at the time of closing."
                               aria-hidden="true"></i>
                        </div>
                    </div>

                </div>
                <div class="row mb-2">
                    <div class="col-12 col-lg-1">
                    </div>
                    <div class="col-12 col-lg-10">
                        <p class=" p-3 fw-500 rounded-3" style="background-color: #92E3A9">Total Cash To Close
                            <span class="px-5 fw-bold">${{ number_format($yourTotalCashToClose) }}</span>
                        </p>
                    </div>
                    <div class="col-12 col-lg-1">
                        <div class="text-start mt-2 mr-10-0" style="margin-left: -10px">
                            <i class="fa fa-question-circle fa-question-rounded p-2 fa-1x bg-primary-light text-white rounded-circle"
                               data-bs-toggle="popover" data-bs-trigger="hover"
                               data-bs-content="This is the total amount of cash you will need to come up with at closing. This includes your down payment and closing costs. This does not include any additional cash you might need if your offer includes an appraisal gap clause or an escalation clause."
                               aria-hidden="true"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endpush
