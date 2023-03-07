@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.car.pages.index.title')}}
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
                        <h4 class="card-title">{{__('labels.car.pages.index.card_title')}}</h4>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="cars" class="table table-striped table-borderless mt-4" role="grid"
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
        $(document).ready(function() {
            $('#cars').DataTable({
                "responsive": true,
                "initComplete": function(settings, json) {
                    $('#cars').show();
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
                    "data": "owner",
                    "name": "owner",
                    "title": function () {
                        return '<span>{{__('labels.car.attr.owner')}}</span>';
                    },
                }, {
                    "data": "type",
                    "name": "type",
                    "title": function () {
                        return '<span>{{__('labels.car.attr.type')}}</span>';
                    },
                }, {
                    "data": "model",
                    "name": "model",
                    "title": function () {
                        return '<span>{{__('labels.car.attr.model')}}</span>';
                    },
                },  {
                    "data": "action",
                    "name": "action",
                    "title": "Actions",
                }],
                "language": {
                    "emptyTable":  function () {
                        return '<span>{{__('labels.user.pages.index.empty_data')}}</span>';
                    },
                },
                "ajax": "{{ route('car_index') }}"
            });
        });
    </script>
@endsection
