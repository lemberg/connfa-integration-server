@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {{ Html::link(route('levels.create'), 'Create level', ['class' => 'btn btn-primary pull-right']) }}

        <div class="x_panel">
            <div class="x_title">
                <h2>Levels</h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title"># </th>
                            <th class="column-title" style="width: 30%">Name </th>
                            <th class="column-title" style="width: 30%">Order </th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($data as $level)
                            <tr>
                                <td>#</td>
                                <td>
                                    {{ $level->name }}
                                </td>
                                <td>
                                    {{ $level->order }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('levels.show', ['id' => $level->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                    <a href="{{ route('levels.edit', ['id' => $level->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    {!! Form::open(['url' => route('levels.destroy', ['id' => $level->id]), 'method' => 'post', 'style' => 'vertical-align: middle; display: inline-block;']) !!}
                                        {{ method_field('delete') }}
                                        {{ Form::button("<i class='fa fa-trash-o'></i> Delete", ['type' => 'submit', 'class' => 'btn btn-danger btn-xs']) }}
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
