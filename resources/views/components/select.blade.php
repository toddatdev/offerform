@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control form-control-lg' . (isset($attributes['name']) && $errors->any() && $errors->has($attributes['name']) ? ' is-invalid' : '')]) !!}>
    {{ $slot ?? '' }}
</select>

@if(isset($attributes['name']))
    @error($attributes['name'])
    <div class="invalid-feedback">
        <span>{{ $message }}</span>
    </div>
    @enderror
@endif
