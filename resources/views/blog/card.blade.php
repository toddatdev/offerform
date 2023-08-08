<div class="card p-2">
    <div class="card-body text-center">
        <img class="img-fluid mb-3" src="{{ URL::asset('storage/' . $blog->image) }}" alt="">
        <div class="text-center">
            <a href="" class="title text-decoration-none text-dark">
                {{$blog->title}}
            </a>
            <p class="mt-4 mb-5">
                {!! Str::limit("$blog->content", 90, ' ...') !!}
            </p>

            <a href="{{ route('guest.blog-details',$blog->slug) }}"
               class="rounded-pill btn shadow btn-lg px-5 py-3 btn-primary text-uppercase">Read
                more</a>
        </div>
    </div>
</div>
