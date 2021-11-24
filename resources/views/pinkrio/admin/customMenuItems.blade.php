@foreach ( $items as $item )
    <tr>
        <td style="text-align: left;">
            {{ $paddingLeft }}
            {!! Html::link(route('admin.menus.edit', ['menu' => $item->id]), $item->title) !!}
        </td>
        <td style="text-align: left;">
            {{ $item->url() }}
        </td>
        <td>
            {!! Form::open([
                'url' => route('admin.menus.destroy', ['menu' => $item->id]),
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
    @if ( $item->hasChildren() )        
        @include( config('settings.theme') . '.admin.customMenuItems', [
            'items' => $item->children(),
            'paddingLeft' => $paddingLeft . '--',
        ] )        
    @endif
@endforeach
