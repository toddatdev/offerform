<div
    class="mt-4 mb-100 w-full-md-75 mortgage-cal"
    x-data="{
        chartData: @entangle('chartData'),
        offerAmount: @entangle('offerAmount'),
        downPayment: @entangle('downPayment'),
    }"
    x-init="$nextTick(() => drawCalculatorChart(chartData, 'pie_chart{{ $stepSection->id }}'))"
    @pie-chart-reload-{{ $stepSection->id }}.window="
        console.log(event.detail)
        drawCalculatorChart(event.detail, 'pie_chart{{ $stepSection->id }}')
    "
>
    <div class="mb-3 mb-lg-5">
        <hr>
        {{--    Offer Amount [Start]    --}}
        <div class="form pt-2 pt-lg-4" x-data="{offerAmount: @entangle('offerAmount').defer}">
            <h5>How Much Do You Want To Offer?</h5>
            <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500" id="btnGroupAddon2">
                    $
                </div>
                <x-input
                    type="text"
                    class="form-control border-start-0 outline-none input-data-text-primary-light"
                    placeholder="Enter Offer Amount"
                    x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
{{--                    wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                    x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                    wire:model.defer="offerAmount"
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
        {{--    Offer Amount [End]    --}}

        {{--    Down Payment [Start]    --}}
        <div class="form row pt-2 pt-lg-4 " x-data="{downPaymentPercentSlider: @entangle('downPaymentPercent').defer}">
            <h5>What’s Your Down Payment?</h5>
            <div class="col-12 col-md-10 mb-1">
                <div class="input-group">
                    <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500">
                        $
                    </div>
                    <x-input
                        type="text"
                        class="form-control border-start-0 outline-none input-data-text-primary-light"
                        placeholder="Enter Down Payment"
                        x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                        wire:model.defer="downPayment"
                        wire:loading.attr="disabled"
                    />
                </div>
            </div>
            <div class="col-12 col-md-2 mb-1">
                <div class="input-group">
                    <x-input
                        type="text"
                        class="form-control border-end-0 outline-none input-data-text-primary-light"
                        wire:model.defer="downPaymentPercent"
                        placeholder="20"
                        x-model="downPaymentPercentSlider"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                        wire:loading.attr="disabled"
                    />
                    <div class="input-group-text bg-transparent border-start-0 text-primary-light fw-500">
                        %
                    </div>
                </div>
            </div>
            <div class="form-group my-3 pb-2 pb-lg-0 col-12">
                <x-input
                    type="range"
                    class="form-range border-0 outline-none"
                    x-model="downPaymentPercentSlider"
                    min="0"
                    step="1"
                    max="100"
                    wire:change.debounce.50ms="onCalculatorValueChanged"
                    wire:model.defer="downPaymentPercent"
                    wire:loading.attr="disabled"
                />
            </div>
        </div>
        {{--    Down Payment [End]    --}}

        {{-- How long Like Seller to Carry [Start] --}}
        <div class="mt-3 pb-2 pb-lg pb-lg-0">
            <h5>How Long Would You Like The Seller to Carry?</h5>
            <div class="form-group my-3 mb-3 pb-2 pb-lg-0">
                <x-select wire:model.defer="howLongSellerToCarry"
                          wire:change.debounce.50ms="onCalculatorValueChanged"
                          wire:loading.attr="disabled"
                          class="bg-primary-light text-white text-center select-arrow-down ">
                    <option value="30">30 Years</option>
                    <option value="15">15 Years</option>
                    <option value="5">5 Years</option>
                </x-select>
            </div>
        </div>
        {{-- How long Like Seller to Carry [End] --}}

        {{-- Interest Rate Pay the Seller [Start] --}}
        <div class="form pt-2 pt-lg-4 my-3 " x-data="{interestRateWantPaySellerSlider: @entangle('interestRateWantPaySeller').defer}">
            <h5>What Interest Rate Do You Want To Pay The Seller?</h5>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500">
                        %
                    </div>
                    <x-input
                        type="text"
                        class="form-control border-start-0 outline-none input-data-text-primary-light"
                        placeholder="Type here or use the slider"
                        x-model="interestRateWantPaySellerSlider"
                        x-init="IMask($el, {mask: /\d{0,2}\.?\d{1,2}/})"
                        wire:model.defer="interestRateWantPaySeller"
                        wire:loading.attr="disabled"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                    />
                </div>
            </div>
            <div class="form-group my-3 pb-2 pb-lg-0">
                <x-input
                    type="range"
                    class="form-range border-0 outline-none"
                    wire:model.defer="interestRateWantPaySeller"
                    wire:change.debounce.50ms="onCalculatorValueChanged"
                    x-model="interestRateWantPaySellerSlider"
                    wire:loading.attr="disabled"
                    min="0"
                    step="0.01"
                    max="100"
                />
            </div>
        </div>
        {{-- Interest Rate Pay the Seller [End] --}}

        {{--     Pie Chart & Toogle Advance [Start]      --}}
        <div class="mb-5 mx-auto pie-chart-container" style="width:100%;">
            <div
                id="pie_chart{{ $stepSection->id }}"
                wire:ignore.self class="calculator-anychart mx-auto" style="width: 500px; height: 350px; margin: 0; padding: 0;"
            >
            </div>
            <a href="#" wire:click.prevent="toggleIsAdvanced"
               class="btn btn-primary-light text-uppercase rounded-pill mx-auto px-3 mt-3">
                {{ $isAdvanced ? 'Simple' : 'Advanced' }}
            </a>
        </div>
        {{--     Pie Chart & Toogle Advance [End]      --}}

        @if($isAdvanced)
            <div class="text-center" x-data="{estimatedHomeOwnersInsuranceSlider: @entangle('estimatedHomeOwnersInsurance').defer}">
                <h5>What is your estimated homeowners insurance?</h5>
                <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                    <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"
                         id="btnGroupAddon2">$
                    </div>
                    <x-input
                        type="text"
                        class="form-control border-start-0 outline-none input-data-text-primary-light"
                        placeholder="$5,230/year"
                        x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                        wire:loading.attr="disabled"
                        wire:model.defer="estimatedHomeOwnersInsurance"/>
                </div>
                @php
                    $maxEstimatedHomeownersInsurance = intval(str_replace(',', '', $estimatedHomeOwnersInsurance)) * 2;
                @endphp
                <div class="form-group my-3 pb-2 pb-lg-0">
                    <x-input
                        type="range"
                        class="form-range border-0 outline-none"
                        wire:model.defer="estimatedHomeOwnersInsurance"
                        wire:change.debounce.50ms="onCalculatorValueChanged"
                        x-model="estimatedHomeOwnersInsuranceSlider"
                        wire:loading.attr="disabled"
                        min="0"
                        step="50"
                        max="{{ $maxEstimatedHomeownersInsurance === 0 ? 10000 : $maxEstimatedHomeownersInsurance }}"
                    />

                </div>
            </div>
            <div class="text-center" x-data="{estimatedTaxesSlider: @entangle('estimatedTaxes').defer}">
                <h5>What is your estimated taxes?</h5>
                <div class="input-group form-group my-3 mb-3 pb-2 pb-lg-0">
                    <div class="input-group-text bg-transparent border-end-0 text-primary-light fw-500"
                         id="btnGroupAddon2">$
                    </div>
                    <x-input
                        type="text"
                        class="form-control border-start-0 outline-none input-data-text-primary-light ph-primary-light"
                        placeholder="$3200/year"
                        x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                        wire:model.defer="estimatedTaxes"
{{--                        wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                        x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                        wire:loading.attr="disabled"
                    />
                </div>
                @php
                    $maxEstimatedTaxes= intval(str_replace(',', '', $estimatedTaxes)) * 2;
                @endphp
                <div class="form-group my-3 pb-2 pb-lg-0">
                    <x-input
                        type="range"
                        class="form-range border-0 outline-none"
                        wire:model.defer="estimatedTaxes"
                        wire:change.debounce.50ms="onCalculatorValueChanged"
                        x-model="estimatedTaxesSlider"
                        wire:loading.attr="disabled"
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
                                 id="btnGroupAddon2">
                                $
                            </div>
                            <x-input
                                type="text"
                                class="form-control border-start-0 outline-none input-data-text-primary-light ph-primary-light text-start"
                                placeholder="$100"
                                x-mask="{numeral: true, numeralIntegerScale: 10, numeralPositiveOnly: true}"
                                wire:model.defer="hoaDues"
                                wire:loading.attr="disabled"
{{--                                wire:change.debounce.50ms="onCalculatorValueChanged"--}}
                                x-on:input.change.debounce.1000ms="$wire.onCalculatorValueChanged()"
                            />
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
                </div>
                @php
                    $maxHoaDues = intval(str_replace(',', '', $hoaDues)) * 2;
                @endphp
                <div class="form-group my-3 pb-2 pb-lg-0">
                    <x-input type="range" class="form-range border-0 outline-none" wire:model.defer="hoaDues"
                             wire:change.debounce.50ms="onCalculatorValueChanged"
                             wire:loading.attr="disabled"
                             x-model="hoaDuesSlider"
                             min="0"
                             step="25"
                             max="{{$maxHoaDues === 0 ? 10000 : $maxHoaDues }}"/>

                </div>
            </div>
        @endif
    </div>

</div>
