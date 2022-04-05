<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $fillable = [
        'name',
        'birth_date',
        'responsible_id',
    ];


    public function responsible(){
        return $this->belongsTo(Responsible::class);
    }

    public function contracts(){
        return $this->hasOne(Contract::class);
    }
}
