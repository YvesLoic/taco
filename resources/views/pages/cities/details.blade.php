@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.city.pages.details.title')}}
@endsection

@section('center_page')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{__('labels.city.pages.details.card_title')}}</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab-fill" data-toggle="pill"
                               href="#pills-home-fill" role="tab" aria-controls="pills-home"
                               aria-selected="true">{{__('labels.sidebar.home')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab-fill" data-toggle="pill"
                               href="#pills-profile-fill" role="tab" aria-controls="pills-profile"
                               aria-selected="false">{{__('labels.city.pages.details.car_tab')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent-1">
                        <div class="tab-pane fade show active" id="pills-home-fill" role="tabpanel"
                             aria-labelledby="pills-home-tab-fill">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.city.pages.details.title')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="mt-2">
                                        <h6>{{__('labels.city.attr.country')}}:</h6>
                                        <p>{{$city->country}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.city.attr.city')}}:</h6>
                                        <p>{{$city->city}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.created_at')}}:</h6>
                                        <p>{{date_format($city->created_at, 'M d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile-fill" role="tabpanel"
                             aria-labelledby="pills-profile-tab-fill">
                            @if(sizeof($city->users) != 0)
                                @foreach($city->users as $user)
                                    <div class="col-lg-6">
                                        <div class="card iq-mb-3">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    @if(!empty($user->picture))
                                                        <img
                                                            src="{{asset('assets/images/users/'.$user->picture)}}"
                                                            class="card-img" alt="{{$user->first_name}}">
                                                    @else
                                                        <img src="{{asset('assets/images/guest.png')}}"
                                                             class="card-img"
                                                             alt="#">
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h4 class="card-title">{{__('labels.user.attr.first_name')}}
                                                            : {{$user->first_name}}</h4>
                                                        <p class="card-text">{{__('labels.user.attr.last_name')}}
                                                            : {{$user->last_name}}</p>
                                                        <p class="card-text">
                                                            <small class="text-muted">{{__('labels.created_at')}}
                                                                : {{date_format($user->created_at, 'M d, Y')}}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col text-center h5">{{__('labels.car.pages.details.no_pics')}}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
