<div class="flex align-items-center list-user-action">
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
       href="{{route('city_edit', ['id'=>$city->id, 'lang'=>app()->getLocale()])}}">
        <i class="ri-pencil-line"></i>
    </a>
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"
       href="{{route('city_show', ['id'=>$city->id, 'lang'=>app()->getLocale()])}}">
        <i class="ri-eye-line"></i>
    </a>
</div>
