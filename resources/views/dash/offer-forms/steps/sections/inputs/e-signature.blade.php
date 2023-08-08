@php
    $value = null;
    if (!$routeIsEdit) {
        $value = $this->defaultOrValue;
    }

@endphp

<div
    class="mt-4 w-full-md-75"
    x-data=""
>
    @if($value == null || ($value !== null && isset($value['e_signature']) && $value['e_signature'] === ''))
        <button
            class="btn btn-lg btn-primary-light-black-hover btn-signature fs-22 w-100 d-flex justify-content-between align-items-center"
            @click.prevent="$dispatch('e-signature-modal', {wireTarget: @this, isBuyer2: false})"
        >
            <span>X</span>
            <span>Click To Sign</span>
            <span></span>
        </button>
    @else
        @php
            $signature = null;
            $signedAt = null;
            if (isset($value['e_signature'])) {
                if (str_starts_with($value['e_signature'], 'signatures/')) {
                    $signature = "<img src='".Storage::disk('public')->url($value['e_signature'])."' style='height: 50px !important;'/>";
                } else {
                    $signature = $value['e_signature'];
                }

                if (isset($value['signed_at'])) {
                    try {
                        $signedAt = \Carbon\Carbon::parse($value['signed_at'])->timezone(session('ip_position:timezone', 'UTC'))->format('m/d/y g:i A');
                    } catch (Exception $e) {
                        \Illuminate\Support\Facades\Log::error('E-Signature Signed At: ', [$e->getMessage()]);
                    }
                }
            }
        @endphp
        <div class="row my-4">
            <div class="col-8 pe-0 align-self-center">
                <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD50">
                    <a href="#!" class="text-decoration-none" style="width: 100%; padding: 15px 0px;"
                       @click.prevent="$dispatch('e-signature-modal', {wireTarget: @this})"
                    >
                        <h4 class="text-dark mb-0 text-center btn-signature fw-bold">
                            {!! $signature ? $signature : 'Click here to type signature' !!}
                        </h4>
                    </a>
                </div>
            </div>
            <div class="col-4 ps-0 align-self-center">
                <div class="h-60 d-flex justify-content-center align-items-center" style="background-color: #9C4EDD80">
                    <div>
                        <p class="mb-0 fs-10 text-dark fw-500 ">OfferForm Secured</p>
                        <p class="mb-0 fs-10 text-dark fw-bold text-center">{{ $signedAt ? $signedAt : '--/--/-- --:-- --' }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
