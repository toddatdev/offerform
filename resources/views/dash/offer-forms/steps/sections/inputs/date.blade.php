@php
    $todayOrSelectDate = \Carbon\Carbon::today()->format('Y-m-d');
    try {
        $dt = $this->defaultOrValue;

        $todayOrSelectDate = \Carbon\Carbon::createFromFormat('m/d/Y', $dt)->format('Y-m-d');
    } catch (Exception $e) {
    }
@endphp

<div
    wire:ignore
    x-data="{calendarInit: false}"
    style="height: 260px"
    x-init="
        $nextTick(() => {
            el{{ $stepSection->id }}sc = $refs.stepSection_calendar{{ $stepSection->id }};
            calendar{{ $stepSection->id }}sc = jSuites.calendar(el{{ $stepSection->id }}sc, {
                value: '{{ $todayOrSelectDate }}',
                format: 'YYYY-MM-DD',
                weekdays_short: ['Su', 'Mo', 'Tu', 'We', 'Tu', 'Fr', 'Sa'],
                onchange: function (el, newValue, oldValue) {
                        const date = new Date(newValue.replace(/-/g, '/'));
                        @if(!$routeIsEdit && !$routeIsPreview)
                            if (calendarInit) {
                                $wire.onFormInputChange('date', date.toLocaleDateString());
                            }
                            calendarInit = true;
                        @endif
                    },
                });
            });
        "
    class="mt-4 w-full-md-75 calendar jcalendar-inline jcalendar-container" id="calendar{{ $stepSection->id }}"
         x-ref="stepSection_calendar{{ $stepSection->id }}"
            readonly="readonly" data-mask="yyyy-mm-dd">

</div>
