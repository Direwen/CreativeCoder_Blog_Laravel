<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{isset($currentCategory) ? $currentCategory->name : 'Filter by Category'}}
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if(!is_null($currentCategory))
        <a class="dropdown-item" href="/">All</a>
        @endif
        @foreach($categories as $category)
        <a 
            class="dropdown-item" 
            href="/?category={{$category->slug}}{{request('search')?'&search='.request('search') : ''}}{{request('username')?'&username='.request('username') : ''}}"
        >
            {{$category->name}}
        </a>
        @endforeach
    </div>
</div>