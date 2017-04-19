<a href="{{ route('dashboard', ['conference_alias' => $conference->alias]) }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-circle-right"></i> {{ trans('Go to the conference') }}</a>
<a href="{{ route("conferences.edit", ['id' => $conference->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
{!! Form::open(['url' => route('conferences.destroy', ['id' => $conference->id]), 'method' => 'POST', 'style' => 'vertical-align: middle; display: inline-block;']) !!}
    {{ method_field('DELETE') }}
    {{ Form::button("<i class='fa fa-trash-o'></i> ".trans('Delete'), ['class' => 'btn btn-danger btn-xs', 'onclick' => 'deleteItem(this)']) }}
{!! Form::close() !!}