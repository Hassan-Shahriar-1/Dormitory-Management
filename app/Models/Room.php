<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'rooms';

    protected $fillable = [
        'room_number',
        'number_of_beds',
        'dormitory_id',
        'description',
        'room_type_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
