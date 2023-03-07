@extends('layouts.app')

{{--@section('body_class', 'sidebar-main-active right-column-fixed header-top-bgcolor')--}}

@section('content')
    {{--    Sidebar--}}
    <div class="iq-sidebar">
        <div class="iq-sidebar-logo d-flex justify-content-between">
            <a href="{{route('home')}}">
                <div class="iq-light-logo">
                    <div class="iq-light-logo">
                        <img src="{{asset('assets/images/logo_light_alpha.png')}}" class="img-fluid" alt="">
                    </div>
                    <div class="iq-dark-logo">
                        <img src="{{asset('assets/images/logo_taco.png')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="iq-dark-logo">
                    <img src="{{asset('assets/images/logo_taco.png')}}" class="img-fluid" alt="">
                </div>
                {{--                <span>{{config('app.name')}}</span>--}}
            </a>
            <div class="iq-menu-bt-sidebar">
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="iq-menu-title">
                        <i class="ri-subtract-line"></i>
                        <span>{{__('labels.sidebar.home')}}</span>
                    </li>
                    <li class="{{request()->route()->named('home')?'active':''}}">
                        <a href="{{route('home')}}" class="iq-waves-effect">
                            <i class="ri-home-4-line"></i>
                            <span>{{__('labels.sidebar.dashboard')}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#users-side" class="iq-waves-effect collapsed" data-toggle="collapse"
                           aria-expanded="false">
                            <i class="ri-user-line"></i>
                            <span>{{__('labels.sidebar.user_menu_title')}}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="users-side" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{request()->route()->named('user_create')?'active':''}}">
                                <a href="{{route('user_create')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-user-add-line"></i>
                                    {{__('labels.sidebar.user_add')}}
                                </a>
                            </li>
                            <li class="{{request()->route()->named('user_index')?'active':''}}">
                                <a href="{{route('user_index')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-file-list-line"></i>
                                    {{__('labels.sidebar.user_list')}}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#cars-side" class="iq-waves-effect collapsed" data-toggle="collapse"
                           aria-expanded="false">
                            <i class="ri-car-line"></i>
                            <span>{{__('labels.sidebar.car_menu_title')}}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="cars-side" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{request()->route()->named('car_create')?'active':''}}">
                                <a href="{{route('car_create')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-add-line"></i>
                                    <span>{{__('labels.sidebar.car_add')}}</span>
                                </a>
                            </li>
                            <li class="{{request()->route()->named('car_index')?'active':''}}">
                                <a href="{{route('car_index')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-car-line"></i>
                                    <span>{{__('labels.sidebar.car_list')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#types-side" class="iq-waves-effect collapsed" data-toggle="collapse"
                           aria-expanded="false">
                            <i class="ri-tornado-line"></i>
                            <span>{{__('labels.sidebar.type_menu_title')}}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="types-side" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{request()->route()->named('type_create')?'active':''}}">
                                <a href="{{route('type_create')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-add-line"></i>
                                    <span>{{__('labels.sidebar.type_add')}}</span>
                                </a>
                            </li>
                            <li class="{{request()->route()->named('type_index')?'active':''}}">
                                <a href="{{route('type_index')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-tumblr-line"></i>
                                    <span>{{__('labels.sidebar.type_list')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#cities-side" class="iq-waves-effect collapsed" data-toggle="collapse"
                           aria-expanded="false">
                            <i class="ri-landscape-line"></i>
                            <span>{{__('labels.sidebar.city_menu_title')}}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="cities-side" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{request()->route()->named('city_create')?'active':''}}">
                                <a href="{{route('city_create')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-add-line"></i>
                                    <span>{{__('labels.sidebar.city_add')}}</span>
                                </a>
                            </li>
                            <li class="{{request()->route()->named('city_index')?'active':''}}">
                                <a href="{{route('city_index')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-coupon-line"></i>
                                    <span>{{__('labels.sidebar.city_list')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#trips-side" class="iq-waves-effect collapsed" data-toggle="collapse"
                           aria-expanded="false">
                            <i class="ri-tornado-line"></i>
                            <span>{{__('labels.sidebar.displacement_menu_title')}}</span>
                            <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                        </a>
                        <ul id="trips-side" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="{{request()->route()->named('displacement_create')?'active':''}}">
                                <a href="{{route('displacement_create')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-add-line"></i>
                                    <span>{{__('labels.sidebar.displacement_add')}}</span>
                                </a>
                            </li>
                            <li class="{{request()->route()->named('displacement_index')?'active':''}}">
                                <a href="{{route('displacement_index')}}" class="iq-waves-effect collapsed">
                                    <i class="ri-tumblr-line"></i>
                                    <span>{{__('labels.sidebar.displacement_list')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <div class="p-3"></div>
        </div>
    </div>
    {{--    End Sidebar--}}

    {{--    Top Navbar Start--}}
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <div class="iq-sidebar-logo">
                <div class="top-logo">
                    <a href="{{route('home', ['lang'=>\Illuminate\Support\Facades\App::getLocale()])}}" class="logo">
                        <div class="iq-light-logo">
                            <img src="{{asset('assets/images/logo_taco.png')}}" class="img-fluid" alt="">
                        </div>
                        <div class="iq-dark-logo">
                            <img src="{{asset('assets/images/logo_taco.png')}}" class="img-fluid" alt="">
                        </div>
                        <span>{{config('app.name')}}</span>
                    </a>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="navbar-left">
                    <div class="iq-search-bar d-none d-md-block">
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item">
                            @if(app()->getLocale()=="en")
                                <a class="search-toggle iq-waves-effect language-title"
                                   href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['lang'=>'en'])}}">
                                    <img src="{{asset('assets/images/en.png')}}" alt="img-flaf" class="img-fluid mr-1"
                                         style="height: 16px; width: 16px;"/> {{__('labels.navbar.en')}}
                                    <i class="ri-arrow-down-s-line"></i>
                                </a>
                                <div class="iq-sub-dropdown">
                                    <a class="iq-sub-card iq-waves-effect"
                                       href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['lang'=>'fr'])}}">
                                        <img src="{{asset('assets/images/fr.png')}}" alt="img-flaf"
                                             class="img-fluid mr-2"/>
                                        {{__('labels.navbar.fr')}}
                                    </a>
                                </div>
                            @else
                                <a class="search-toggle iq-waves-effect language-title"
                                   href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['lang'=>'fr'])}}">
                                    <img src="{{asset('assets/images/fr.png')}}" alt="img-flaf" class="img-fluid mr-1"
                                         style="height: 16px; width: 16px;"/> {{__('labels.navbar.fr')}}
                                    <i class="ri-arrow-down-s-line"></i>
                                </a>
                                <div class="iq-sub-dropdown">
                                    <a class="iq-sub-card iq-waves-effect"
                                       href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(), ['lang'=>'en'])}}">
                                        <img src="{{asset('assets/images/en.png')}}" alt="img-flaf"
                                             class="img-fluid mr-2"/>
                                        {{__('labels.navbar.en')}}
                                    </a>
                                </div>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a href="#" class="search-toggle iq-waves-effect">
                                {{--                                <div id="lottie-beil"></div>--}}
                                <i class="ri ri-notification-2-line"></i>
                                <span
                                    class="{{Session::has('alerts')?'bg-danger dots':''}}" id="alert_dot"></span>
                            </a>
                            <div class="iq-sub-dropdown">
                                <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 " id="alerts_body">
                                        <div class="bg-primary p-3">
                                            <h5 class="mb-0 text-white">
                                                All Notifications
                                                <small class="badge badge-light float-right pt-1" id="alert_nb">
                                                </small>
                                            </h5>
                                        </div>
                                        {{--                                        @include('partials.alert', $alerts = Session::has('alerts')?Session::get('alerts'):[])--}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-list">
                    <li>
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                            <img width="100" height="100"
                                 src="{{Auth::user()->picture==null?asset('assets/images/guest.png'):asset('assets/images/users/'.Auth::user()->picture)}}"
                                 class="img-fluid rounded mr-3" alt="user">
                            <div class="caption">
                                <h6 class="mb-0 line-height text-white">{{Auth::user()->last_name.' '.Auth::user()->first_name}}</h6>
                                <span class="font-size-12 text-white">
                                    @if(auth()->user()->roles->pluck('name')[0]=='super_admin')
                                        {{__('labels.rules.super')}}
                                    @else
                                        {{__('labels.rules.admin')}}
                                    @endif
                                </span>
                            </div>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white line-height">{{__('labels.navbar.hello').' '. Auth::user()->last_name.' '.Auth::user()->first_name}}</h5>
                                        <span class="text-white font-size-12">
                                            @if(auth()->user()->roles->pluck('name')[0]=='super_admin')
                                                {{__('labels.rules.super')}}
                                            @else
                                                {{__('labels.rules.admin')}}
                                            @endif
                                        </span>
                                    </div>
{{--                                    <a href="{{route('user_profile')}}" class="iq-sub-card iq-bg-primary-hover">--}}
{{--                                        <div class="media align-items-center">--}}
{{--                                            <div class="rounded iq-card-icon iq-bg-primary">--}}
{{--                                                <i class="ri-file-user-line"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="media-body ml-3">--}}
{{--                                                <h6 class="mb-0 ">{{__('labels.navbar.profile.show')}}</h6>--}}
{{--                                                <p class="mb-0 font-size-12">{{__('labels.navbar.profile.show_details')}}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
                                    <a href="{{route('user_edit_profile')}}" class="iq-sub-card iq-bg-primary-hover">
                                        <div class="media align-items-center">
                                            <div class="rounded iq-card-icon iq-bg-primary">
                                                <i class="ri-profile-line"></i>
                                            </div>
                                            <div class="media-body ml-3">
                                                <h6 class="mb-0 ">{{__('labels.navbar.profile.edit')}}</h6>
                                                <p class="mb-0 font-size-12">{{__('labels.navbar.profile.edit_details')}}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <a class="btn btn-primary dark-btn-primary" href="{{route('logout')}}"
                                           role="button" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{__('labels.navbar.profile.logout')}}
                                            <i class="ri-login-box-line ml-2"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
    {{--    Top Navbar End--}}

    {{--    Page Content Start--}}
    <div id="content-page" class="content-page">
        <div class="container-fluid">
{{--            @include('partials.flash')--}}
            @yield('center_page')
        </div>
    </div>
    {{--    Page Content End--}}

    {{--    Footer Start--}}
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="{{route('home')}}">{{__('labels.privacy_policy')}}</a>
                        </li>
                        <li class="list-inline-item"><a href="{{route('home')}}">{{__('labels.terms_service')}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    Copyright {{date('Y')}} <a
                        href="{{route('home')}}">{{config('app.name')}}</a> {{__('labels.footer')}}
                </div>
            </div>
        </div>
    </footer>
    {{--    Footer End--}}
@endsection

@section('scripts')
    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        (function ($) {

            // const appKey = process.env.MIX_PUSHER_APP_KEY;
            const appKey = '{{env('MIX_PUSHER_APP_KEY')}}';
            const userId = {{auth()->user()->id}};
            let socket = new WebSocket(`ws:${window.location.hostname}:6001/create-alert?appKey=${appKey}&user_id=${userId}`);
            let alerts = [];
            socket.onopen = function () {
                console.log('open');
                // socket.send(JSON.stringify({
                //     alert: {
                //         'trip_id': 1,
                //         'content': 'Content message for this displacement!',
                //         'type': 'danger',
                //     }
                // }));
            }

            socket.onmessage = function (sms) {
                const res = JSON.parse(sms.data);
                if (!res.user) {
                    console.log('message', res);
                    alerts.push(res);
                    $('#alert_dot').attr('class', 'bg-danger dots');
                    $('#alert_nb').text(alerts.length);
                    $('#alerts_body').append(
                        $('<a>', {
                                class: 'iq-sub-card',
                                href: "{{route('displacement_show', ['id'=>-1, 'lang'=>app()->getLocale()])}}".replace('-1', `${res.trip_id}`)
                            }
                        ).append(
                            $('<div>', {
                                    class: 'media align-items-center'
                                }
                            ).append(
                                $('<div>', {class: ''})
                                    .append(
                                        $('<img>', {
                                            class: 'avatar-40 rounded',
                                            src: res.client.picture === null || res.client.picture === undefined ?
                                                '{{asset('assets/images/guest.png')}}' :
                                                '{{asset('assets/images/users/')}}'.concat(res.client.picture),
                                            alt: res.first_name
                                        })
                                    )
                            ).append(
                                $('<div>', {class: 'media-body ml-3'}
                                ).append(
                                    $('<h6>', {class: 'mb-0'}).text(res.client.first_name + ' ' + res.client.last_name)
                                ).append(
                                    $('<small>', {class: 'float-right fint-size-12'}).text(res.created_at)
                                ).append(
                                    $('<div>', {class: 'mb-0'}).text(res.content)
                                ).append(
                                    $('<div>', {class: 'mb-0'}).text(res.type)
                                )
                            )
                        )
                    );
                }
            }
        })(jQuery);
    </script>
@endsection
