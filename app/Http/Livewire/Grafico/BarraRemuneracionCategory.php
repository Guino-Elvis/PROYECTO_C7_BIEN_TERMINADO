<?php

namespace App\Http\Livewire\Grafico;

use App\Models\Category;
use App\Models\OfertaLaboral;
use Livewire\Component;

class BarraRemuneracionCategory extends Component
{
    public $categorias = [];
    public $remuneracionPromedio = [];

    public function mount()
    {
        // Obtener las categorías (por ejemplo, 'nombre' de la categoría)
        $this->categorias = \DB::table('categories')->pluck('name')->toArray();
        $this->remuneracionPromedio = OfertaLaboral::selectRaw('category_id, AVG(remuneracion) as promedio')
            ->groupBy('category_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->category_id => round($item->promedio, 2)]; // Redondear el promedio a 2 decimales
            })
            ->toArray();
    }
    public function render()
    {
        return view('livewire.grafico.barra-remuneracion-category');
    }
}
