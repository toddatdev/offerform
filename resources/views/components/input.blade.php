@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control form-control-lg' . (isset($attributes['name']) && $errors->any() && $errors->has($attributes['name']) ? ' is-invalid' : '')]) !!} />

@if(isset($attributes['name']))
    @error($attributes['name'])
        <div class="invalid-feedback d-block">
            <span>{{ $message }}</span>
        </div>
    @enderror
@endif
