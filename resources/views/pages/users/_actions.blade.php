<div class="flex align-items-center list-user-action">
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
       href="{{ route('user_edit', ['id' => $user->id, 'lang' => app()->getLocale()]) }}">
        <i class="ri-pencil-line"></i>
    </a>
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show"
       href="{{ route('user_show', ['id' => $user->id, 'lang' => app()->getLocale()]) }}">
        <i class="ri-eye-close-line"></i>
    </a>
</div>
