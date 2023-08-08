<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-lg rounded-pill px-4']) }}>
    {{ $slot }}
</button>
