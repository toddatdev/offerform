<x-app-layout>
    @livewire('offer-forms.form', ['offerForm' => $offerForm ?? null, 'backTo' => url()->current()])
    @push('scripts')
        <script type="text/javascript">
            // window.onscroll = function (ev) {
            //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            //         window.livewire.emit('load-more');
            //     }
            // };
        </script>
        <script>
            $(document).ready(function (){
                window.livewire.on('offer-form-step-saved', () => {
                    $('#addCustomStepToOfferFormModal').modal('hide');
                    $('#addStepFromLibraryToOfferFormModal').modal('hide');
                });
            });
        </script>
    @endpush
</x-app-layout>
