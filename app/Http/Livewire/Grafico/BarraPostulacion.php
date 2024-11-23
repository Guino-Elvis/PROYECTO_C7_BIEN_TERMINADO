<?php

namespace App\Http\Livewire\Grafico;

use App\Models\Application;
use Livewire\Component;

class BarraPostulacion extends Component
{
    public $meses = [];
    public $re = [];
    public $ap = [];
    public $pe = [];

    public function mount()
    {
        // Generar los meses del año
        $this->meses = collect(range(1, 12))->map(fn($mes) => \DateTime::createFromFormat('!m', $mes)->format('F'))->toArray();

        // Determinar el campo de fecha a usar
        $campoFecha = Application::whereNotNull('creado')->exists() ? 'creado' : 'created_at';

        // Cargar las postulaciones según su estado
        $this->re = $this->obtenerPostulacionesPorEstado('RE', $campoFecha);
        $this->ap = $this->obtenerPostulacionesPorEstado('AP', $campoFecha);
        $this->pe = $this->obtenerPostulacionesPorEstado('PE', $campoFecha);
    }

    private function obtenerPostulacionesPorEstado($estado, $campoFecha)
    {
        return Application::selectRaw("MONTH($campoFecha) as mes, COUNT(*) as total")
            ->where('status', $estado)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.barra-postulacion');
    }
}
