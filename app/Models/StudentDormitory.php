<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UsesUuid;

class StudentDormitory extends Model
{
    use HasFactory, UsesUuid, SoftDeletes;

    protected $table = 'student_dormitories';

    protected $fillable = [
        'student_id',
        'room_id',
        'dormitory_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id');
    }
}
