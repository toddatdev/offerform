<div>
    <form class="card border-0 mb-4 shadow-sm p-3" wire:submit.prevent="saveBillingPreferencesPerLead">
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <h6 class="fw-bold align-self-center me-4 pt-1">Bill per Lead</h6>
                <input
                    class="form-check-input ms-4 check-filled"
                    type="radio"
                    value="lead"
                    wire:model.defer="state.bill_per"
                    style="height: 18px;width: 18px"
                />
            </div>
            <div class="row mt-4 mb-2">
                <div class="col-12 col-md-6 col-lg-3 mb-3">
                    <div class="form-group px-3">
                        <label for="" class="fw-bold text-capitalize">Cost Per Lead</label>
                        <div class="input-group">
                            <div class="input-group-text bg-transparent border-end-0 fw-bold"
                                 id="btnGroupAddon2">$
                            </div>
                            <x-input
                                class="form-control form-control-lg border-start-0 fw-bold text-end outline-none ph-16"
                                type="number" placeholder="0" wire:model.defer="state.bill_per_lead.cost_per_lead" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="form-group mb-3 px-3">
                        <label for="" class="fw-bold text-capitalize">Total Number of leads sent </label>
                        <x-input class="bg-primary-light text-white text-end ph-white-text-right ph-16"
                                 value="{{ $referralPartner->leads->count() }}"
                                 placeholder="0"/>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mb-3">
                    <div class="form-group px-3">
                        <label for="" class="fw-bold text-capitalize">Total Monthly Charge</label>
                        <div class="input-group ">
                            <div
                                class="input-group-text border-end-0 fw-bold bg-primary-light text-white white-placeholder"
                                id="btnGroupAddon2">$
                            </div>
                            <input
                                class="form-control form-control-lg border-start-0 fw-bold ph-16 bg-primary-light text-white ph-white-text-right text-end outline-none"
                                type="text" placeholder="0"
                                value="{{ $referralPartner->leads->count() * isset($state['bill_per_lead']) && isset($state['bill_per_lead']['cost_per_lead']) ? $state['bill_per_lead']['cost_per_lead'] : 0}}"
                            />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3 mb-3">
                    <div class="form-group px-3">
                        <label for="" class="fw-bold text-capitalize">Monthly payment Due Date</label>
                        <x-input class="form-control form-control-lg fw-bold text-center outline-none"
                               type="date" placeholder="200" wire:model.defer="state.bill_per_lead.due_date" />
                    </div>
                </div>

                <div class="text-end mt-4 ">
                    <button type="submit" class="btn btn-lg btn-primary-light px-5 rounded-3 ">SAVE</button>
                </div>

            </div>
        </div>
    </form>
    <form class="card border-0 mb-4 shadow-sm p-3" wire:submit.prevent="saveBillingPreferencesPerMonth">
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <h6 class="fw-bold align-self-center me-4 pt-1">Bill per Month</h6>
                <input
                    class="form-check-input ms-4"
                    type="radio"
                    value="month"
                    wire:model.defer="state.bill_per"
                    style="height: 18px;width: 18px"
                />
            </div>
            <div class="row mt-4 mb-2">
                <div class="col-12 col-md-6 col-lg-3 offset-lg-3 mb-3">
                    <div class="form-group px-3">
                        <label for="" class="fw-bold">Total Monthly Charge</label>
                        <div class="input-group">
                            <div class="input-group-text bg-transparent border-end-0 fw-bold"
                                 id="btnGroupAddon2">$
                            </div>
                            <x-input
                                class="form-control form-control-lg border-start-0 fw-bold text-end outline-none ph-16"
                                type="text" placeholder="0" wire:model.defer="state.bill_per_month.charge_per_month" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3  mb-3">
                    <div class="form-group px-3">
                        <label for="" class="fw-bold">Monthly payment due Date</label>
                        <x-input class="form-control form-control-lg fw-bold text-center outline-none"
                               type="date" placeholder="" wire:model.defer="state.bill_per_month.due_date" />
                    </div>
                </div>

                <div class="text-end mt-4 ">
                    <button type="submit" class="btn btn-lg btn-primary-light px-5 rounded-3 ">SAVE</button>
                </div>

            </div>
        </div>
    </form>

</div>
