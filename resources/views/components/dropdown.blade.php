<li class="nav-item dropdown">
    <a
        {{ $attributes->merge(['class' => 'nav-link dropdown-toggle', 'href' => '#', 'id' => 'navbarDropdown', 'role' => 'button', 'data-bs-toggle' => 'dropdown', 'aria-expanded' => 'false']) }}
    >
        {{ $trigger }}
    </a>

    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        {{ $content }}
    </ul>
</li>
