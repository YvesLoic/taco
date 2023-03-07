@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.user.pages.index.title')}}
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
                        <h4 class="card-title">{{__('labels.user.pages.index.card_title')}}</h4>
                    </div>
                    @include('partials.flash')
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="users" class="table table-striped table-borderless mt-4" role="grid"
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
            $('#users').DataTable({
                "responsive": true,
                "initComplete": function (settings, json) {
                    $('#users').show();
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
                    "data": "picture",
                    "name": "picture",
                    "title": function () {
                        return '<span>{{__('labels.user.attr.picture')}}</span>';
                    },
                }, {
                    "data": "first_name",
                    "name": "first_name",
                    "title": function () {
                        return '<span>{{__('labels.user.attr.first_name')}}</span>';
                    },
                }, {
                    "data": "last_name",
                    "name": "last_name",
                    "title": function () {
                        return '<span>{{__('labels.user.attr.last_name')}}</span>';
                    },
                }, {
                    "data": "phone",
                    "name": "phone",
                    "title": function () {
                        return '<span>{{__('labels.user.attr.phone')}}</span>';
                    },
                }, {
                    "data": "email",
                    "name": "email",
                    "title": function () {
                        return '<span>{{__('labels.user.attr.email')}}</span>';
                    },
                }, {
                    "data": "rule",
                    "name": "rule",
                    "title": function () {
                        return '<span>{{__('labels.user.attr.rule')}}</span>';
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
                "ajax": "{{ route('user_index') }}"
            });
        });
    </script>
@endsection
