<li class="media">
    <div class="media-right">
        <a href="">
            <img src="{{ asset('/img/persons/'.$comment->user->avatar) }}" class="media-object img-circle">
        </a>
    </div>
    <div class="media-body">
        <a href="{{ route('home.profile', $comment->user_id) }}" class="comment-author pull-right flip">{{ $comment->user->username }}</a>
        <span class="comment-date">{{ $comment->shamsi_human_created_at }}</span>

            <p>{{$comment->body}}</p>


    </div>
</li>