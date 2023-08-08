<div class="container my-4 max-width-980 ps-lg-0">
    @hasrole('agent')
        <a
            href="#"
            class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
            wire:click.prevent="goBack('{{ request()->has('backTo') ? request()->get('backTo') : route('dash.offer-forms.edit', $offerForm->slug) }}')"
        >
            <div wire:target="goBack" wire:loading>
                <x-spinner class="me-2"/>
            </div>
            <i class="fa fa-angle-left fs-20 me-3" wire:target="goBack" wire:loading.remove></i> Back
        </a>



{{--    <a--}}
{{--        href="#"--}}
{{--        class="btn fw-600 btn-primary-light-black-hover rounded px-5"--}}
{{--        wire:click.prevent="goBack('{{ request()->has('backTo') ? request()->get('backTo') : route('dash.offer-forms.edit', $offerForm->slug) }}')"--}}
{{--    >--}}
{{--        <div wire:target="goBack" wire:loading>--}}
{{--            <x-spinner class="me-2"/>--}}
{{--        </div>--}}
{{--        Back--}}
{{--    </a>--}}

{{--    @if(isset($stepSections))--}}
{{--        @if(count($stepSections) > 0)--}}
{{--            <a href="javascript:void(0)"--}}
{{--               class="btn btn-primary-light-black-hover d-none px-3 rounded expandBtn ms-md-3 fw-600">Expand--}}
{{--                All--}}
{{--                <img src="{{asset('v1.1/icons/collapsed-white-icon.svg')}}" class="w-20 mt0-5 ms-2"--}}
{{--                     style="transform: rotate(180deg)" alt=""> </a>--}}
{{--            <a href="javascript:void(0)"--}}
{{--               class="btn btn-primary-light-black-hover px-3 rounded collapseBtn ms-md-3 fw-600">Collapse All--}}
{{--                <img src="{{asset('v1.1/icons/collapsed-white-icon.svg')}}" class="w-20 mt0-5 ms-2" alt=""></a>--}}
{{--        @endif--}}
{{--    @endif--}}





    @else
        @if(is_null($offerFormStep->referral_partner_id))
            <a
                href="#"
                class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
                wire:click.prevent="goBack('{{ request()->has('backTo') ? request()->get('backTo') : route('dash.offer-forms.edit', $offerForm->slug) }}')"
            >
                <div wire:target="goBack" wire:loading>
                    <x-spinner class="me-2"/>
                </div>
                <i class="fa fa-angle-left fs-20 me-3" wire:target="goBack" wire:loading.remove></i> Back
            </a>
        @else
            <a
                href="{{ route('dash.referral-partners.edit', [$offerFormStep->referralPartner->referralPartnerType->slug, $offerFormStep->referral_partner_id]) }}"
                class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
                wire:click.prevent="goBack('{{ route('dash.referral-partners.edit', [$offerFormStep->referralPartner->referralPartnerType->slug, $offerFormStep->referral_partner_id]) }}')"
            >
                <div wire:target="goBack" wire:loading>
                    <x-spinner class="me-2"/>
                </div>
                <i class="fa fa-angle-left fs-20 me-3" wire:target="goBack" wire:loading.remove></i> Back
            </a>
        @endif
    @endhasrole
</div>


{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            $('.expandBtn').click(function () {--}}
{{--                $('.collapsedOrExpandSection').collapse('show');--}}
{{--                $('.expandBtn').addClass('d-none');--}}
{{--                $('.collapseBtn').removeClass('d-none');--}}
{{--            });--}}

{{--            $('.collapseBtn').click(function () {--}}
{{--                $('.collapsedOrExpandSection').collapse('hide');--}}
{{--                $('.expandBtn').removeClass('d-none');--}}
{{--                $('.collapseBtn').addClass('d-none');--}}
{{--            });--}}

{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
