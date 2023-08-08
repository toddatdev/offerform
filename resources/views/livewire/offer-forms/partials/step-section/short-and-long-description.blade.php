<div
    class="short-and-long-description" style="position: relative"
    @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0)
        x-data="{
            shortDescEl: null,
            shortDescEditor: null,

            descEl: null,
            descEditor: null,

            isFocusOut: true,
            isEditing: false,
        }"
        x-init="
            shortDescEl = $refs.stepSection_short_description{{ $stepSection->id }};
            shortDescEditor = CKEDITOR.inline(shortDescEl,{customConfig: '{{ asset('vendor/ckeditor/config.js') }}'});

            shortDescEditor.on('blur', function(event){
                @this.set('stepSection.short_description', event.editor.getData(), true);

                // On focus out or blur
                if (shortDescEl.style.removeProperty) {
                    shortDescEl.style.removeProperty('border-color');
                } else {
                    shortDescEl.style.removeAttribute('border-color');
                }

                isFocusOut = true;
            });

            // On focus in or editing
            shortDescEditor.on('focus', function(e) {
                shortDescEl.style.borderColor = '#ccc';
                toggleClickMeToChangeTextInCKEditor(shortDescEditor, 0);
                isFocusOut = false;
                isEditing = true;
            });


            descEl = $refs.stepSection_description{{ $stepSection->id }};
            descEditor = CKEDITOR.inline(descEl, {customConfig: '{{ asset('vendor/ckeditor/config.js') }}'});

            descEditor.on('blur', function(event){
                @this.set('stepSection.description', event.editor.getData(), true);

                // On focus out or blur
                if (descEl.style.removeProperty) {
                    descEl.style.removeProperty('border-color');
                } else {
                    descEl.style.removeAttribute('border-color');
                }

                isFocusOut = true;
            });

            // On focus in or editing
            descEditor.on('focus', function(e) {
                descEl.style.borderColor = '#ccc';
                toggleClickMeToChangeTextInCKEditor(descEditor, 0);
                isFocusOut = false;
                isEditing = true;
            });

            setInterval(() => {
                if (isFocusOut && isEditing) {
                    isEditing = false;
                    @this.onChangeSection()
                }
            }, 500)
        "
        wire:ignore.self
    @endif
>
    {{--        If route is edit allow section short_descriotion and description editable with ckeditor        --}}
    @if($routeIsEdit && $stepSection->offerForm->need_to_upgrade === 0)
        {{-- Short Description --}}
        <div
            x-ref="stepSection_short_description{{ $stepSection->id }}"
            class="p-2 of-ckeditor mb-2"
            contenteditable="true"
            tabindex="0"
            spellcheck="false"
            role="textbox"
            aria-multiline="true"
            style="outline: none">
            {!! $stepSection->short_description !!}
        </div>

        {{-- Description of Long Description--}}
        <div
            x-ref="stepSection_description{{ $stepSection->id }}"
            contenteditable="true"
            class="p-2 of-ckeditor mb-2"
            tabindex="0"
            spellcheck="false"
            role="textbox"
            aria-multiline="true"
            aria-label="Rich Text Editor"
            title="Rich Text Editor"
            aria-describedby="cke_64"
            style="outline: none">
            {!! $stepSection->description !!}
        </div>
    @else
        @php
            /*
                $spansi = strpos($stepSection->short_description, '<span style="color:#c67eff !important"><span style="color:black">');
                $spanei = strpos($stepSection->short_description, 'TEXT</span>') + 11;
                $spanlen = $spanei - $spansi;

                $short_description = str_replace(substr($stepSection->short_description, $spansi, $spanlen), '', $stepSection->short_description);
            */
            $short_description = str_replace($variablesReplaceFrom, $this->variablesReplaceTo, $stepSection->short_description);
        @endphp

        {{-- If not editing then show short and long description statically --}}
        {!! $short_description !!}

        @php
            /*
                $spansi = strpos($stepSection->description, '<span style="color:#c67eff !important"><span style="color:black">');
                $spanei = strpos($stepSection->description, 'TEXT</span>') + 11;
                $spanlen = $spanei - $spansi;

                $long_description = str_replace(substr($stepSection->description, $spansi, $spanlen), '', $stepSection->description);
            */
            $long_description = str_replace($variablesReplaceFrom, $this->variablesReplaceTo, $stepSection->description);
        @endphp
        {!! $long_description !!}
    @endif

    <div wire:loading wire:target="onChangeSection" class="rounded" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0, 0.2)">
        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
            <x-spinner style="width: 60px; height: 60px"/>
        </div>
    </div>
</div>
