<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassGroup extends Model
{
    use HasFactory;
    protected $table = 'class_groups';

    protected $fillable = [
        'start',
        'class_day_id',
        'shedule_id',
        'course_id',
        'teacher_id',
        'room_id',
        
    ];

    public function contracts(){
        return $this->hasMany(Contract::class);
    }

    public function classDay(){
        return $this->belongsTo(ClassDay::class);
    }

    public function shedule(){
        return $this->belongsTo(Shedule::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
    
    public function room(){
        return $this->belongsTo(Room::class);
    }
}
