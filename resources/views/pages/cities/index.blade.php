@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.city.pages.index.title')}}
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
                        <h4 class="card-title">{{__('labels.city.pages.index.card_title')}}</h4>
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
                        <table id="cities" class="table table-striped table-borderless mt-4" role="grid"
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
            $('#cities').DataTable({
                "responsive": true,
                "initComplete": function (settings, json) {
                    $('#cities').show();
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
                    "data": "country",
                    "name": "country",
                    "title": function () {
                        return '<span>{{__('labels.city.attr.country')}}</span>';
                    },
                }, {
                    "data": "name",
                    "name": "name",
                    "title": function () {
                        return '<span>{{__('labels.city.attr.city')}}</span>';
                    },
                }, {
                    "data": "effective",
                    "name": "effective",
                    "title": function () {
                        return '<span>{{__('labels.city.form.effective')}}</span>';
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
                "ajax": "{{ route('city_index') }}"
            });
        });
    </script>
@endsection
