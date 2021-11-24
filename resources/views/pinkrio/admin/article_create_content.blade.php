<div id="content-home" class="content group">
    <div class="hentry group">
        {!! Form::open(
            [
                'url' => (isset($article->id) 
                            ? route('admin.articles.update', ['article' => $article->alias]) 
                            : route('admin.articles.store')), 
                'class' => 'contact-form', 
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
            ]
        ) !!}                  
        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Название</span><br />
                    <span class="sublabel">Заголовок новой записи</span><br />
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-cog"></i></span>
                    {!! Form::text(
                        'title',
                        isset($article->title) ? $article->title : old('title'),
                        ['placeholder' => 'Введите название новой записи']
                    ) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ключевые слова</span><br />
                    <span class="sublabel">Ключевые слова</span><br />
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-cog"></i></span>
                    {!! Form::text(
                        'keywords',
                        isset($article->keywords) ? $article->keywords : old('keywords'),
                        ['placeholder' => 'Введите ключевые слова']
                    ) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Описание (мета)</span><br />
                    <span class="sublabel">Описание</span><br />
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-cog"></i></span>
                    {!! Form::text(
                        'description',
                        isset($article->description) ? $article->description : old('description'),
                        ['placeholder' => 'Введите описание']
                    ) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Псевдоним</span><br />
                    <span class="sublabel">Алиас</span><br />
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-cog"></i></span>
                    {!! Form::text(
                        'alias',
                        isset($article->alias) ? $article->alias : old('alias'),
                        ['placeholder' => 'Введите псевдоним']
                    ) !!}
                </div>
            </li>
            <li class="textarea-field">
                <label for="message-contact-us">
                    <span class="label">Краткое превью</span>
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-pencil"></i></span>
                    {!! Form::textarea(
                        'excerpt',
                        isset($article->excerpt) ? $article->excerpt : old('excerpt'),
                        [
                            'id' => 'editor1',
                            'class' => 'form-control',
                            'placeholder' => 'Введите краткое превью'
                        ]
                    ) !!}
                </div>
                <div class="msg-error"></div>
            </li>
            <li class="textarea-field">
                <label for="message-contact-us">
                    <span class="label">Текст записи</span>
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-pencil"></i></span>
                    {!! Form::textarea(
                        'text',
                        isset($article->text) ? $article->text : old('text'),
                        [
                            'id' => 'editor2',
                            'class' => 'form-control',
                            'placeholder' => 'Введите текст записи'
                        ]
                    ) !!}
                </div>
                <div class="msg-error"></div>
            </li>
            @if (isset($article->img->full))
                <li class="textarea-field">
                    <label>
                        <span class="label">Текущее изображение</span>
                    </label>
                    {!! Html::image(asset(config('settings.theme')) . '/images/articles/' . $article->img->full, '', ['style' => 'width: 400px;']) !!}
                    {!! Form::hidden('old_image', $article->img->full) !!}
                </li>
            @endif
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Новое изображение</span><br />
                    <span class="sublabel">Прикрепите картинку</span><br />
                </label>
                <div class="input-prepend">
                    {!! Form::file('image', [
                        'class' => 'filestyle',
                        'data-buttonText' => 'Выберите изображение',
                        'data-buttonName' => 'btn btn-the-salmon-dance-3',
                        'data-placeholder' => 'Файла нет',                        
                    ]) !!}
                </div>
            </li>                                       
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Категория</span><br />
                    <span class="sublabel">Выберите категорию</span><br />
                </label>
                <div class="input-prepend">
                    {!! Form::select(
                        'category_id',
                        $categories,
                        isset($article->category_id) ? $article->category_id : ''
                    ) !!}
                </div>
            </li>
            @if (isset($article->id))
                <input type="hidden" name="_method" value="PUT">
            @endif
            <li class="submit-button">
                {!! Form::button(
                    'Сохранить', [
                        'class' => 'btn btn-hem-5 btn-large',
                        'type' => 'submit'
                ]) !!}
            </li>
        </ul>            
        {!! Form::close() !!}
        <script>
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
        </script>
    </div>
</div>