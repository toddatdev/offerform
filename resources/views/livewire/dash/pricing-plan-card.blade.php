<div class="col-12 col-md-6 col-lg-4 mt-4">
   <div class="card position-relative">
       <span class="position-absolute top-0 start-0 ps-1 fw-bold">{{$pricingPlan->id}}</span>
       <div class="card-body text-center">
          <div class="text-start">
              <h4 class="fw-bold text-center">{{$pricingPlan->title}}</h4>
              <p class="text-center fw-500">{{$pricingPlan->tagline}}</p>
              <ul class="list-group list-group-flush">
                  <li class="list-group-item">An item</li>
                  <li class="list-group-item">A second item</li>
                  <li class="list-group-item">A third item</li>
                  <li class="list-group-item">A fourth item</li>
                  <li class="list-group-item">And a fifth one</li>

                  <button wire:click.prevent="update()" class="btn btn-primary-light-black-hover w-100 mt-3">Edit</button>

              </ul>

          </div>

{{--           <form wire:submit.prevent="edit({{$pricingPlan->id}})">--}}
{{--               <input type="text" name="title" wire:model="state.title" class="form-control mb-2"  placeholder="Title">--}}
{{--               <input type="text" name="tagline" wire:model="state.tagline" class="form-control mb-2" placeholder="Tagline">--}}
{{--               <input type="text" name="features" wire:model="state.features" class="form-control mb-2" placeholder="Features">--}}
{{--               <button wire:click.prevent="update()" class="btn btn-primary-light-black-hover w-100 mt-3">Update Plan</button>--}}
{{--           </form>--}}

       </div>
   </div>
</div>
