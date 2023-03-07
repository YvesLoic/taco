<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Displacement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'to',
        'to_lat',
        'to_lon',
        'from',
        'from_lat',
        'from_lon',
        'distance',
        'price',
        'status',
        'type',
        'car_id',
        'user_id',
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
     * Get associated Car of this Displacement
     *
     * @return BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    /**
     * Get associated Alert of this Displacement
     *
     * @return HasMany
     */
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    /**
     * Get associated Alert of this Displacement
     *
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
