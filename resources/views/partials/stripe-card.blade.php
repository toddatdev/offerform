<!-- Stripe Elements Placeholder -->
<label>Card Number</label>
<div id="card-number-element-{{ $type }}-{{ $per }}" wire:ignore class="mb-3 border rounded" style="padding: 0.75rem 1rem"></div>
<div class="row">
    <div class="col-12 col-md-6 col-lg-6">
        <label>Expiry Month/Year</label>
        <div id="card-expiry-element-{{ $type }}-{{ $per }}" wire:ignore class="border rounded" style="padding: 0.75rem 1rem"></div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <label>CVC Number</label>
        <div id="card-cvc-element-{{ $type }}-{{ $per }}" wire:ignore class="border rounded" style="padding: 0.75rem 1rem"></div>
    </div>
</div>

