@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.city.pages.create.title')}}
@endsection

@section('center_page')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{__('labels.city.pages.create.card_title')}}</h4>
                        @if (!empty($city) && !empty($city->deleted_at))
                            <span class="badge bg-warning float-end">
                                {{__('labels.actions.messages.delete_data')}}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="iq-card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="new-user-info">
                        {!! form($form) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
