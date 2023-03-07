@if($type->created_at != null)
    <span class="badge iq-bg-primary">{{__('labels.available')}}</span>
@else
    <span class="badge iq-bg-danger">{{__('labels.no_available')}}</span>
@endif
