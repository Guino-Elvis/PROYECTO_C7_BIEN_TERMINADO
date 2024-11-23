<?php

namespace App\Http\Livewire\Grafico;

use App\Models\Postulante;
use Livewire\Component;

class LinealMesPostulante extends Component
{
    public $meses = [];
    public $postulantesPorMes = [];

    public function mount()
    {
        // Generar los meses del año
        $this->meses = collect(range(1, 12))->map(fn($mes) => \DateTime::createFromFormat('!m', $mes)->format('F'))->toArray();

        // Determinar el campo de fecha a usar
        $campoFecha = Postulante::whereNotNull('creado')->exists() ? 'creado' : 'created_at';

        // Obtener la cantidad de postulantes por mes
        $this->postulantesPorMes = Postulante::selectRaw("MONTH($campoFecha) as mes, COUNT(*) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.lineal-mes-postulante');
    }
}
