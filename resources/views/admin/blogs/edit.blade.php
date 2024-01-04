<x-admin-layout>
    <h3 class="my-3 text-center">Blog Edit Form</h3>
    <x-card-wrapper class="">
        <form action="/admin/blogs/{{$blog->slug}}/update" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <x-form.input name="title" value="{{$blog->title}}" />
            <x-form.input name="slug" value="{{$blog->slug}}" />
            <x-form.input name="intro" value="{{$blog->intro}}" />
            <x-form.textarea name="body" value="{{$blog->body}}" />
            <x-form.input name="thumbnail" type="file" />
            <img src="/storage/{{$blog->thumbnail}}" width="200" height="200" alt="">
            <x-form.input-wrapper>
                <x-form.label name="Category" />
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                    <option {{$category->id == old('category_id', $blog->category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <x-error name="category_id" />
            </x-form.input-wrapper>

            <button type="submit" class="form-control btn btn-success">Create</button>
        </form>
    </x-card-wrapper>
</x-admin-layout>