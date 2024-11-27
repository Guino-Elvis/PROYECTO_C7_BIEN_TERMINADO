<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteracionUser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ofertas'];

    protected $casts = [
        'ofertas' => 'array',
    ];
    
    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
