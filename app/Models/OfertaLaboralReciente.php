<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class OfertaLaboralReciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'marcado',
        'user_id',
        'oferta_laboral_id'
    ];


    public function oferta_laboral()
    {
        return $this->belongsTo(OfertaLaboral::class);
    }

    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
