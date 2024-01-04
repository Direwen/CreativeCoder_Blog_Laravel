@props(['comments'])

<div class="row d-flex justify-content-center">
  <div class="col-md-8 col-lg-6">
    <x-card-wrapper class="bg-secondary">
      <h5 class="text-light">Comments ({{$comments->count()}})</h5>
      <!-- single comment  -->
      @foreach($comments as $comment)
      <x-single-comment :comment="$comment" />
      @endforeach

      {{$comments->links()}}
    </x-card-wrapper>
  </div>
</div>