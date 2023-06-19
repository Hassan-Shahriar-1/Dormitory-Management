<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'students';

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
