<span>
    {{Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}
    @if(!Cache::has('user-is-online-', $user->id))
        <span class="iq-bg-success">{{__('labels.online')}}</span>
    @else
        <span class="iq-bg-danger">{{__('labels.offline')}}</span>
    @endif
</span>
