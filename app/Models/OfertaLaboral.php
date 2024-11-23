<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OfertaLaboral extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'remuneracion',
        'descripcion',
        'body',
        'fecha_inicio',
        'fecha_fin',
        'limite_postulante',
        'documentos_oferta',
        'state',
        'empresa_id',
        'category_id',
        'user_id',
        'departamento_id',
        'provincia_id',
        'distrito_id',
        'creado',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    //Relación 1 a * inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relación 1 a *
    public function aplication()
    {
        return $this->hasMany(Application::class);
    }


    public function isFavorito($userId)
    {
        return OfertaLaboralReciente::where('user_id', $userId)
            ->where('oferta_laboral_id', $this->id)
            ->exists();
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class, 'distrito_id');
    }
}
