<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'rooms';

    protected $fillable = [
        'room_number',
        'number_of_beds',
        'dormitory_id',
        'number_of_beds',
        'description',
        'room_type_id'
    ];
}
