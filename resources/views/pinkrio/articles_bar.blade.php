<div id="sidebar-blog-sidebar">
    @if (!$portfolios->isEmpty())          
        <div class="widget-first widget recent-posts">
            <h3>{{ Lang::get('ru.latest_projects') }}</h3>
            @foreach ($portfolios as $portfolio)
                <div class="recent-post group">
                    <div class="hentry-post group">
                        <div class="thumb-img"><img style="width: 55px;" src="{{ asset(config('settings.theme')) }}/images/projects/{{ $portfolio->img->mini }}" alt="{{ $portfolio->title }}" title="{{ $portfolio->title }}" /></div>
                        <div class="text">
                            <a href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}" title="{{ $portfolio->title }}" class="title">{{ $portfolio->title }}</a>
                            <p>{{ Str::limit($portfolio->text, 80) }}</p>
                            <a class="read-more" href="{{ route('portfolios.show', ['alias' => $portfolio->alias]) }}">&rarr; {{ Lang::get('ru.read_more') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    @if (!$comments->isEmpty())
        <div class="widget-last widget recent-comments">
            <h3>{{ trans('ru.latest_comments')}}</h3>
            <div class="recent-post recent-comments group">
                @foreach ($comments as $comment)
                    <div class="the-post group">
                        <div class="avatar">
                            @set ($hash, ($comment->email) ? md5($comment->email) : md5($comment->user->email))
                            <img alt="" src="https://www.gravatar.com/avatar/{{ $hash }}?d=mm&s=55" class="avatar" />   
                        </div>
                        <span class="author"><strong><a href="mailto:{{ isset($comment->user) ? $comment->user->email : $comment->email }}">{{ isset($comment->user) ? $comment->user->name : $comment->name }}</a></strong> in</span> 
                        <a class="title" href="{{ route('articles.show', ['alias' => $comment->article->alias]) }}">{{ $comment->article->title }}</a>
                        <p class="comment">
                            {{ Str::limit($comment->text, 50) }} <a class="goto" href="{{ route('articles.show', ['alias' => $comment->article->alias]) }}">&#187;</a>
                        </p>
                    </div>
                @endforeach                
            </div>
        </div>
    @endif
</div>