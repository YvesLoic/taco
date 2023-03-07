@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.user.pages.edit.title')}}
@endsection

@section('center_page')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            <li class="col-md-3 p-0">
                                <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                    {{__('labels.user.pages.profile.personal_nav')}}
                                </a>
                            </li>
                            <li class="col-md-3 p-0">
                                <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                    {{__('labels.user.pages.profile.change_nav')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">{{__('labels.user.pages.profile.personal_nav')}}</h4>
                                </div>
                            </div>
                            @include('partials.flash')
                            <div class="iq-card-body">
                                {!! form($form) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">{{__('labels.user.pages.profile.change_nav')}}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form method="POST"
                                      action="{{route('user_change_pass', ['lang'=>app()->getLocale()])}}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="email_c">{{__('labels.login_page.email_label')}}:</label>
                                        <input type="email" name="email_c"
                                               value="{{ Auth::user()->email ?? old('email') }}"
                                               class="form-control @error('email') is-invalid @enderror" id="email_c"
                                               required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="current">{{__('labels.user.attr.current')}}:</label>
                                        <input type="password" name="current"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="current" required autocomplete="new-password">

                                        @error('current')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">{{__('labels.user.attr.new_pass')}}:</label>
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">{{__('labels.user.attr.c_pass')}}:</label>
                                        <input type="password" name="password-confirm" class="form-control"
                                               id="password-confirm" required autocomplete="new-password">
                                    </div>

                                    <button type="submit" class="btn btn-primary mr-2">
                                        {{__('labels.actions.create')}}
                                    </button>

                                    <button type="reset" class="btn iq-bg-danger">
                                        {{__('labels.actions.reset')}}
                                    </button>
                                </form>
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
            $('#city_id').select2();
        })(jQuery);
    </script>
@endsection
