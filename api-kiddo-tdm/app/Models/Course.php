<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';

    protected $fillable = [
        'cicle_id',
        'name',
        'max_age',
        'min_age',
    ];

    public function cicle()
    {
        return $this->belongsTo(Cicle::class);
    }

    public function classGroups()
    {
        return $this->hasMany(ClassGroup::class);
    }
}
