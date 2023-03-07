@extends('home')

@section('title')
    {{config('app.name')}} - {{__('labels.car.pages.create.title')}}
@endsection

@section('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('assets/css/image-uploader.css')}}">
@endsection

@section('center_page')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{__('labels.car.pages.create.card_title')}}</h4>
                        @if (!empty($car) && !empty($car->deleted_at))
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

@section('scripts')
    <script src="{{asset('assets/js/image-uploader.js')}}"></script>
    <script type="text/javascript">
        (function ($) {

            $('.type-class').select2();
            $('.owner').select2();

            let car = {{Js::from($car)}};

            const setSrc = base => "{{asset('assets/images/cars')}}/".concat(base);

            $('.input-images').imageUploader({
                label: function () {
                    return '{{__('labels.car.form.pics_label')}}';
                },
                imagesInputName: 'pictures',
                preloaded: car.pictures ? car.pictures.map(p => ({...p, src: setSrc(p.src)})) : null,
            });

            $('.delete-image').on('click', function (e) {

                e.preventDefault();

                let id = $(this).parent().find('input').val();

                $.ajax({
                    url: '{{route('car_delete_img', ['lang'=>'en'])}}',
                    type: 'DELETE',
                    data: {'id': id, '_token': '{{csrf_token()}}'},
                    success: function (data, textStatus, jqXHR) {
                        $('<span>', {
                            text: '{{__('labels.actions.messages.success.title')}}',
                            class: "badge iq-bg-success"
                        }).appendTo($('#pictures'));
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        $('<span>', {
                            text: '{{__('labels.actions.messages.error.title')}}',
                            class: "badge iq-bg-danger"
                        }).appendTo($('#pictures'));
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
