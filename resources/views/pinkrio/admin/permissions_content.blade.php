<div id="content-page" class="content group">
    <div class="hentry group">
        <h2>Привилегии пользователей</h2>
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>                            
                            <th>Привилегии</th>
                            @if (!$roles->isEmpty())
                                @foreach ($roles as $role)
                                    <th>{{ $role->name }}</th>
                                @endforeach
                            @endif                            
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$permissions->isEmpty())
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                @foreach ($roles as $role)
                                    <td>
                                        @if ($role->hasPermission($permission->name))
                                            <input type="checkbox" name="{{ $role->id }}[]" value="{{ $permission->id }}" checked>
                                        @else
                                            <input type="checkbox" name="{{ $role->id }}[]" value="{{ $permission->id }}">                                     
                                        @endif
                                    </td>
                                @endforeach
                            </tr>                            
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <input type="submit" class="btn btn-hem-5 btn-large" value="Обновить привилегии">
        </form>
    </div>
</div>