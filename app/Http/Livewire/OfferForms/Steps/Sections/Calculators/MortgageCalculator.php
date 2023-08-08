<?php

namespace App\Http\Livewire\OfferForms\Steps\Sections\Calculators;

use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use App\Models\OfferForms\OfferFormSubmittedSection;
use Livewire\Component;

class MortgageCalculator extends Component
{
    public $stepSection;
    public $submittedSection;
    public $offer;

    public $chartData = [
        'P&I'       => 0,
        'HOA'       => 0,
        'PMI'       => 0,
        'INSURANCE' => 0,
        'TAXES'     => 0,
    ];

    public $isAdvanced = false;

    public $todayInterestRate = null;

    public $offerAmount;
    public $downPayment;
    public $downPaymentPercent = 20;

    public $interestRate;
    public $estimatedHomeOwnersInsurance = 1260;
    public $estimatedTaxes;
    public $hoaDues;
    public $hoaDuesPer = 'month';
    public $estimatedPMI;
    public $loanTerms = 30;

    public $routeIsEdit;

    public function mount()
    {
        //        $inputs = offer_form_steps_input_value($this->stepSection->offerForm->offerForm->slug, $this->stepSection->id,'mortgage_calculator');
        $inputs = $this->submittedSection ? $this->submittedSection->user_response['mortgage_calculator'] ?? '' : '';

        try {
            $data = unserialize(stripslashes($inputs));

            $this->isAdvanced = $data['is_advanced'] ?? false;
            $this->offerAmount = $data['offerAmount'] ?? null;
            $this->downPayment = $data['down_payment'] ?? null;
            $this->downPaymentPercent = $data['down_payment_percent'] ?? $this->downPaymentPercent;
            $this->interestRate = floatval($data['interest_rate'] ?? $this->todayInterestRate);
            $this->estimatedHomeOwnersInsurance = $data['estimated_home_owners_insurance'] ?? $this->estimatedHomeOwnersInsurance;
            $this->estimatedTaxes = $data['estimated_taxes'] ?? null;
            $this->hoaDues = $data['hoa_dues'] ?? null;
            $this->hoaDuesPer = $data['hoa_dues_per'] ?? $this->hoaDuesPer;
            $this->estimatedPMI = $data['estimated_pmi'] ?? null;
            $this->loanTerms = $data['loan_terms'] ?? $this->loanTerms;
            $this->chartData = $data['chart_data'] ?? $this->chartData;

            $this->todayInterestRate = today_interest_rate($this->offerAmount, $this->downPayment);

            $this->refreshCalculations();
        } catch (\Exception $e) {
            \Log::error($e->getTrace());
        }
    }

    public function refreshCalculations()
    {
        $offerAmount = sanitize_number_int($this->offerAmount ?? 0);
        $downPayment = sanitize_number_int($this->downPayment ?? 0);
        $estimatedHomeownersInsurance = sanitize_number_int($this->estimatedHomeOwnersInsurance ?? 0);
        $estimatedTaxes = sanitize_number_int($this->estimatedTaxes ?? 0);
        $estimatedPMI = sanitize_number_int($this->estimatedPMI ?? 0);


        if (!($estimatedTaxes > 0)) {
            $estimatedTaxes = round($offerAmount * 0.01);
        }


        $interestRate = 0;
        if ($this->interestRate === 0) {
            $interestRate = $this->todayInterestRate;
        } else {
            $interestRate = $this->interestRate;
        }


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
        if ($interestRate > 0 && $p > 0) {
            // Interest rate per month
            $r = ($interestRate / 100) / 12;
            // How long seller to carry in months
            $n = $this->loanTerms /* No. Years Loan Term*/ * 12;

            // Calculate Principle & Interest
            $pi = round(($p * $r * (pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1)));
        }

        /**
         * Calculate homeowners insurance dividing by 12 months
         */
        if ($estimatedHomeownersInsurance > 0) {
            //            if ($this->hom)
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
                $hoa = sanitize_number_int($this->hoaDues);
            } else {
                $hoa = round(sanitize_number_int($this->hoaDues) / 12);
            }
        }

        // When the user enters less than %20 down we need the estimated payment to include PMI.
        // Of 1% of the loan balance.
        // Divided by 12 months.
        if ($estimatedPMI > 0) {
            $pmi = $estimatedPMI / 12;
        } elseif ($this->downPaymentPercent < 20) {
            $pmi =  round(($offerAmount * 0.01) / 12);
            $this->estimatedPMI = $pmi;
        }

        // Estimated payment per month
        $estimatedPayment = $pi + $homeownersInsurance + $propertyTaxes + round($hoa) + $pmi;

        // Initialize chart data
        $this->chartData = [
            'P&I'       => (int) $pi,
            'HOA'       => round($hoa),
            'PMI'       => $pmi,
            'INSURANCE' => (int) $homeownersInsurance,
            'TAXES'     => (int) $propertyTaxes,
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

    public function render()
    {
        return view('livewire.offer-forms.steps.sections.calculators.mortgage-calculator');
    }

    public function toggleIsAdvanced()
    {
        $this->isAdvanced = !$this->isAdvanced;
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
            $this->interestRate = $this->todayInterestRate;

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
            $this->interestRate = $this->todayInterestRate;
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
            $this->downPaymentPercent = (int) ((sanitize_number_int($value) / sanitize_number_int($this->offerAmount)) * 100);
            $this->todayInterestRate = today_interest_rate($this->offerAmount, $this->downPayment);
            $this->interestRate = $this->todayInterestRate;
        }
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function updatedEstimatedHomeOwnersInsurance($value)
    {
        if ($value > 0) {
            $this->estimatedHomeOwnersInsurance = number_format(sanitize_number_int($value));
        }
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function updatedEstimatedTaxes($value)
    {
        if ($value > 0) {
            $this->estimatedTaxes = number_format(sanitize_number_int($value));
        }
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function updatedEstimatedPMI($value)
    {
        if ($value > 0) {
            $this->estimatedPMI = number_format(sanitize_number_int($value));
        }
    }

    /**
     * @param $value
     *
     * @return void
     */
    public function updatedHoaDues($value)
    {
        if ($value > 0) {
            $this->hoaDues = number_format(sanitize_number_int($value));
        }
    }

    public function onCalculatorValueChanged()
    {

        $this->refreshCalculations();

        if (!$this->routeIsEdit) {
            $this->emitUp('onChangeOfferAmountOrDownPayment', $this->offerAmount, $this->downPayment);
            $this->emitUp('form-input-changed', 'mortgage_calculator', serialize([
                'is_advanced'                     => $this->isAdvanced,
                'today_interest_rate'             => $this->todayInterestRate,
                'offerAmount'                     => $this->offerAmount,
                'down_payment'                    => $this->downPayment,
                'down_payment_percent'            => $this->downPaymentPercent,
                'interest_rate'                   => "$this->interestRate",
                'estimated_home_owners_insurance' => $this->estimatedHomeOwnersInsurance,
                'estimated_taxes'                 => $this->estimatedTaxes,
                'hoa_dues'                        => $this->hoaDues,
                'hoa_dues_per'                    => $this->hoaDuesPer,
                'estimated_pmi'                   => $this->estimatedPMI,
                'loan_terms'                      => $this->loanTerms,
                'chart_data'                      => $this->chartData,
            ]));
        }
    }
}
