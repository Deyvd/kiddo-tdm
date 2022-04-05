<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';

    protected $fillable = [
        'student_id',
        'class_group_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }


}
