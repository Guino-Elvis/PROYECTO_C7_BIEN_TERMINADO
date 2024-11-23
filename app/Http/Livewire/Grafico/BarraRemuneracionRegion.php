<?php

namespace App\Http\Livewire\Grafico;

use App\Models\OfertaLaboral;
use Livewire\Component;

class BarraRemuneracionRegion extends Component
{  
    public $regiones = [];
    public $remuneracionPromedio = [];

    public function mount()
    {
        // Obtener las regiones (en este caso, usamos 'departamento_id', pero puedes cambiarlo a 'provincia_id' o 'distrito_id')
        $this->regiones = \DB::table('departamentos')->pluck('name')->toArray();

        // Obtener la remuneración promedio por cada región (usando 'departamento_id')
        $this->remuneracionPromedio = OfertaLaboral::selectRaw('departamento_id, AVG(remuneracion) as promedio')
            ->groupBy('departamento_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->departamento_id => round($item->promedio, 2)]; // Redondear el promedio a 2 decimales
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire.grafico.barra-remuneracion-region');
    }
}
