<a href="{{ route("{$viewFolder}.show", ['id' => $item->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> {{ trans('View') }}</a>
<a href="{{ route("{$viewFolder}.edit", ['id' => $item->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
{!! Form::open(['url' => route("{$viewFolder}.destroy", ['id' => $item->id]), 'method' => 'POST', 'style' => 'vertical-align: middle; display: inline-block;']) !!}
    {{ method_field('DELETE') }}
    {{ Form::button("<i class='fa fa-trash-o'></i> ".trans('Delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs']) }}
{!! Form::close() !!}