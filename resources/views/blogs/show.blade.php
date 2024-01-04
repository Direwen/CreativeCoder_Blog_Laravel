<x-layout>
    <!-- single blog section -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center border-bottom border-1 border-secondary">
                <img src='{{asset("storage/$blog->thumbnail")}}' class="card-img-top" alt="..." />
                <h3 class="my-3 text-primary fw-bold text-capitalize">"{{$blog->title}}"</h3>
                <div class="d-flex justify-content-around align-items-center">
                    <div class="d-flex justify-content-between align-items-center gap-4">
                        <div>
                            <a href="/users/{{$blog->author->username}}" class="text-capitalize fw-bold">
                                {{$blog->author->name}}
                            </a>
                        </div>
                        <div class="text-secondary">
                            {{$blog->created_at->diffForHumans()}}
                        </div>
                        <div class="badge bg-primary  p-2">
                            <a href="/categories/{{$blog->category->slug}}" class="text-white text-capitalize">
                                {{$blog->category->name}}
                            </a>
                        </div>
                    </div>
                    @auth
                    <div class="text-secondary">
                        <form action="/blogs/{{$blog->slug}}/subscription" method="post">
                            @csrf
                            @if(auth()->user()->isSubscribed($blog))
                            <button class="btn btn-warning">Unsubscribe</button>
                            @else
                            <button class="btn btn-success">Subscribe</button>
                            @endif
                        </form>
                    </div>
                    @endauth
                </div>
                <h5 class="text-secondary my-3 text-start fw-bold text-decoration-underline">About</h5>
                <p class="lh-md text-start">
                    <!-- to allow html tags -->
                    {!!$blog->body!!}
                </p>
            </div>
        </div>
    </div>

    <!-- Comment Form -->
    <x-ment-form :blog="$blog" class="my-3"></x-form>

    @if($blog->comments->count())
    <x-comments :comments="$blog->comments()->latest()->paginate(3)" />
    @endif

    <x-blogs_suggestion_section :randomBlogs="$randomBlogs" />
</x-layout>