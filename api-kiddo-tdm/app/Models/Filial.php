<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    use HasFactory;
    protected $table = 'filials';

    protected $fillable = [
        'name',
        'full_address',
    ];

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
