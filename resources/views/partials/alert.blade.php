@if(\Illuminate\Support\Facades\Session::has('alerts'))
    @foreach(\Illuminate\Support\Facades\Session::get('alerts') as $alert)
        <a href="{{route('displacement_show', ['lang'=>app()->getLocale(), 'id'=>$alert->displacement->id])}}"
           class="iq-sub-card">
            <div class="media align-items-center">
                <div class="">
                    <img
                        class="avatar-40 rounded"
                        src="{{$alert->displacement->user->picture==null ?
                        asset('assets/images/guest.png') :
                        asset('assets/images/users/'.$alert->displacement->user->picture)}}"
                        alt="">
                </div>
                <div class="media-body ml-3">
                    <h6 class="mb-0 ">
                        {{$alert->displacement->user->first_name.' '.$alert->displacement->user->last_name}}
                    </h6>
                    <small class="float-right font-size-12">
                        {{Carbon\Carbon::parse($alert->created_at)->diffForHumans()}}
                    </small>
                    <p class="mb-0">{{$alert->content}}</p>
                    <p class="mb-0">{{$alert->type}}</p>
                </div>
            </div>
        </a>
    @endforeach
@endif

