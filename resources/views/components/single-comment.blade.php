@props(["comment"])

<div class="card mb-4">
    <div class="card-body">
        <p>{{$comment->body}}</p>

        <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center justify-content-center gap-3">
                <img src="{{$comment->author->avatar}}" alt="avatar" width="25" height="25" />
                <small class="mb-0">{{$comment->author->username}}</small>
                <small class="mb-0">{{$comment->created_at->format('M')}}</small>
            </div>
        </div>
    </div>
</div>