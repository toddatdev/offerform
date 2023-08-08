<?php

namespace App\Http\Livewire\OfferForms\Steps\Sections\Calculators;

use App\Models\OfferForms\OfferFormOffer;
use App\Models\OfferForms\OfferFormSection;
use Livewire\Component;

class CostCalculator extends Component
{
    public $stepSection;
    public ?OfferFormOffer $offer = null;

    // Loan Fees
    public $points = 0;
    public $pointsAmount = 0;
    public $lenderOriginationFee = 0;
    public $appraisalFee = 0;

    public $totalLoanFree = 0;

    // Title & Escrow Fee
    public $lenderTitleInsurance = 0;
    public $escrowAmount = 0;

    public $totalTitleEscrowFee = 0;

    // Pre-paid Expenses
    public $homeOwnersInsurance = 0;
    public $propertyTaxAmount = 0;

    public $totalPrepaidExpenses = 0;

    // *Based upon your previously inputted info
    public $yourPurchaseCost = 0;
    public $yourDownPayment = 0;
    public $yourMortgageAmount = 0;

    public $yourTotalClosingCost = 0;
    public $yourTotalCashToClose = 0;

    public function mount() {
        if ($this->offer) {
            $this->offer->fresh();

            $this->yourPurchaseCost = sanitize_number_int($this->offer->getVariable(OfferFormOffer::VAR_FORM_CALCULATOR_OFFER_AMOUNT));
            $this->yourDownPayment = sanitize_number_int($this->offer->getVariable(OfferFormOffer::VAR_FORM_CALCULATOR_DOWN_PAYMENT));

        }

        $this->yourMortgageAmount = $this->yourPurchaseCost - $this->yourDownPayment;

        $this->lenderOriginationFee = $this->yourMortgageAmount * 0.5 / 100;
        $this->calculateLoanFee();


        $inputs = offer_form_steps_input_value($this->stepSection->offerForm->offerForm->slug, $this->stepSection->id, 'cost_calculator');

        try {



            $data = unserialize(stripslashes($inputs));

            $this->points = $data['points'] ?? 0.5;
            $this->appraisalFee = $data['appraisal_fee'] ?? 700;
            $this->lenderTitleInsurance = $data['lender_title_insurance'] ?? 1500;
            $this->escrowAmount = $data['escrow_amount'] ?? 0.01 * $this->yourPurchaseCost;
            $this->homeOwnersInsurance = $data['home_owner_insurance'] ?? 1308;
            $this->propertyTaxAmount = $data['property_amount'] ?? $this->yourPurchaseCost * 1 / 100;

            $this->calculateTitleEscrowFee();
            $this->calculatePrepaidExpenses();

            $this->calculateTotalCost();

        } catch (\Exception $e) {
            \Log::error('Seller Financing Calculator: ' . $e->getMessage(), $e->getTrace());
        }
    }

    public function render()
    {
        return view('livewire.offer-forms.steps.sections.calculators.cost-calculator');
    }

    public function calculateLoanFee() {
        $this->pointsAmount = ($this->yourMortgageAmount  * ((is_numeric($this->points) ? $this->points : 0) / 100));

        $this->totalLoanFree = $this->pointsAmount + $this->lenderOriginationFee + $this->appraisalFee;

        $this->calculateTotalCost();
    }

    public function calculateTitleEscrowFee() {
        $this->totalTitleEscrowFee =  $this->lenderTitleInsurance + $this->escrowAmount;

        $this->calculateTotalCost();
    }

    public function calculatePrepaidExpenses() {
        $this->totalPrepaidExpenses = $this->homeOwnersInsurance + $this->propertyTaxAmount;

        $this->calculateTotalCost();
    }

    public function calculateTotalCost() {
        $this->yourTotalClosingCost = $this->totalPrepaidExpenses + $this->totalTitleEscrowFee + $this->totalLoanFree;
        $this->yourTotalCashToClose = $this->yourDownPayment + $this->yourTotalClosingCost;

        $this->onCalculatorValueChanged();
    }

    public function onCalculatorValueChanged()
    {

        $this->emit('form-input-changed', 'cost_calculator', serialize([
            'points' => $this->points,
            'appraisal_fee' => $this->appraisalFee,
            'lender_title_insurance' => $this->lenderTitleInsurance,
            'escrow_amount' => $this->escrowAmount,
            'home_owner_insurance' => $this->homeOwnersInsurance,
            'property_amount' => $this->propertyTaxAmount,
        ]));
    }
}
