<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicle extends Model
{
    use HasFactory;
    protected $table = 'cicles';

    protected $fillable = [
        'level',
        'min_age',
        'max_age',
    ];

    public function courses(){
        return $this->hasMany(Course::class);
    }
}
