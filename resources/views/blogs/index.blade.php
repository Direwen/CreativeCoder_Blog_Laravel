<x-layout>
  <!-- session will return the flash msg -->
  @if(session('success'))
  <div class="alert alert-success text-center fw-bold">{{session('success')}}</div>
  @endif
  <!-- hero section -->
  <x-hero />
  <!-- blogs section -->
  <x-blogs-section 
    :blogs="$blogs" 
  />

</x-layout>