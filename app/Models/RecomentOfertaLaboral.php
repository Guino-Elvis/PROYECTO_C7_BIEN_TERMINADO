<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecomentOfertaLaboral extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ofertas_recomendadas',
    ];

      //Relación 1 a * inversa
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
