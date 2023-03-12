<?php

namespace Modules\Reservation\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';

    protected $fillable = [
        'from',
        'to',
        'childrens',
        'room_type',
        'adults',
        'user_id'
    ];

    protected $attributes = [
        'childrens' => 0
    ];

    protected $dates = [
        'from',
        'to'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Reservation\Database\factories\ReservationFactory::new();
    }
}
