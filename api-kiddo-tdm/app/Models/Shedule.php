<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    use HasFactory;
    protected $table = 'shedules';

    protected $fillable = [
        'hour',
        
    ];

    public function classGroups(){
        return $this->hasMany(ClassGroups::class);
    }
}
