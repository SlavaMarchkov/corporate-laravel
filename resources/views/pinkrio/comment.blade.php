@foreach ($comments as $comment)
{{-- {{ dump($comment) }} --}}
    <li id="li-comment-{{ $comment->id }}" class="comment even {{ ($comment->user_id == $article->user_id) ? 'bypostauthor odd' : '' }}">
        <div id="comment-{{ $comment->id }}" class="comment-container">
            <div class="comment-author vcard">
                @set($hash, isset($comment->email) ? md5($comment->email) : md5($comment->user->email))
                <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=75" class="avatar" height="75" width="75" />
                <cite class="fn">
                    @empty($comment->name)
                       {{ $comment->user->name }}
                    @endempty
                    {{ $comment->name }}
                </cite>
            </div>
            <!-- .comment-author .vcard -->
            <div class="comment-meta commentmetadata">
                <div class="intro">
                    <div class="commentDate">
                        <a href="{{ url()->current() }}#comment-{{ $comment->id }}">
                        {{ is_object($comment->created_at) ? $comment->created_at->format('F d, Y \a\t H:i') : '' }}</a>
                    </div>
                    <div class="commentNumber"></div>
                </div>
                <div class="comment-body">
                    <p>{{ $comment->text }}</p>
                </div>
                <div class="reply group">
                    <a class="comment-reply-link" href="{{ url()->current() }}#respond" onclick="return addComment.moveForm(&quot;comment-{{ $comment->id }}&quot;, &quot;{{ $comment->id }}&quot;, &quot;respond&quot;, &quot;{{ $comment->article->id }}&quot;)">Reply</a>                    
                </div>
            </div>
        </div>
        @if (isset($comments_group[$comment->id]))
            <ul class="children">
                @include(config('settings.theme') . '.comment', ['comments' => $comments_group[$comment->id]])
            </ul>
        @endif
    </li>
@endforeach