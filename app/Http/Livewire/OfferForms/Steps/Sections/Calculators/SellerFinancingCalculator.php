<?php

namespace App\Http\Livewire\OfferForms\Steps\Sections\Calculators;

use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSubmittedSection;
use Livewire\Component;

class SellerFinancingCalculator extends Component
{
    /**
     * @var \App\Models\OfferForms\OfferFormSection
     */
    public $stepSection;
    public $submittedSection;
    public $offer;

    /**
     * @var int[]
     */
    public $chartData = [
        'P&I' => 0,
        'HOA' => 0,
        'PMI' => 0,
        'INSURANCE' => 0,
        'TAXES' => 0,
    ];

    /**
     * @var bool
     */
    public $isAdvanced = false;

    /**
     * @var int
     */
    public $todayInterestRate = null;

    /**
     * @var
     */
    public $offerAmount;
    /**
     * @var
     */
    public $downPayment;
    /**
     * @var int
     */
    public $downPaymentPercent = 20;
    /**
     * @var
     */
    public $howLongSellerToCarry = 30;

    /**
     * A mortgage annual percentage rate (APR) includes the yearly
     * cost of borrowing money, expressed as a percentage, and is
     * based on the loan interest rate, mortgage points, and other homebuying costs.
     * Credit score rate estimates are national averages based on a 30-year fixed-rate loan of $300,000.
     * (APR %)
     *
     * @var int
     */
    public $interestRateWantPaySeller;

    /**
     * @var
     */
    public $interestRate;
    /**
     * @var
     */
    public $estimatedHomeOwnersInsurance = 1260;
    /**
     * @var
     */
    public $estimatedTaxes;
    /**
     * @var
     */
    public $hoaDues;
    /**
     * @var string
     */
    public $hoaDuesPer = 'month';

    /**
     * @var int
     */
    public $finalEstimatedPayment = 0;

    public $routeIsEdit;

    /**
     * @return void
     */
    public function mount()
    {
//        $inputs = offer_form_steps_input_value($this->stepSection->offerForm->offerForm->slug, $this->stepSection->id,
//            'seller_financing_calculator');
        $inputs = $this->submittedSection ? $this->submittedSection->user_response['seller_financing_calculator'] ?? '' : '';

        try {

            $data = unserialize(stripslashes($inputs));

            $this->isAdvanced = $data['is_advanced'] ?? false;
            $this->offerAmount = $data['offerAmount'] ?? null;
            $this->downPayment = $data['down_payment'] ?? null;
            $this->downPaymentPercent = $data['down_payment_percent'] ?? $this->downPaymentPercent;
            $this->interestRate = floatval($data['interest_rate'] ?? $this->todayInterestRate);
            $this->interestRateWantPaySeller = floatval($data['interest_rate_want_to_pay_seller'] ?? null);
            $this->estimatedHomeOwnersInsurance = $data['estimated_home_owners_insurance'] ?? $this->estimatedHomeOwnersInsurance;
            $this->estimatedTaxes = $data['estimated_taxes'] ?? null;
            $this->hoaDues = $data['hoa_dues'] ?? null;
            $this->hoaDuesPer = $data['hoa_dues_per'] ?? $this->hoaDuesPer;
            $this->howLongSellerToCarry = $data['how_long_seller_to_carry'] ?? $this->howLongSellerToCarry;
            $this->chartData = $data['chart_data'] ?? $this->chartData;

            $this->todayInterestRate = today_interest_rate($this->offerAmount, $this->downPayment);

            $this->refreshCalculations();
        } catch (\Exception $e) {
            \Log::error('Seller Financing Calculator: ' . $e->getMessage(), $e->getTrace());
        }
    }

    /**
     * Perform calculations and populate data
     *
     * @return void
     */
    public function refreshCalculations()
    {
        $offerAmount = sanitize_number_int($this->offerAmount ?? 0);
        $downPayment = sanitize_number_int($this->downPayment ?? 0);
        $estimatedHomeownersInsurance = sanitize_number_int($this->estimatedHomeOwnersInsurance ?? 0);
        $estimatedTaxes = sanitize_number_int($this->estimatedTaxes ?? 0);


        if (!($estimatedTaxes > 0)) {
            $estimatedTaxes = round($offerAmount * 0.01);
        }


        $interestRate = filter_var($this->interestRateWantPaySeller, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

        // Homeowners insurance
        $homeownersInsurance = 0;

        // Property taxes
        $propertyTaxes = 0;

        // Homeowners Association Fee
        $hoa = 0;

        // Private Mortgage Insurance (Calculate in case of Down Payment is below 20%)
        $pmi = 0;

        // Principal Amount
        $p = $offerAmount - $downPayment;

        $pi = 0;

        if (!is_null($interestRate) && $interestRate > 0 && $p > 0) {
            // Interest rate per month
            $r = ($interestRate / 100) / 12;
            // How long seller to carry in months
            $n = $this->howLongSellerToCarry /* No. Years Loan Term*/ * 12;

            // Calculate Principle & Interest
            $pi = round(($p * $r * (pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1)));

        }

        /**
         * Calculate homeowners insurance dividing by 12 months
         */
        if ($estimatedHomeownersInsurance > 0) {
            $homeownersInsurance = round($estimatedHomeownersInsurance / 12);
        }

        /**
         * Calculate estimated taxes dividing by 12 months
         */
        if ($estimatedTaxes > 0) {
            $propertyTaxes = round($estimatedTaxes / 12);
            $this->estimatedTaxes = number_format($estimatedTaxes);
        }

        /**
         * Calculate homeowners associate fee dividing by 12 months if selected by per year.
         */
        if ($this->hoaDues > 0) {
            if ($this->hoaDuesPer == "month") {
                $hoa = (int)filter_var($this->hoaDues, FILTER_SANITIZE_NUMBER_INT);
            } else {
                $hoa = round(filter_var($this->hoaDues, FILTER_SANITIZE_NUMBER_INT) / 12);
            }
        }

        // When the user enters less than %20 down we need the estimated payment to include PMI.
        // Of 1% of the loan balance.
        // Divided by 12 months.
        if ($this->downPaymentPercent < 20) {
            $pmi =  round(($offerAmount * 0.01) / 12);
        }
        // Estimated payment per month
        $estimatedPayment = $pi + $homeownersInsurance + $propertyTaxes + round($hoa) + $pmi;

        // Initialize chart data
        $this->chartData = [
            'P&I' => (int)$pi,
            'HOA' => round($hoa),
            'PMI' => $pmi,
            'INSURANCE' => (int)$homeownersInsurance,
            'TAXES' => (int)$propertyTaxes,
        ];

        /**
         * Initialize and update variables 'offer amount' and 'down payment'
         */
        if ($this->offer) {
            $variables = $this->offer->variables ?? [];

            $variables[OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT] = $offerAmount;
            $variables[OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT] = $downPayment;

            $this->offer->variables = array_filter($variables);
            $this->offer->save();
        }

        // Send browser event to populate data in chart
        $this->dispatchBrowserEvent('pie-chart-reload-' . $this->stepSection->id, $this->chartData);
    }


    /**
     * @param $value
     *
     * @return void
     */
    public function updatedOfferAmount($value)
    {
        if ($value > 0) {
            $this->downPayment = number_format(sanitize_number_int($value) * ($this->downPaymentPercent / 100));
            $this->offerAmount = number_format(sanitize_number_int($value));

            $this->todayInterestRate = today_interest_rate($this->offerAmount, $this->downPayment);
            $this->interestRateWantPaySeller = $this->todayInterestRate;

            $this->estimatedTaxes = round(sanitize_number_int($value) * 0.01);
        }
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function updatedDownPaymentPercent($value)
    {
        if ($value > 0) {
            $this->downPayment = number_format((sanitize_number_int($this->offerAmount) * ($value / 100)));
            $this->todayInterestRate = today_interest_rate($this->offerAmount, $this->downPayment);
            $this->interestRateWantPaySeller = $this->todayInterestRate;
        }
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function updatedDownPayment($value)
    {
        if ($value > 0) {
            $this->downPaymentPercent = (int)((sanitize_number_int($value) / sanitize_number_int($this->offerAmount)) * 100);
            $this->todayInterestRate = today_interest_rate($this->offerAmount, $this->downPayment);
            $this->interestRateWantPaySeller = $this->todayInterestRate;
        }
    }

    /**
     * Toggle advance or less feature in calculator
     *
     * @return void
     */
    public function toggleIsAdvanced()
    {
        $this->isAdvanced = !$this->isAdvanced;
        // Send browser event to populate data in chart
        $this->dispatchBrowserEvent('pie-chart-reload-' . $this->stepSection->id, $this->chartData);
    }

    /**
     * On change calculations in calculator
     *
     * @return void
     */
    public function onCalculatorValueChanged()
    {

        $this->refreshCalculations();

        if (!$this->routeIsEdit) {
            $this->emitUp('onChangeOfferAmountOrDownPayment', $this->offerAmount, $this->downPayment);
            $this->emitUp('form-input-changed', 'seller_financing_calculator', serialize([
                'is_advanced' => $this->isAdvanced,
                'offerAmount' => $this->offerAmount,
                'down_payment' => $this->downPayment,
                'down_payment_percent' => $this->downPaymentPercent,
                'interest_rate' => "$this->interestRate",
                'interest_rate_want_to_pay_seller' => "$this->interestRateWantPaySeller",
                'estimated_home_owners_insurance' => $this->estimatedHomeOwnersInsurance,
                'estimated_taxes' => $this->estimatedTaxes,
                'hoa_dues' => $this->hoaDues,
                'hoa_dues_per' => $this->hoaDuesPer,
                'how_long_seller_to_carry' => $this->howLongSellerToCarry,
                'chart_data' => $this->chartData,
            ]));
        }

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.offer-forms.steps.sections.calculators.seller-financing-calculator');
    }
}
