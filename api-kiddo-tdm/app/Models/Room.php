<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'filial_id',
    ];

    public function filial(){
        return $this->belongsTo(Filial::class);
    }

    public function classGroups(){
        return $this->hasMany(ClassGroup::class);
    }
}
