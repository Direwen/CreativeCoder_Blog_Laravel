@props(['name', 'type'=>'text', 'value'=>''])

<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{ucwords($name)}}</label>
    <!-- old second parameter is the default value which will be used if there's no old value -->
    <input 
        type="{{$type}}"
        id="{{$name}}" 
        class="form-control" 
        name="{{$name}}" 
        value="{!! old($name, $value) !!}"
    >
    <x-error :name="$name" />
</div>