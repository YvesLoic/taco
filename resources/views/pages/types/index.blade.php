@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.type.pages.index.title')}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('center_page')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{__('labels.type.pages.index.card_title')}}</h4>
                    </div>
                    @include('partials.flash')
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="types" class="table table-striped table-borderless mt-4" role="grid"
                               aria-describedby="user-list-page-info">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#types').DataTable({
                "responsive": true,
                "initComplete": function (settings, json) {
                    $('#types').show();
                },
                "serverSide": true,
                "select": true,
                "dataSrc": "tableData",
                "bDestroy": true,
                "columns": [{
                    "data": "id",
                    "name": "id",
                    "title": "Id",
                }, {
                    "data": "amount",
                    "name": "amount",
                    "title": function () {
                        return '<span>{{__('labels.type.attr.amount')}}</span>';
                    },
                }, {
                    "data": "label",
                    "name": "label",
                    "title": function () {
                        return '<span>{{__('labels.type.attr.label')}}</span>';
                    },
                }, {
                    "data": "effective",
                    "name": "effective",
                    "title": function () {
                        return '<span>{{__('labels.type.form.type_car')}}</span>';
                    },
                }, {
                    "data": "status",
                    "name": "status",
                    "title": function () {
                        return '<span>{{__('labels.status')}}</span>';
                    },
                }, {
                    "data": "action",
                    "name": "action",
                    "title": "Actions",
                }],
                "language": {
                    "emptyTable": function () {
                        return '<span>{{__('labels.user.pages.index.empty_data')}}</span>';
                    },
                },
                "ajax": "{{ route('type_index') }}"
            });
        });
    </script>
@endsection
