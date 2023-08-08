@props(['disabled' => false])
<div
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'spinner-border spinner-border-sm', 'role' => 'status']) !!}
>
    <span class="visually-hidden">Loading...</span>
</div>
