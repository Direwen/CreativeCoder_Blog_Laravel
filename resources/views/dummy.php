<x-layout>
    <!-- this will be replaced with $title in layout file -->
    <x-slot name="title">
        <title>All Blogs</title>
    </x-slot>

    <!-- this will be replaced with $slot which is default slot variable -->
    <div class="blogs-container">
        @foreach($blogs as $blog)
        <div class="{{ $loop->odd ? 'odd-blog' : 'even-blog'}} blog">
            <h1>
                <a href="blogs/<?= $blog->slug; ?>">    
                    {{ $blog->title}}
                </a>
            </h1>
            <h3>Published At - {{$blog->created_at->diffForHumans()}}</h3>
            <h4>
                <a href="categories/{{$blog->category->slug}}">
                    Category - {{$blog->category->name}} 
                </a>
            </h4>
            <h4>
                <a href="users/{{$blog->author->username}}">
                    Author - {{$blog->author->name}} 
                </a>
            </h4>
            <p>{{$blog->intro}}</p>
        </div>
        @endforeach
    </div>
</x-layout>