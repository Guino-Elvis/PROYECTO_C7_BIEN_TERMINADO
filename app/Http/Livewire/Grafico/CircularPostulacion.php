<?php

namespace App\Http\Livewire\Grafico;

use App\Models\Application;
use Livewire\Component;

class CircularPostulacion extends Component
{
    public $estadoPostulaciones = [];

    public function mount()
    {
        // Obtener el conteo de postulaciones por estado
        $this->estadoPostulaciones = Application::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.circular-postulacion');
    }
}
