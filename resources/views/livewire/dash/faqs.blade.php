<div class="card">
    <div class="card-body position-relative">
        <span class="bg-warning text-white position-absolute top-0 start-0 px-4">
            {{$loopIteration}}
        </span>
        <a
            onclick="return confirm('Are you sure?You want to delete this...')"
            wire:click.prevent="destroy({{ $faq->id }})"
           class="btn btn-sm btn-danger position-absolute top-0 end-0 ">Delete</a>
        <div class="mb-3 mt-2">
            <h5 class="text-primary fw-bold">Q : {{$faq->title}}</h5>
            <p class="ms-3 fs-13"> A : {{$faq->description}} </p>
        </div>
    </div>
</div>

