@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.user.pages.create.title')}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}">
@endsection

@section('center_page')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{__('labels.user.pages.create.card_title')}}</h4>
                        @if (!empty($user) && !empty($user->deleted_at))
                            <span class="badge bg-warning float-end">
                                {{__('labels.actions.messages.error.delete_data')}}
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

@section('scripts')
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        (function ($) {

            $('.city-class').select2();

            let val = {{Js::from($user)}};

            if (val != null && val.picture != undefined) {
                let srcs = "{{asset('assets/images/users')}}/"+val.picture;
                $('#picture').parent()
                    .append(
                        $('<div id="preview"></div>')
                            .append(`<img src="${srcs}" alt="prévue de l\'image" style="width: 200px; height: 250px;"/>`)
                    );
            }

            $('#picture').on('change', function () {
                $('#preview').remove();
                let reader = new FileReader();
                reader.onload = (e) => {
                    $(this).parent()
                        .append(
                            $('<div id="preview"></div>')
                                .append(
                                    `<img src="${e.target.result}" alt="prévue de l\'image" style="width: 200px; height: 250px;"/>`
                                )
                        );
                }
                reader.readAsDataURL(this.files[0]);
            });
        })(jQuery);
    </script>
@endsection
