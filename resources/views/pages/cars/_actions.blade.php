<div class="flex align-items-center list-user-action">
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
       href="{{route('car_edit', ['id'=>$car->id, 'lang'=>app()->getLocale()])}}">
        <i class="ri-pencil-line"></i>
    </a>
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"
       href="{{route('car_show', ['id'=>$car->id, 'lang'=>app()->getLocale()])}}">
        <i class="ri-eye-line"></i>
    </a>
</div>
