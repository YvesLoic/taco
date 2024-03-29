<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get list of Users associated to this city.
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get parent data for this city
     *
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
