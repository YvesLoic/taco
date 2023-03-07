<div class="flex align-items-center list-user-action">
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
       href="{{route('type_edit', ['lang'=>app()->getLocale(), 'id'=>$type->id])}}">
        <i class="ri-pencil-line"></i>
    </a>
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"
       href="{{route('type_show', ['lang'=>app()->getLocale(), 'id'=>$type->id])}}">
        <i class="ri-eye-line"></i>
    </a>
</div>
