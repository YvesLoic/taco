@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.user.pages.profile.title')}}
@endsection

@section('center_page')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-body profile-page p-0">
                    <div class="profile-header">
                        <div class="cover-container">
                            <img src="{{asset('assets/images/profile-bg.jpg')}}" alt="profile-bg"
                                 class="rounded img-fluid">
                        </div>
                        <div class="profile-info p-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="user-detail pl-5">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <div class="profile-img pr-4">
                                                <img width="100px" height="100px"
                                                     src="{{$user->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.$user->picture)}}"
                                                     alt="profile-img"
                                                     class="avatar-130 img-fluid"/>
                                            </div>
                                            <div class="profile-detail d-flex align-items-center">
                                                <h3>{{$user->last_name.' '.$user->first_name}}</h3>
                                                <p class="m-0 pl-3"> -
                                                    @include('pages.users._rule', $user)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <ul class="nav nav-pills d-flex align-items-end float-right profile-feed-items p-0 m-0">
                                        <li>
                                            <a class="nav-link active" data-toggle="pill" href="#profile-feed">
                                                {{__('labels.user.pages.profile.trip')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-activity">
                                                {{__('labels.user.pages.profile.cars')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-friends">
                                                {{__('labels.user.pages.profile.notices')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-toggle="pill" href="#profile-profile">
                                                {{__('labels.user.pages.profile.title')}}
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
                <div class="col-lg-8 profile-center">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="profile-feed" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.user.pages.profile.trip_list')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    @if(sizeof($user->displacements) != 0)
                                        <div class="row">
                                            @foreach($user->displacements as $trip)
                                                <div class="col-lg-4">
                                                    <div class="card text-white {{setClass($trip)}} iq-mb-3">
                                                        <div class="card-body">
                                                            <h6 class="card-title text-white">
                                                                {{__('labels.displacement.attr.to')}} : {{$trip->to}}
                                                                <br>
                                                                {{__('labels.displacement.attr.from')}}
                                                                : {{$trip->from}}
                                                            </h6>
                                                            <blockquote class="blockquote mb-0">
                                                                <p class="font-size-12 h6">
                                                                    {{__('labels.displacement.attr.distance')}}
                                                                    : {{$trip->distance}}
                                                                    <br>
                                                                    {{__('labels.displacement.attr.price')}}
                                                                    : {{$trip->price}}
                                                                    <br>
                                                                    {{__('labels.displacement.attr.status')}}
                                                                    : {{$trip->status}}
                                                                </p>
                                                                <footer
                                                                    class="blockquote-footer text-white font-size-12 mt-2">
                                                                    <a href="{{route('displacement_show', ['lang'=>app()->getLocale(), 'id'=>$trip->id])}}"
                                                                       class="text-white">
                                                                        {{__('labels.user.pages.profile.more')}}
                                                                    </a>
                                                                </footer>
                                                            </blockquote>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col text-center h4">
                                                    {{__('labels.car.pages.index.empty_data')}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
                                    <ul class="suggestions-lists m-0 p-0">
                                        @if(sizeof($user->cars) != 0)
                                            @foreach($user->cars as $car)
                                                <li class="d-flex mb-4 align-items-center">
                                                    <div class="user-img img-fluid">
                                                        <img
                                                            src="{{$user->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.$user->picture)}}"
                                                            alt="story-img"
                                                            class="rounded-circle avatar-40">
                                                    </div>
                                                    <div class="media-support-info ml-3">
                                                        <h5>{{__('labels.car.attr.registration_number')}}
                                                            : {{$car->registration_number}}</h5>
                                                        <h5>{{__('labels.car.attr.model')}} : {{$car->model}}</h5>
                                                        <h6>{{$user->last_name.' '.$user->first_name}}</h6>
                                                        <p class="mb-0">{{$user->roles->pluck('name')[0]}}</p>
                                                    </div>
                                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                                        <div class="dropdown">
                                                            <span class="dropdown-toggle text-primary"
                                                                  id="dropdownMenuButton41"
                                                                  data-toggle="dropdown">
                                                                <i class="ri-more-2-line"></i>
                                                            </span>
                                                            <div class="dropdown-menu dropdown-menu-right p-0">
                                                                <a class="dropdown-item"
                                                                   href="{{route('car_show', ['lang'=>app()->getLocale(), 'id'=>$car->id])}}">
                                                                    <i class="ri-car-line mr-2"></i>{{__('labels.car.pages.details.title')}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col text-center h4">
                                                        {{__('labels.car.pages.index.empty_data')}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-friends" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.user.pages.profile.rank')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col text-center h4">
                                                @if($rank == 0)
                                                    0 .
                                                @else
                                                    {{$rank}} 0
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-profile" role="tabpanel">
                            <div class="iq-card">
                                <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                        <h4 class="card-title">{{__('labels.navbar.profile.show')}}</h4>
                                    </div>
                                </div>
                                <div class="iq-card-body">
                                    <div class="user-detail text-center">
                                        <div class="user-profile">
                                            <img width="100px" height="100px"
                                                 src="{{$user->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.$user->picture)}}"
                                                 alt="profile-img"
                                                 class="avatar-130 img-fluid">
                                        </div>
                                        <div class="profile-detail mt-3">
                                            <h3 class="d-inline-block">{{$user->last_name.' '.$user->first_name}}</h3>
                                            <p class="d-inline-block pl-3"> -
                                                @include('pages.users._rule', $user)
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
                                        <p>{{date_format($user->created_at, 'Y-m-d H:i')}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.city')}}:</h6>
                                        <p>{{$user->city->country->name.', '.$user->city->name}}</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.email')}}:</h6>
                                        <p><a href="javascript:void(0);"> {{$user->email}}</a></p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.attr.phone')}}:</h6>
                                        <p><a href="javascript:void(0);">{{$user->phone}}</a></p>
                                    </div>
                                    <div class="mt-2">
                                        <h6>{{__('labels.user.pages.profile.points')}}:</h6>
                                        <p>{{$user->points}}</p>
                                    </div>
                                    @if(!is_null($user->deleted_at))
                                        <div class="mt-2">
                                            <h6>{{__('labels.deleted_at')}}:</h6>
                                            <p>{{date_format($user->deleted_at, 'Y-mm-d H:i')}}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 profile-right">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">{{__('labels.user.pages.profile.about')}}</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="about-info m-0 p-0">
                                <div class="row">
                                    <div class="col-5">{{__('labels.user.attr.email')}}:</div>
                                    <div class="col-7"><a href="javascript:void(0);"> {{$user->email}} </a></div>
                                    <div class="col-5">{{__('labels.user.attr.phone')}}:</div>
                                    <div class="col-7"><a href="javascript:void(0);">{{$user->phone}}</a></div>
                                    <div class="col-5">{{__('labels.user.attr.city')}}:</div>
                                    <div class="col-7">{{$user->city->name}}</div>
                                </div>
                                @if(auth()->user()->roles->pluck('name')[0] == 'super_admin' && auth()->user()->id!=$user->id)
                                    <div class="row">
                                        @if(is_null($user->deleted_at))
                                            <div class="col-5">{{__('labels.user.pages.profile.actions')}}:</div>
                                            <div class="col-7">
                                                <form action="{{route('user_delete', ['lang'=>'en', 'id'=>'userId'])}}"
                                                      method="post" id="deleteU" class="actions">
                                                    @csrf
                                                    <button class="iq-bg-danger form-control" type="submit"
                                                    > {{__('labels.actions.delete')}} </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="col-5">{{__('labels.user.pages.profile.actions')}}:</div>
                                            <div class="col-7">
                                                <form action="{{route('user_restore', ['lang'=>'en', 'id'=>'userId'])}}"
                                                      method="post" id="restoreU" class="actions">
                                                    @csrf
                                                    <button class="iq-bg-success form-control" type="submit"
                                                    > {{__('labels.actions.restore')}} </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endif
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
            const user = {{Js::from($user)}};
            let url = $('.actions')[0].action;
            $('#deleteU').attr('action', url.replace('userId', user.id));
            $('#restoreU').attr('action', url.replace('userId', user.id));
        })(jQuery);
    </script>
@endsection
