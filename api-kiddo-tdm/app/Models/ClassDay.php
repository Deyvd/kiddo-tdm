<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassDay extends Model
{
    use HasFactory;
    protected $table = 'class_days';

    protected $fillable = [
        'dia_of_week',
        
    ];

    public function classGroups(){
        return $this->hasMany(ClassGroups::class);
    }
}
