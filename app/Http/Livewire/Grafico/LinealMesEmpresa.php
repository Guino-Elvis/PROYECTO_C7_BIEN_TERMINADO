<?php

namespace App\Http\Livewire\Grafico;

use App\Models\Empresa;
use Livewire\Component;

class LinealMesEmpresa extends Component
{
    public $meses = [];
    public $empresasPorMes = [];

    public function mount()
    {
        // Generar los meses del año
        $this->meses = collect(range(1, 12))->map(fn($mes) => \DateTime::createFromFormat('!m', $mes)->format('F'))->toArray();

        // Determinar el campo de fecha a usar
        $campoFecha = Empresa::whereNotNull('creado')->exists() ? 'creado' : 'created_at';

        // Obtener la cantidad de empresas por mes
        $this->empresasPorMes = Empresa::selectRaw("MONTH($campoFecha) as mes, COUNT(*) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->pluck('total', 'mes')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.grafico.lineal-mes-empresa');
    }
}
