@push('stylesheets')
    <style>
        .collapsed img{
            transform: rotate(180deg);
        }
    </style>
@endpush

<div class="card position-relative border-0 bg-transparent mb-3">
   <div class="d-flex justify-content-between">
       <div class="d-flex align-items-center">
           <div class="rounded-circle me-2 shadow-sm" style="padding: 5px;">
               <img class="agent-category-icon primary-img"
                    src="{{ $image ?? ($isPdfMode ? public_path('img/agent/icons/buyer.svg') : asset('img/agent/icons/buyer.svg'))}}"
                    style="width: 22px; height: 22px"
                    alt="">
           </div>
           <p class="fw-bold mb-0">
               <a href="" class="text-decoration-none"
                  data-bs-toggle="collapse" data-bs-target="#collapseCategory{{isset($categorizedSection) ? $categorizedSection['category']->id : 0}}" aria-expanded="true" aria-controls="collapseExample"
               >
                   {{ $name }}

               </a>
           </p>
       </div>

       @if(!$isPdfMode)
           <a href="" class="text-decoration-none fw-bold collapse-btn"
              data-bs-toggle="collapse" data-bs-target="#collapseCategory{{isset($categorizedSection) ? $categorizedSection['category']->id : 0}}" aria-expanded="true" aria-controls="collapseExample"
           >
               <img src="{{asset('v1.1/icons/category-collapsed-icon.svg')}}" class="w-30 ms-2" alt="">
           </a>
       @endif


   </div>

</div>

@foreach($sections as $section)
    <div class="{{ $loop->last ? 'mb-4' : ''}} collapsedOrExpandSection show" id="collapseCategory{{isset($categorizedSection) ? $categorizedSection['category']->id : 0}}">
        @includeWhen(!in_array($section->getSubType(), ['mortgage-calculator', 'seller-financing', 'cost-calculator']), 'livewire.offer-forms.partials.summary.section')
    </div>
@endforeach


