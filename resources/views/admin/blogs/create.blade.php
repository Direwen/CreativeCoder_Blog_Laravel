<x-admin-layout>
    <h3 class="my-3 text-center">Blog Create Form</h3>
    <x-card-wrapper class="">
        <form action="/admin/blogs/store" method="post" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title"/>
            <x-form.input name="slug" />
            <x-form.input name="intro" />
            <x-form.textarea name="body" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.input-wrapper>
                <x-form.label name="Category" />
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                    <option {{$category->id == old('category_id') ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <x-error name="category_id" />
            </x-form.input-wrapper>

            <button type="submit" class="form-control btn btn-success">Create</button>
        </form>
    </x-card-wrapper>
</x-admin-layout>