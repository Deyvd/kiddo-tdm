<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsible extends Model
{
    use HasFactory;
    protected $table = 'responsibles';

    protected $fillable = [
        'name',
        'birth_date',
        'responsible_id',
        'rg',
        'org_emit',
        'cpf',
        'ocupation',
        'phone',
        'whatsapp',
        'full_address',
        'email',
    ];


    public function students(){
        return $this->hasMany(Student::class);
    }
}
