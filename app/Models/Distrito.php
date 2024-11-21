<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    
    protected $fillable = ['name', 'provincia_id', 'departamento_id'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
}
