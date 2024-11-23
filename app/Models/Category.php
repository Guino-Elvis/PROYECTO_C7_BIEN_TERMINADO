<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'state', 'user_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   

    public function oferta_lavoral()
    {
        return $this->hasMany(OfertaLaboral::class);
    }

        //Relación 1 a 1 polimorfica
    //Se pasa la clase y el metodo definido
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
