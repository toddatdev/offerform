<div
    class="mt-4 mb-100 w-full-md-75 mortgage-cal"
    x-data="{
        chartData: @entangle('chartData'),
        offerAmount: @entangle('offerAmount'),
        downPayment: @entangle('downPayment'),
    }"
    x-init="$nextTick(() => drawCalculatorChart(chartData, 'pie_chart{{ $stepSection->id }}'))"
    @pie-chart-reload-{{ $stepSection->id }}.window="
        drawCalculatorChart(event.detail, 'pie_chart{{ $stepSection->id }}')
    "
    wire:ignore.self
>
    <div class="mb-3 mb-lg-5">
        <hr>
        <div class="form pt-2 pt-lg-4 " x-data="{offerAmount: @entangle('offerAmount').defer}">
            <h5>How Much Do You Want To Offer?</h5>
            <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500" id="btnGroupAddon2">
                    $
                </div>
                <x-input
                    x-ref="offer_amount"
                    type="text" class="form-control border-start-0 outline-none input-data-text-primary-light"
                    placeholder="Enter Offer Amount"
                    wire:model.defer="offerAmount"
                    x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                    x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                    aria-label="Input group example" aria-describedby="btnGroupAddon2"
                    wire:loading.attr="disabled"
                    x-model="offerAmount"
                />
            </div>
            @php
                $maxOfferAmount = intval(str_replace(',', '', $offerAmount)) * 2;
            @endphp
            <div class="form-group my-3 pb-2 pb-lg-0">
                <x-input
                    type="range"
                    class="form-range border-0 outline-none"
                    id="percentage_amount"
                    min="0"
                    step="10000"
                    max="{{ $maxOfferAmount === 0 ? 1000000 : $maxOfferAmount}}"
                    wire:model.defer="offerAmount"
                    wire:change.debounce.50ms="onCalculatorValueChanged"
                    wire:loading.attr="disabled"
                    x-model="offerAmount"
                />
            </div>
        </div>

        <div class="form row pt-2 pt-lg-4 " x-data="{downPaymentPercentSlider: @entangle('downPaymentPercent').defer}">
            <h5>What’s Your Down Payment?</h5>
            <div class="col-12 col-md-10 mb-1">
                <div class="input-group">
                    <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"
                         id="btnGroupAddon2">$
                    </div>
                    <x-input
                        type="text"
                        class="form-control border-start-0 outline-none input-data-text-primary-light"
                        placeholder="Enter Down Payment"
                        wire:model.defer="downPayment"
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                        aria-label="Input group example"
                        aria-describedby="btnGroupAddon2"
                        wire:loading.attr="disabled"
                    />
                </div>
            </div>

            <div class="col-12 col-md-2 mb-1">
                <div class="input-group">
                    <x-input
                        type="text" class="form-control border-end-0 outline-none"
                        wire:model.defer="downPaymentPercent"
                        placeholder="20"
                        x-model="downPaymentPercentSlider"
                        aria-label="Input group example"
                        aria-describedby="btnGroupAddon2"
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        wire:loading.attr="disabled"

                    />

                    <div
                        class="input-group-text bg-transparent border-start-0 text-primary-light fw-500"
                        id="btnGroupAddon2"
                    >
                        %
                    </div>
                </div>
            </div>
            <div class="form-group col-12 my-3 pb-2 pb-lg-0">
                <x-input
                    type="range"
                    class="form-range border-0 outline-none"
                    id="percentage_amount"
                    min="0"
                    step="1"
                    x-model="downPaymentPercentSlider"
                    wire:model.defer="downPaymentPercent"
                    wire:change.debounce.50ms="onCalculatorValueChanged"
                    wire:loading.attr="disabled"
                    max="100"
                />

            </div>
        </div>

        <div class="my-3 mx-auto" style="width:100%;" wire:ignore>
            <div id="pie_chart{{ $stepSection->id }}"  class="calculator-anychart mx-auto" style="width: 500px; height: 350px; margin: 0; padding: 0; overflow-x: hidden" wire:ignore>
            </div>
        </div>
        <div class="">
            <h6 class="mt-3 fw-bold">Based on Today’s Average interest rate</h6>

            <h3 class="text-primary-light fw-bolder my-3">{{ $todayInterestRate }}%</h3>

            <p class="text-primary-light fw-400">
                Click <a href="#"
                         wire:click.prevent="toggleIsAdvanced"
                >
                    {{ $isAdvanced ? 'simple' : 'advanced' }}
                </a>
                to change your interest rate, taxes, and
                insurance.
            </p>
            <a href="#" wire:click.prevent="toggleIsAdvanced"
               class="btn btn-primary-light text-uppercase rounded-pill mx-auto px-3">
                {{ $isAdvanced ? 'Simple' : 'Advanced' }}
            </a>

            @if($isAdvanced)
                <div class="text-center mt-4" x-data="{interestRateSlider: @entangle('interestRate').defer}">
                    <h5 class="text-capitalize">What is your interest rate?</h5>

                    <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                        <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500">%
                        </div>
                        <x-input type="text"
                                 class="form-control border-start-0 outline-none input-data-text-primary-light"
                                 placeholder="3.25%"
                                 wire:model.defer="interestRate"
                                 x-model="interestRateSlider"
                                 x-init="IMask($el, {mask: /\d{0,2}\.?\d{1,2}/})"
                                 x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
{{--                                 wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                                 wire:loading.attr="disabled"
                        />
                    </div>
                    <div class="form-group col-12 my-3 pb-2 pb-lg-0">
                        <x-input type="range" class="form-range border-0 outline-none" id="percentage_amount"
                                 x-model="interestRateSlider"
                                 wire:model.defer="interestRate"
                                 wire:change.debounce.50ms="onCalculatorValueChanged"
                                 wire:loading.attr="disabled"
                                 min="0" step="0.01" max="100"/>
                    </div>
                </div>
                <div class="text-center" x-data="{estimatedHomeOwnersInsuranceSlider: @entangle('estimatedHomeOwnersInsurance').defer}">
                    <h5 class="text-capitalize">What is your estimated homeowners insurance?</h5>

                    <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                        <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"
                             id="btnGroupAddon2">$
                        </div>
                        <x-input type="text"
                                 class="form-control border-start-0 outline-none input-data-text-primary-light"
                                 placeholder="$5,230/Year"
                                 x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                                 wire:model.defer="estimatedHomeOwnersInsurance"
                                 x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
{{--                                 wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                                 wire:loading.attr="disabled"
                                 x-model="estimatedHomeOwnersInsuranceSlider"
                        />
                    </div>
                    @php
                        $maxEstimatedHomeownersInsurance = intval(str_replace(',', '', $estimatedHomeOwnersInsurance)) * 2;
                    @endphp
                    <div class="form-group col-12 my-3 pb-2 pb-lg-0">
                        <x-input type="range" class="form-range border-0 outline-none" id="percentage_amount"
                                 wire:model.defer="estimatedHomeOwnersInsurance"
                                 wire:change.debounce.50ms="onCalculatorValueChanged"
                                 x-model="estimatedHomeOwnersInsuranceSlider"
                                 min="0"
                                 step="50"
                                 wire:loading.attr="disabled"
                                 max="{{ $maxEstimatedHomeownersInsurance === 0 ? 10000 : $maxEstimatedHomeownersInsurance }}"
                        />
                    </div>
                </div>
                <div class="text-center" x-data="{estimatedTaxesSlider: @entangle('estimatedTaxes').defer}">
                    <h5 class="text-capitalize">What is your estimated taxes?</h5>

                    <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                        <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"
                             id="btnGroupAddon2">$
                        </div>
                        <x-input type="text"
                                 class="form-control border-start-0 outline-none input-data-text-primary-light"
                                 placeholder="$3,200/Year"
                                 x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                                 wire:model.defer="estimatedTaxes"
                                 wire:loading.attr="disabled"
                                 x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
{{--                                 wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                                 x-model="estimatedTaxesSlider"
                        />
                    </div>
                    @php
                        $maxEstimatedTaxes= intval(str_replace(',', '', $estimatedTaxes)) * 2;
                    @endphp
                    <div class="form-group col-12 my-3 pb-2 pb-lg-0">
                        <x-input type="range" class="form-range border-0 outline-none" id="percentage_amount"
                                 wire:model.defer="estimatedTaxes"
                                 wire:change.debounce.50ms="onCalculatorValueChanged"
                                 x-model="estimatedTaxesSlider"
                                 min="0"
                                 step="100"
                                 max="{{ $maxEstimatedTaxes === 0 ? 10000 : $maxEstimatedTaxes }}"
                        />
                    </div>
                </div>
                <div class="text-center" x-data="{hoaDuesSlider: @entangle('hoaDues').defer}">
                    <h5>What are the HOA dues?</h5>

                    <div class="row">
                        <div class="col-12 col-md-8 mb-1">
                            <div class="input-group">

                                <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"
                                     id="btnGroupAddon2">$
                                </div>
                                <x-input type="text"
                                         class="form-control border-start-0 outline-none input-data-text-primary-light"
                                         placeholder="$100"
                                         wire:model.defer="hoaDues"
                                         x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
{{--                                         wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                                         x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                                         wire:loading.attr="disabled"
                                         x-model="hoaDuesSlider"
                                         aria-label="Input group example" aria-describedby="btnGroupAddon2"/>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-1">
                            <div class="input-group">
                                <div class="me-2 px-3 border-0 rounded-3 fw-500 py-2 text-white fs-18"
                                     style="background-color: #cccccc">
                                    Per
                                </div>
                                <x-select wire:model.defer="hoaDuesPer"
                                          wire:change.debounce.50ms="onCalculatorValueChanged"
                                          wire:loading.attr="disabled"
                                          class="rounded-3 bg-primary-light text-white fs-16 south-down-arrow">
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </x-select>
                            </div>
                        </div>
                        @php
                            $maxHoaDues = intval(str_replace(',', '', $hoaDues)) * 2;
                        @endphp
                        <div class="form-group col-12 my-3 pb-2 pb-lg-0">
                            <x-input type="range" class="form-range border-0 outline-none" id="percentage_amount"
                                     wire:model.defer="hoaDues"
                                     wire:change.debounce.50ms="onCalculatorValueChanged"
                                     wire:loading.attr="disabled"
                                     x-model="hoaDuesSlider"
                                     min="0"
                                     step="25"
                                     max="{{$maxHoaDues === 0 ? 10000 : $maxHoaDues }}"
                            />
                        </div>
                    </div>
                </div>

{{--                <div class="text-center" x-data="{estimatedPMISlider: @entangle('estimatedPMI').defer}">--}}
{{--                    <h5>Your estimated PMI?</h5>--}}

{{--                    <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">--}}
{{--                        <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"--}}
{{--                             id="btnGroupAddon2">$--}}
{{--                        </div>--}}
{{--                        <x-input type="text"--}}
{{--                                 class="form-control border-start-0 outline-none input-data-text-primary-light"--}}
{{--                                 placeholder="$/Year"--}}
{{--                                 x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"--}}
{{--                                 wire:model.defer="estimatedPMI"--}}
{{--                                 x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"--}}
{{--                        />--}}
{{--                        @php--}}
{{--                            $maxEstimatedPMI = intval(str_replace(',', '', $estimatedPMI)) * 2;--}}
{{--                        @endphp--}}
{{--                        <div class="form-group col-12 my-3 pb-2 pb-lg-0">--}}
{{--                            <x-input type="range" class="form-range border-0 outline-none" id="percentage_amount"--}}
{{--                                     wire:model.defer="estimatedPMI"--}}
{{--                                     wire:change.debounce.500ms="onCalculatorValueChanged"--}}
{{--                                     min="0"--}}
{{--                                     x-model="estimatedPMISlider"--}}
{{--                                     step="50"--}}
{{--                                     max="{{$maxEstimatedPMI === 0 ? 10000 : $maxEstimatedPMI }}"--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


                <div class="text-center">
                    <h5>Select loan term!</h5>
                    <div class="form-group my-3 mb-3 pb-2 pb-lg-0">
                        <x-select wire:model.defer="loanTerms"
                                  wire:change.debounce.50ms="onCalculatorValueChanged"
                                  class="bg-primary-light text-white text-center select-arrow-down ">
                            <option value="30">30 Years</option>
                            <option value="15">15 Years</option>
                            <option value="5">5 Years</option>
                        </x-select>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
