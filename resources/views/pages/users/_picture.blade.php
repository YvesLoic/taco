@if($user->picture==null)
    <img class="rounded-circle img-fluid avatar-40" src="{{asset('assets/images/guest.png')}}" alt="profile">
@else
    <img class="rounded-circle img-fluid avatar-40" src="{{asset('assets/images/users/'.$user->picture)}}"
         alt="profile">
@endif
