<div class="flex align-items-center list-user-action">
{{--    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"--}}
{{--       href="{{route('displacement_edit', ['id'=>$trip->id, 'lang'=>app()->getLocale()])}}">--}}
{{--        <i class="ri-pencil-line"></i>--}}
{{--    </a>--}}
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"
       href="{{route('displacement_show', ['id'=>$trip->id, 'lang'=>app()->getLocale()])}}">
        <i class="ri-eye-close-line"></i>
    </a>
</div>
