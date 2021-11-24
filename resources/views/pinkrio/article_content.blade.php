<div id="content-single" class="content group">
    @if ($article)        
    <div class="hentry hentry-post blog-big group ">
        <div class="thumbnail">
            <h1 class="post-title">{{ $article->title }}</h1>
            <div class="image-wrap">
                <img src="{{ asset(config('settings.theme')) }}/images/articles/{{ $article->img->max }}" alt="{{ $article->title }}" title="{{ $article->title }}" />        
            </div>
            <p class="date">
                <span class="month">{{ $article->created_at->format('M') }}</span>
                <span class="day">{{ $article->created_at->format('d') }}</span>
            </p>
        </div>
        <div class="meta group">
            <p class="author"><span>by <a href="#" title="Posts by {{ $article->user->name }}" rel="author">{{ $article->user->name }}</a></span></p>
            <p class="categories"><span>In: <a href="{{ route('articlesCat', ['cat_alias' => $article->category->alias]) }}" title="View all posts in {{ $article->category->title }}" rel="category tag">{{ $article->category->title }}</a></span></p>
            <p class="comments"><span><a href="{{ route('articles.show', ['alias' => $article->alias]) }}#comments" title="Comment on {{ $article->title }}">{{ count($article->comments) ? count($article->comments) : '0' }} {{ Lang::choice('ru.comments', count($article->comments)) }}</a></span></p>
        </div>
        <div class="the-content single group">
            {!! $article->text !!}
            <div class="socials">
                <h2>love it, share it!</h2>
                <a href="#" class="socials-small facebook-small" title="Facebook">facebook</a>
                <a href="#" class="socials-small twitter-small" title="Twitter">twitter</a>
                <a href="#" class="socials-small google-small" title="Google">google</a>
                <a href="#" class="socials-small pinterest-small" title="Pinterest">pinterest</a>
                <a href="#" class="socials-small bookmark-small" title="{{ $article->title }}">bookmark</a>
            </div>
        </div>
        <p class="tags">Tags: <a href="#" rel="tag">book</a>, <a href="#" rel="tag">css</a>, <a href="#" rel="tag">design</a>, <a href="#" rel="tag">inspiration</a></p>
        <div class="clear"></div>
    </div>
    <div id="comments">
        <h3 id="comments-title">
            <span>{{ count($article->comments) }}</span> {{ Lang::choice('ru.comments', count($article->comments)) }}
        </h3>
        @if (count($article->comments) > 0)
            @set($comments_group, $article->comments->groupBy('parent_id'))
            <ol class="commentlist group">
                @foreach ($comments_group as $parent_id => $comments)
                    @if ($parent_id != 0)
                        @break
                    @endif
                    @include(config('settings.theme') . '.comment', ['comments' => $comments])
                @endforeach
            </ol>
        @endif
        <h2 id="trackbacks">Trackbacks and pingbacks</h2>
        <ol class="trackbacklist"></ol>
        <p><em>No trackback or pingback available for this article.</em></p>
        
        <div id="respond">
            <h3 id="reply-title">Leave a <span>Reply</span> <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">Cancel reply</a></small></h3>
            <form action="{{ route('comments.store') }}" method="post" id="commentform">
                @csrf
                @if (!Auth::check())
                    <p class="comment-form-author">
                        <label for="name">Name</label> 
                        <input id="name" name="name" type="text" value="" size="30" aria-required="true" />
                    </p>
                    <p class="comment-form-email">
                        <label for="email">Email</label> 
                        <input id="email" name="email" type="text" value="" size="30" aria-required="true" />
                    </p>
                    <p class="comment-form-url">
                        <label for="website">Website</label>
                        <input id="website" name="website" type="text" value="" size="30" />
                    </p>
                @endif                
                <p class="comment-form-comment">
                    <label for="text">Your comment</label>
                    <textarea id="text" name="text" cols="45" rows="8"></textarea>
                </p>
                <div class="clear"></div>
                <p class="form-submit">
                    <input type="hidden" name="comment_post_ID" id="comment_post_ID" value="{{ $article->id }}">
                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                    <input name="submit" type="submit" id="submit" value="Post Comment" />
                </p>
            </form>
        </div>
    </div>
    @else
    <h3>Запись не найдена либо удалена...</h3>
    @endif
</div>