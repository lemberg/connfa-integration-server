@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {{ Html::link(route('levels.create'), trans('Create level'), ['class' => 'btn btn-primary pull-right']) }}

        <div class="x_panel">
            <div class="x_title">
                <h2>{{ trans('Levels') }}</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title" style="width: 30%">{{ trans('Name') }}</th>
                                <th class="column-title" style="width: 30%">{{ trans('Order') }}</th>
                                <th class="column-title no-link last"><span class="nobr">{{ trans('Action') }}</span></th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php $i=0 ?>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->order }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('levels.show', ['id' => $item->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> {{ trans('View') }}</a>
                                    <a href="{{ route('levels.edit', ['id' => $item->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> {{ trans('Edit') }}</a>
                                    {!! Form::open(['url' => route('levels.destroy', ['id' => $item->id]), 'method' => 'POST', 'style' => 'vertical-align: middle; display: inline-block;']) !!}
                                        {{ method_field('DELETE') }}
                                        {{ Form::button("<i class='fa fa-trash-o'></i> ".trans('Delete'), ['type' => 'submit', 'class' => 'btn btn-danger btn-xs']) }}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pull-right">
                {!! $data->links() !!}
            </div>
        </div>
    </div>
@endsection
