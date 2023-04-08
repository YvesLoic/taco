<span class="{{!empty(session('last_active'))==1?"bg-green":"bg-red"}}">
@switch($user->roles->pluck('name')[0])
        @case('super_admin')
        <span>{{__('labels.rules.super')}}</span>
        @break
        @case('admin')
        <span>{{__('labels.rules.admin')}}</span>
        @break
        @case('client')
        <span>{{__('labels.rules.client')}}</span>
        @break
        @case('driver')
        <span>{{__('labels.rules.driver')}}</span>
        @break
    @endswitch
</span>
