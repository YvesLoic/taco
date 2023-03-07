@extends('layouts.app')

@section('title')
    {{config('app.name')}} - {{__('labels.login_page.title')}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset("assets/css/slick.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/slick-theme.css")}}">
@endsection

@section('content')

    {{--    Sign in Start--}}
    <section class="sign-in-page">
        <div class="container bg-white mt-5 p-0">
            <div class="row no-gutters">
                <div class="col-sm-6 align-self-center">
                    <div class="sign-in-from">
                        <h1 class="mb-0 dark-signin">{{__('labels.login_page.title')}}</h1>
                        <p>{{__('labels.login_page.first_message')}}</p>
                        <form class="mt-4" action="{{route('login', ['lang'=>\Illuminate\Support\Facades\App::getLocale()])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">{{__('labels.login_page.email_label')}}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror mb-0"
                                       id="email"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                       placeholder="{{__('labels.login_page.email_holder')}}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">{{__('labels.login_page.password_label')}}</label>
{{--                                <a href="#" class="float-right">{{__('labels.login_page.forgot')}}</a>--}}
                                <input type="password" class="form-control @error('password') is-invalid @enderror mb-0"
                                       id="password"
                                       name="password" required autocomplete="current-password"
                                       placeholder="{{__('labels.login_page.password_holder')}}">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-inline-block w-100">
                                <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="custom-control-input"
                                           {{ old('remember') ? 'checked' : '' }} id="remember" name="remember">
                                    <label class="custom-control-label"
                                           for="remember">{{__('labels.login_page.remember')}}</label>
                                </div>
                                <button type="submit"
                                        class="btn btn-primary float-right">{{__('labels.login_page.title')}}</button>
                            </div>
                            <div class="sign-info">

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="sign-in-detail text-white">
                        <a class="sign-in-logo mb-4" href="{{route(Route::currentRouteName())}}">
                            <img src="{{asset('assets/images/logo_taco.png')}}" class="img-fluid" alt="logo">
                        </a>
                        <div class="slick-slider11" data-autoplay="true" data-loop="true" data-nav="false"
                             data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1"
                             data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                            <div class="item">
                                <img src="{{asset("assets/images/taco_card.png")}}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">{{__('labels.login_page.slider_title1')}}</h4>
                                <p>{{__('labels.login_page.slider_content1')}}</p>
                            </div>
                            <div class="item">
                                <img src="{{asset("assets/images/taco_card1.png")}}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">{{__('labels.login_page.slider_title2')}}</h4>
                                <p>{{__('labels.login_page.slider_content2')}}</p>
                            </div>
                            <div class="item">
                                <img src="{{asset("assets/images/taco_card2.png")}}" class="img-fluid mb-4" alt="logo">
                                <h4 class="mb-1 text-white">{{__('labels.login_page.slider_title3')}}</h4>
                                <p>{{__('labels.login_page.slider_content3')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    Sign in End--}}
@endsection

@section('scripts')
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
@endsection
