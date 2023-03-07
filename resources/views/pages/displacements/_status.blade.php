@if($trip->status == "pending")
    <span class="iq-bg-warning">{{__('labels.pending')}}</span>
@elseif($trip->status == "ongoing")
    <span class="iq-bg-success">{{__('labels.ongoing')}}</span>
@elseif($trip->status == "ended")
    <span class="iq-bg-danger">{{__('labels.ended')}}</span>
@else
    <span class="iq-bg-info">{{__('labels.broadcast')}}</span>
@endif
