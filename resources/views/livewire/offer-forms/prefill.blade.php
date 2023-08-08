@push('stylesheets')
{{--    <style>--}}
{{--        span.cke_button_icon.cke_button__placeholder_icon{--}}
{{--            display: none !important;--}}
{{--        }--}}
{{--    </style>--}}
@endpush

<div class="container">

    <a href="{{route('dash.offer-forms.index')}}" class="btn btn-lg btn-white-black-hover btn-header me-3 fw-bold shadow-sm my-2 my-lg-0 fs-14 rounded-pill">
       <i class="fa fa-angle-left fs-20 me-3"></i> Back
    </a>

    <div class="card border-0 mb-3 mt-4 shadow-sm">
        <div class="card-body">
            <h4 class="fw-bolder text-center my-4">Click Fill To Pre-Fill The OfferForm for your Client</h4>
        </div>
    </div>

    <div
        class="card border-0 mb-3 shadow-sm"
        x-data="{isFillingNote: false, message: ''}"
        x-init="
             editor = CKEDITOR.replace('note', {
             uiColor: '#4F405b',
             // Define the toolbar: https://ckeditor.com/docs/ckeditor4/latest/features/toolbar.html
		// The full preset from CDN which we used as a base provides more features than we need.
		// Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
		toolbar: [
			{ name: 'document', items: [ 'Print' ] },
			{ name: 'clipboard', items: [ 'Undo', 'Redo' ] },
			{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
			{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
			{ name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
			{ name: 'links', items: [ 'Link', 'Unlink' ] },
			{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
			{ name: 'insert', items: [ 'Image', 'Table' ] },
			{ name: 'tools', items: [ 'Maximize' ] }
		],

		// Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
		// One HTTP request less will result in a faster startup time.
		// For more information check https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-customConfig
		customConfig: '',

		extraPlugins: 'tableresize',
		// Make the editing area bigger than default.
		height: 200,

		// This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
		bodyClass: 'document-editor',

		// Reduce the list of block elements listed in the Format dropdown to the most commonly used.
		format_tags: 'p;h1;h2;h3;pre',

		// Simplify the Image and Link dialog windows. The Advanced tab is not needed in most cases.
    removeDialogTabs: 'image:advanced;link:advanced',
    }
             );
             editor.on('change', function(event) {
                message = event.editor.getData()
                @this.set('note', event.editor.getData(), true);
             });
        "
    >
        <div class="card-body">
            <h4 class="fw-bolder text-center my-4">Send Your Client a Custom Note For this OfferForm</h4>
            <div class="text-center" x-show="!isFillingNote">

                <div class="my-3 text-start px-lg-5" x-html="message"></div>

                <a href="#" class="btn btn-primary-lighter btn-lg text-white" @click.prevent="isFillingNote = true">
                    <img src="{{asset('v1.1/icons/edit-pencil-icon.svg')}}" class="w-18 me-1 me-lg-2" alt=""/> Write note here
                </a>


            </div>
            <div x-show="isFillingNote" style="display: none">
                <x-textarea rows="5" id="note" placeholder="Please type custom note here." x-model="message" wire:model.defer="note"></x-textarea>

                <div class="text-end mt-3">
                    <button @click.prevent="isFillingNote = false"  class="btn btn-primary-light px-4">Done</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-0 mb-3 shadow-sm">
        <div class="card-body py-0">
            <livewire:offer-forms.summary
                view-type="buyer"
                :is-prefill="true"
                :offer-form="$offerFormOffer->offerForm"
                :offer="$offerFormOffer"
            />
        </div>
    </div>

    <div class="d-grid">
        <x-button
            class="text-uppercase btn-primary-light d-flex justify-content-center align-items-center rounded-3 py-3"
            wire:click.prevent="sendLink"
            wire:loading.attr="disabled"
        >
            <img src="{{ asset('v1.1/icons/send-icon.svg') }}"  class="w-24" alt="" />
            <div class="ms-2 fs-22">
                <span wire:loading wire:target="sendLink">Sending...</span>
                <span wire:loading.remove wire:target="sendLink">Send</span>
            </div>
            <span></span>
        </x-button>
    </div>

        @foreach($sections as $stepSection)
            <div class="d-none">
                <livewire:offer-forms.steps.step-section
                    :step-section="$stepSection"
                    :loop-index="$loop->index"
                    :route-is-edit="false"
                    :route-is-preview="false"
                    :offer-form-offer="$offerFormOffer"
                    :required-fields-not-filled="[]"
                    :key="$stepSection->id"
                />
            </div>
        @endforeach

    @push('scripts')
        <script>
            $(function () {
                @this.emit('summary-refresh');
                window.livewire.on('clear-prefill', function () {
                    $(document).find('.collapsedOrExpandSection').remove();
                    @this.emit('summary-refresh');
                });
            });
        </script>
    @endpush
</div>
