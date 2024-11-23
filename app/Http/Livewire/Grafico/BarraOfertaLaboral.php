<?php

namespace App\Http\Livewire\Grafico;

use App\Models\OfertaLaboral;
use Livewire\Component;

class BarraOfertaLaboral extends Component
{
    public $meses = [];
    public $escondido = [];
    public $visible = [];

    public function mount()
    {
        $this->meses = collect(range(1, 12))->map(fn($mes) => \DateTime::createFromFormat('!m', $mes)->format('F'))->toArray();

        $this->escondido = $this->obtenerDatosPorEstado(1);
        $this->visible = $this->obtenerDatosPorEstado(2);
    }

    private function obtenerDatosPorEstado($estado)
    {
        $campoFecha = OfertaLaboral::whereNotNull('creado')->exists() ? 'creado' : 'created_at';

        return OfertaLaboral::selectRaw("MONTH($campoFecha) as mes, COUNT(*) as total")
            ->where('state', $estado)
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.barra-oferta-laboral');
    }
}