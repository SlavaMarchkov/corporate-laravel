@if ($users)
<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Пользователи системы</h2>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Логин</th>
                        <th>Роль</th>                        
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="align-left">
                            {!! Html::link(route('admin.users.edit', ['user' => $user->id]), $user->name) !!}
                        </td>
                        <td class="align-left">{{ $user->email }}</td>
                        <td class="align-left">{{ $user->login }}</td>                        
                        <td class="align-left">{{ $user->roles->implode('name', ', ') }}</td>
                        <td>
                            {!! Form::open([
                                'url' => route('admin.users.destroy', ['user' => $user->id]),
                                'class' => 'form-horizontal',
                                'method' => 'post',
                            ]) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::button(
                                'Удалить', 
                                [
                                    'class' => 'btn btn-french-5', 
                                    'type' => 'submit'
                                ]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach                  
                </tbody>
            </table>
        </div>
        {!! Html::link(route('admin.users.create'), 'Создать нового пользователя', ['class' => 'btn btn-hem-5 btn-large']) !!}
        <div class="clear space"></div>
    </div>
</div>
@endif