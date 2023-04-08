@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.car.pages.details.title')}}
@endsection

@section('center_page')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-body profile-page p-0">
                    <div class="profile-header">
                        <div class="profile-info p-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <ul class="nav nav-pills d-flex align-items-end float-left profile-feed-items p-0 m-0">
                                        <li>
                                            <a class="nav-link active" data-toggle="pill" href="#profile-feed">
                                                {{__('labels.car.pages.details.car_tab')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-activity">
                                                {{__('labels.car.pages.details.owner_tab')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-friends">
                                                {{__('labels.car.pages.details.type_tab')}}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-4 profile-left">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('labels.car.pages.details.gallery')}}</h4>
                            </div>
                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                <p class="m-0">{{sizeof($car->pictures)}} {{__('labels.car.pages.details.gallery_num')}}</p>
                            </div>
                        </div>
                        <div class="iq-card-body p-0">
                            @if(sizeof($car->pictures) != 0)
                                <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
                                    @foreach($car->pictures as $pic)
                                        <li class="col-md-4 col-6 pl-1 pr-0 pb-1">
                                            <a href="javascript:void(0);">
                                                <img
                                                    src="{{strpos($pic->src,'http')===0?$pic->src:asset('assets/images/cars/'.$pic->src)}}"
                                                    alt="gallary-image"
                                                    class="img-fluid w-100"/>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col text-center h5">{{__('labels.car.pages.details.no_pics')}}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('labels.car.pages.details.places')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <ul class="pages-lists m-0 p-0">
                                @if(sizeof($car->displacements) != 0)
                                    @foreach($car->displacements as $trip)
                                        <li class="d-flex mb-4 align-items-center">
                                            <div class="user-img img-fluid">
                                                <img src="{{tripDefaultImage($trip, asset('assets/images/'))}}"
                                                     alt="story-img" class="rounded-circle avatar-40">
                                            </div>
                                            <div class="media-support-info ml-3">
                                                <h6>{{__('labels.displacement.attr.to')}} : {{$trip->to}}</h6>
                                                <h6>{{__('labels.displacement.attr.from')}} : {{$trip->from}}</h6>
                                                <p>{{__('labels.displacement.attr.distance')}} : {{$trip->distance}}</p>
                                                <p>{{__('labels.created_at')}}
                                                    : {{\Carbon\Carbon::parse($trip->created_at)->diffForHumans()}}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col text-center h5">
                                                {{__('labels.displacement.pages.index.empty_data')}}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 profile-center">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="profile-feed" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-body p-0">
                                    <div class="user-post-data p-3">
                                        <div class="d-flex flex-wrap">
                                            <div class="media-support-user-img mr-3">
                                                @if(sizeof($car->pictures) > 0)
                                                    <img class="rounded-circle img-fluid"
                                                         src="{{asset('assets/images/cars/'.$car->pictures[rand(0, sizeof($car->pictures)-1)]->src)}}"
                                                         alt="">
                                                @else
                                                    <img class="rounded-circle img-fluid"
                                                         src="{{asset('assets/images/no_image.jpg')}}"
                                                         alt="">
                                                @endif
                                            </div>
                                            <div class="media-support-info mt-2">
                                                <h5 class="mb-0">
                                                    <a class="">{{__('labels.car.attr.model')}}</a>
                                                </h5>
                                                <p class="mb-0 text-primary">{{$car->model}} </p>
                                            </div>
                                            <div class="iq-card-header-toolbar d-flex align-items-center">
                                                <div class="dropdown">
                                                    @if(auth()->user()->roles->pluck('name')[0]=='super_admin')
                                                        <div class="dropdown-menu dropdown-menu-right p-0">
                                                            @if(empty($car->deleted_at))
                                                                <a class="dropdown-item"
                                                                   href="{{route('car_delete', ['id'=>$car->id])}}"
                                                                   onclick="event.preventDefault();
                                                                        document.getElementById('delete-car').submit();">
                                                                    <i class="ri-delete-bin-line mr-2"></i>
                                                                    {{__('labels.actions.delete')}}
                                                                </a>
                                                                <form id="delete-car"
                                                                      action="{{ route('car_delete', ['id'=>$car->id]) }}"
                                                                      method="POST"
                                                                      class="d-none">
                                                                    @csrf
                                                                </form>
                                                            @else
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i class="ri-refresh-line mr-2"></i>
                                                                    {{__('labels.actions.restore')}}
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div class="mt-2">
                                            <h6>{{__('labels.car.attr.color')}}:</h6>
                                            <p>{{$car->color}}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h6>{{__('labels.car.attr.gray_card')}}:</h6>
                                            <p>{{$car->gray_card}}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h6>{{__('labels.car.attr.model')}}:</h6>
                                            <p>{{$car->model}}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h6>{{__('labels.car.attr.registration_number')}}:</h6>
                                            <p>{{$car->registration_number}}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h6>{{__('labels.created_at')}}:</h6>
                                            <p>{{date_format($car->created_at, 'M d, Y')}}</p>
                                        </div>
                                        @if(auth()->user()->roles->pluck('name')[0] == 'super_admin')
                                            <div class="mt-2">
                                                <h6>{{__('labels.user.pages.profile.actions')}}:</h6>
                                                <p>
                                                <form action="{{route('car_delete', ['lang'=>'en', 'id'=>'carId'])}}"
                                                      method="post" id="deleteCar" class="actions">
                                                    @csrf
                                                    <button class="iq-bg-danger form-control" type="submit"
                                                    > {{__('labels.actions.delete')}} </button>
                                                </form>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-activity" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.car.attr.owner')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="user-detail text-center">
                                        <div class="user-profile">
                                            <img width="100px" height="100px"
                                                 src="{{$car->user->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.$car->user->picture)}}"
                                                 alt="profile-img"
                                                 class="avatar-130 img-fluid">
                                        </div>
                                        <div class="profile-detail mt-3">
                                            <a href="{{route('user_show', ['id'=>$car->user->id, 'lang'=>app()->getLocale()])}}">
                                                <h3 class="d-inline-block">{{$car->user->last_name.' '.$car->user->first_name}}</h3>
                                            </a>
                                            <p class="d-inline-block pl-3"> -
                                                @if($car->user->roles->pluck('name')[0]=='super_admin')
                                                    {{__('labels.rules.super')}}
                                                @elseif($car->user->roles->pluck('name')[0]=='admin')
                                                    {{__('labels.rules.admin')}}
                                                @elseif($car->user->roles->pluck('name')[0]=='driver')
                                                    {{__('labels.rules.driver')}}
                                                @else
                                                    {{__('labels.rules.client')}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.user.pages.profile.about')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="mt-2">
                                        <h6>{{__('labels.join_at')}}:</h6>
                                        <p>{{date_format($car->user->created_at, 'M d, Y H:i')}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.city')}}</h6>
                                        <p>{{$car->user->city->country.', '.$car->user->city->city}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.email')}}:</h6>
                                        <p><a href="javascript:void(0);"> {{$car->user->email}}</a></p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.phone')}}:</h6>
                                        <p><a href="javascript:void(0);">{{$car->user->phone}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-friends" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.car.pages.details.type_tab')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="mt-2">
                                        <h6>{{__('labels.type.attr.label')}}:</h6>
                                        <p><a href="javascript:void(0);"> {{$car->type->label}}</a></p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.type.attr.amount')}}:</h6>
                                        <p><a href="javascript:void(0);">{{$car->type->amount}}</a></p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.created_at')}}:</h6>
                                        <p>{{date_format($car->type->created_at, 'M d, Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        (function ($) {
            let car = {{Js::from($car)}};
            let url = $('#deleteCar')[0].action;
            $('#deleteCar').attr('action', url.replace('carId', car.id));
        })(jQuery);
    </script>
@endsection
