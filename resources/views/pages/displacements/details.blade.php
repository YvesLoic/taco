@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.displacement.pages.details.title')}}
@endsection

@section('styles')
@endsection

@section('center_page')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{__('labels.displacement.pages.details.title')}}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <p>{{__('labels.displacement.pages.details.card_title')}}</p>
                        <iframe class="w-100"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902543.2003194243!2d-118.04220880485131!3d36.56083290513502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80be29b9f4abb783%3A0x4757dc6be1305318!2sInyo%20National%20Forest!5e0!3m2!1sen!2sin!4v1576668158879!5m2!1sen!2sin"
                                height="500" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{__('labels.displacement.pages.details.client_tab')}}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <p>{{__('labels.displacement.pages.details.client_sub')}}</p>

                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.first_name')}}:
                                <a href="javascript:void(0);"> {{$trip->client->first_name}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.last_name')}}:
                                <a href="javascript:void(0);"> {{$trip->client->last_name}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.email')}}:
                                <a href="javascript:void(0);"> {{$trip->client->email}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.phone')}}:
                                <a href="javascript:void(0);">{{$trip->client->phone}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.phone')}}:
                                <a href="javascript:void(0);">{{$trip->client->phone}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{__('labels.displacement.pages.details.trip_tab')}}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <p>{{__('labels.displacement.pages.details.trip_sub')}}</p>

                        <div class="mt-2">
                            <div class="h6">{{__('labels.displacement.attr.to')}}:
                                <a href="javascript:void(0);"> {{$trip->to}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.displacement.attr.from')}}:
                                <a href="javascript:void(0);"> {{$trip->from}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.displacement.attr.distance')}}:
                                <a href="javascript:void(0);"> {{$trip->distance}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.displacement.attr.price')}}:
                                <a href="javascript:void(0);">{{$trip->price}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.displacement.attr.status')}}:
                                @include('pages.displacements._status', $trip)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">{{__('labels.displacement.pages.details.driver_tab')}}</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <p>{{__('labels.displacement.pages.details.driver_sub')}}</p>

                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.first_name')}}:
                                <a href="javascript:void(0);"> {{$trip->car->user->first_name}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.last_name')}}:
                                <a href="javascript:void(0);"> {{$trip->car->user->last_name}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.email')}}:
                                <a href="javascript:void(0);"> {{$trip->car->user->email}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.phone')}}:
                                <a href="javascript:void(0);">{{$trip->car->user->phone}}</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="h6">{{__('labels.user.attr.credit')}}:
                                <a href="javascript:void(0);">{{$trip->car->user->points}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
