@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-left">
                {!! Breadcrumbs::render('breadcrumbs', ['label'=> trans('BOF Events'), 'route' => 'bofs.index', 'params' => ['conference_alias' => $conference->alias]]) !!}
            </div>
            {{ Html::link(route('bofs.create', ['conference_alias' => $conference->alias]), trans('Create BOF event'), ['class' => 'btn btn-primary pull-right']) }}
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{ trans('BOF events') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="users-table">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">id</th>
                                <th class="column-title">{{ trans('Name') }}</th>
                                <th class="column-title">{{ trans('Start at') }}</th>
                                <th class="column-title">{{ trans('End at') }}</th>
                                <th class="column-title">{{ trans('Order') }}</th>
                                <th class="column-title no-link last"><span class="nobr">{{ trans('Action') }}</span></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#users-table').DataTable({
            stateSave: true,
            serverSide: true,
            ajax: '{!! route('bofs.data', ['conference_alias' => $conference->alias]) !!}',
            columns: [
                {data: 'id', name: 'id', width: '20px'},
                {data: 'name', name: 'name'},
                {data: 'start_at', name: 'start_at'},
                {data: 'end_at', name: 'end_at'},
                {data: 'order', name: 'order', 'searchable': false},
                {data: 'actions', name: 'actions', targets: 'no-sort', 'searchable': false, orderable: false, className: 'text-right', width: '214px'}
            ]
        });
    });
</script>
@endpush



