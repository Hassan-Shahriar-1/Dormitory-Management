<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory, UsesUuid;

    protected $table = 'dormitories';

    protected $fillable = [
        'name',
        'type',
        'address',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
