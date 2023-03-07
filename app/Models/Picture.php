<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Picture extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'src',
        'car_id',
    ];

    /**
     * Get the car associated to this picture
     *
     * @return BelongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
