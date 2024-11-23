<?php

namespace App\Http\Livewire;

use App\Models\Application;
use App\Models\Empresa;
use App\Models\OfertaLaboral;
use App\Models\Postulante;
use Carbon\Carbon;
use Livewire\Component;

class DashboardGeneral extends Component
{


    public function render()
    {
        // Totales actuales
        $totalOfertas = OfertaLaboral::count();
        $totalPostulantes = Postulante::count();
        $totalEmpresas = Empresa::count();
        $totalPostulaciones = Application::count();

        // Totales del mes anterior
        $lastMonth = Carbon::now()->subMonth();
        
         
        $ofertasAnterior = OfertaLaboral::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $postulantesAnterior = Postulante::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $empresasAnterior = Empresa::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        $postulacionesAnterior = Application::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->count();

        // Función para calcular crecimiento porcentual
        $calcularCrecimiento = function ($anterior, $actual) {
            if ($anterior == 0) {
                return $actual > 0 ? 100 : 0;
            }
            return round((($actual - $anterior) / $anterior) * 100, 2);
        };

        // Cálculo de crecimiento porcentual
        $ofertasCrecimiento = $calcularCrecimiento($ofertasAnterior, $totalOfertas);
        $postulantesCrecimiento = $calcularCrecimiento($postulantesAnterior, $totalPostulantes);
        $empresasCrecimiento = $calcularCrecimiento($empresasAnterior, $totalEmpresas);
        $postulacionesCrecimiento = $calcularCrecimiento($postulacionesAnterior, $totalPostulaciones);

        return view('admin.pages.dashboard-general', compact(
            'totalOfertas',
            'totalPostulantes',
            'totalEmpresas',
            'totalPostulaciones',
            'ofertasCrecimiento',
            'postulantesCrecimiento',
            'empresasCrecimiento',
            'postulacionesCrecimiento'
        ));
    }
}
