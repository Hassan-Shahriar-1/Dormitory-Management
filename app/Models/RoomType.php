<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomType extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'room_types';

    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id', 'room_type_id');
    }
}
