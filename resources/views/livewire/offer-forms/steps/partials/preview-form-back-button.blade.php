@auth
    @if($routeIsPreview)
        @if(!is_null($offerFormStep->referral_partner_id))
            <div class="container my-4">
                <a
                    href="{{ route('dash.referral-partners.edit', [$offerFormStep->referralPartner->referralPartnerType->slug, $offerFormStep->referral_partner_id]) }}"
                    class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
                >
                    <i class="fa fa-angle-left fs-20 me-3"></i> <span class="fs-14 fw-bold">Back</span>
                </a>
            </div>
        @else
            <div class="container my-4">
                <a
                    @can('update', $offerForm)
                    href="{{ request()->has('backTo') ? request()->get('backTo') : route('dash.offer-forms.step.edit', [$offerForm->slug, $offerFormStep->slug]) }}"
                    @else
                    href="{{ request()->has('backTo') ? request()->get('backTo') : route('dash.offer-forms.index') }}"
                    @endcan
                    class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
                >
                    <i class="fa fa-angle-left fs-20 me-3"></i> <span class="fs-14 fw-bold">Back</span>
                </a>
            </div>
        @endif
    @else
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
    @endif
@else
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
@endauth
