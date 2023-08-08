<x-app-layout>
    <div class="container mb-4">

        <a
            @if($user->hasRole('agent'))
                href="{{ route('dash.users.index') }}"
            @else
                href="{{ route('dash.settings') }}"
            @endif
            class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill"
            type="button"
        >
            <i class="fa fa-angle-left fs-20 me-3"></i> Back
        </a>
        <br/>
        <br/>
        @if($user->hasRole('agent'))
            <livewire:profile.agent.profile-form :user="$user"/>
            <livewire:profile.update-password-form :user="$user"/>
            <livewire:profile.update-user-notification-preferences-form :user="$user"/>
            <livewire:profile.update-user-social-media-links-form :user="$user"/>
            <livewire:profile.agent.integrations-form :user="$user"/>
            @push('scripts')
                <script>
                    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
                    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                        return new bootstrap.Popover(popoverTriggerEl)
                    })
                </script>
            @endpush
        @else
            <livewire:profile.admin.profile-form :user="$user"/>
            @if(request()->routeIs('dash.users.edit'))
                <livewire:profile.admin.update-admin-permissions-form :user="$user"/>
            @endif
        @endif
    </div>

</x-app-layout>
