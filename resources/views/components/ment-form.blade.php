@props(["blog"])


<section {{$attributes->merge(['class'=> 'container'])}}>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            @auth
            <x-card-wrapper class="border-0">
                <form action="/blogs/{{$blog->slug}}/comments" method="post">
                    @csrf
                    <textarea name="body" cols="10" rows="5" class="form-control border border-0" placeholder="Say Something"></textarea>
                    <x-error name="body" />
                    <div class="d-flex justify-content-end my-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </x-card-wrapper>
            @else
            <div class="border border-2 border-secondary bg-secondary rounded-pill text-white d-flex justify-content-center align-items-center p-2">
                <h5 class="mb-0">Please <a href="/login" class="text-info">Login</a> to participate in this discussion</h5>
            </div>
            @endauth
        </div>
    </div>
</section>