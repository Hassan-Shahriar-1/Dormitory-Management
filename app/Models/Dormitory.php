<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dormitory extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'dormitories';

    protected $fillable = [
        'name',
        'type',
        'address',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function studentDormitory()
    {
        return $this->hasMany(studentDormitory::class, 'id', 'dormitory_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'id', 'dormitory_id');
    }
}
