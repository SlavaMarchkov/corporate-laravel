<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Фронт-энд меню сайта</h2>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>                            
                        <th>Название пункта меню</th>
                        <th>Ссылка</th>
                        <th>Удалить</th>
                    </tr>
                </thead>
                <tbody>
                @if ($menu)
                    @include(config('settings.theme') . '.admin.customMenuItems', [
                        'items' => $menu->roots(),
                        'paddingLeft' => '' 
                    ])
                @endif
                </tbody>
            </table>
        </div>
        {!! Html::link(route('admin.menus.create'), 'Добавить пункт меню', [
            'class' => 'btn btn-hem-5 btn-large'
        ]) !!}
    </div>
</div>