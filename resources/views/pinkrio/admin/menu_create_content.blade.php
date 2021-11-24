<div id="content-home" class="content group">
    <div class="hentry group">
        {!! Form::open(
            [
                'url' => (isset($menu->id) 
                            ? route('admin.menus.update', ['menu' => $menu->id]) 
                            : route('admin.menus.store')), 
                'class' => 'contact-form', 
                'method' => 'POST',                
            ]
        ) !!}        
        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Заголовок</span><br />
                    <span class="sublabel">Заголовок пункта меню</span><br />
                </label>
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-cog"></i></span>
                    {!! Form::text(
                        'title',
                        isset($menu->title) ? $menu->title : old('title'),
                        ['placeholder' => 'Введите заголовок пункта меню']
                    ) !!}
                </div>
            </li>            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Родительский пункт меню</span><br />
                    <span class="sublabel">Родитель</span><br />
                </label>
                <div class="input-prepend">                    
                    {!! Form::select(
                        'parent_id',
                        $menus,
                        isset($menu->parent_id) ? $menu->parent_id : NULL
                    ) !!}
                </div>
            </li>        
        </ul>
        <h2>Тип меню:</h2>
        <div id="accordion">
            <h3>
                {!! Form::radio(
                    'type',
                    'custom_link',                   
                    ((isset($type) && $type == 'custom_link') || (!isset($menu->id)))
                        ? TRUE
                        : FALSE,
                    ['class' => 'radioMenu'],                    
                ) !!}
                <span class="label">Пользовательская ссылка</span>
            </h3>
            <ul>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Путь для ссылки</span><br />
                        <span class="sublabel">Путь для ссылки, напр. clients</span><br />
                    </label>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-link"></i></span>
                        {!! Form::text(
                            'custom_link',
                            (isset($menu->path) && $type == 'custom_link')
                                ? $menu->path
                                : old('custom_link'),
                            ['placeholder' => 'Введите путь для ссылки']
                        ) !!}
                    </div>
                </li>
                <div style="clear: both;"></div>
            </ul>
            
            <h3>
                {!! Form::radio(
                    'type',
                    'blog_link',
                    (isset($type) && $type == 'blog_link')
                        ? TRUE
                        : FALSE,
                    ['class' => 'radioMenu']
                ) !!}
                <span class="label">Раздел Блог</span>
            </h3>
            <ul>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ссылка на категорию блога</span><br />
                        <span class="sublabel">Ссылка на категорию блога</span><br />
                    </label>
                    <div class="input-prepend">
                        @if ($categories)
                            {!! Form::select(
                                'category_alias',
                                $categories,
                                (isset($option) && $option)
                                    ? $option
                                    : FALSE                                
                            ) !!}
                        @endif           
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ссылка на запись блога</span><br />
                        <span class="sublabel">Ссылка на запись блога</span><br />
                    </label>
                    <div class="input-prepend">
                        @if ($articles)
                            {!! Form::select(
                                'article_alias',
                                $articles,
                                (isset($option) && $option)
                                    ? $option
                                    : FALSE,
                                ['placeholder' => 'Не используется']
                            ) !!}
                        @endif           
                    </div>
                </li>
                <div style="clear: both;"></div>	                                     
            </ul>

            <h3>
                {!! Form::radio(
                    'type',
                    'portfolio_link',
                    (isset($type) && $type == 'portfolio_link')
                        ? TRUE
                        : FALSE,
                    ['class' => 'radioMenu']
                ) !!}
                <span class="label">Раздел Портфолио</span>
            </h3>
            <ul>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ссылка на проект портфолио</span><br />
                        <span class="sublabel">Ссылка на проект портфолио</span><br />
                    </label>
                    <div class="input-prepend">
                        @if ($portfolios)
                            {!! Form::select(
                                'portfolio_alias',
                                $portfolios,
                                (isset($option) && $option)
                                    ? $option
                                    : FALSE,
                                ['placeholder' => 'Не используется']
                            ) !!}
                        @endif           
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Раздел Портфолио</span><br />
                        <span class="sublabel">Раздел Портфолио</span><br />
                    </label>
                    <div class="input-prepend">
                        @if ($filters)
                            {!! Form::select(
                                'filter_alias',
                                $filters,
                                (isset($option) && $option)
                                    ? $option
                                    : FALSE,
                                ['placeholder' => 'Не используется']
                            ) !!}
                        @endif           
                    </div>
                </li>
                <div style="clear: both;"></div>
            </ul>            
        </div>
        <br>
        @if (isset($menu->id))
            <input type="hidden" name="_method" value="PUT">
        @endif
        <ul>
            <li class="submit-button">
                {!! Form::button(
                    'Сохранить', [
                        'class' => 'btn btn-hem-5 btn-large',
                        'type' => 'submit'
                ]) !!}
            </li>
        </ul>            
        {!! Form::close() !!}
    </div>
</div>
<script>
    jQuery(function ($) {

        $('#accordion').accordion({
            active: active,
            activate: function (evt, obj) {
                obj.newPanel.prev().find('input[type=radio]').attr('checked', true);
            },            
        });

        var active = 0; // активный пункт радио-кнопки
        $('#accordion input[type=radio]').each(function (index, elem) {
            if ($(this).prop('checked')) {
                active = index;
            }
        });

        $('#accordion').accordion('option', 'active', active);
    });
</script>