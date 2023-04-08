<span>
    {{is_null($trip->car)?"":$trip->car->user->first_name}}
    {{is_null($trip->car)?"":$trip->car->user->last_name}}
</span>
