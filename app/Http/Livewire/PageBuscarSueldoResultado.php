<?php

namespace App\Http\Livewire;

use App\Models\OfertaLaboral;
use Livewire\Component;

class PageBuscarSueldoResultado extends Component
{
    public $categoriaSeleccionada;
    public $localidadSeleccionada;

    public function mount()
    {
        // Obtener los valores de la sesión
        $this->categoriaSeleccionada = session('categoria');
        $this->localidadSeleccionada = session('localidad');
    }

    public function render()
    {
        // Obtener las ofertas laborales filtradas por categoría y localidad
        $ofertas = OfertaLaboral::whereHas('category', function ($query) {
            // Filtrar por categoría seleccionada
            $query->where('name', $this->categoriaSeleccionada);
        })
            ->where(function ($query) {
                // Filtrar por localidad seleccionada (departamento, provincia o distrito)
                $query->whereHas('departamento', function ($query) {
                    $query->where('name', $this->localidadSeleccionada);
                })
                    ->orWhereHas('provincia', function ($query) {
                    $query->where('name', $this->localidadSeleccionada);
                })
                    ->orWhereHas('distrito', function ($query) {
                    $query->where('name', $this->localidadSeleccionada);
                });
            })
            ->get();

        // Obtener las IDs de las ofertas ya filtradas
        $ofertaIds = $ofertas->pluck('id')->toArray();

        // Obtener ofertas similares (mismo categoría y localidad)
        $similares = OfertaLaboral::whereHas('category', function ($query) {
            // Filtrar por categoría seleccionada
            $query->where('name', $this->categoriaSeleccionada);
        })
            ->where(function ($query) {
                // Filtrar por localidad seleccionada (departamento, provincia o distrito)
                $query->whereHas('departamento', function ($query) {
                    $query->where('name', $this->localidadSeleccionada);
                })
                    ->orWhereHas('provincia', function ($query) {
                    $query->where('name', $this->localidadSeleccionada);
                })
                    ->orWhereHas('distrito', function ($query) {
                    $query->where('name', $this->localidadSeleccionada);
                });
            })
            ->whereNotIn('id', $ofertaIds) // Excluir las ofertas ya seleccionadas
            ->take(5) // Limitar a 5 ofertas similares
            ->get();

      
        // Obtener ofertas recomendadas basadas en la remuneración, considerando la categoría
        $recomendaciones = OfertaLaboral::whereHas('category', function ($query) {
            // Filtrar por categoría seleccionada
            $query->where('name', $this->categoriaSeleccionada);
        })
            ->where('remuneracion', '>', 0) // Asegurarnos de que la remuneración sea válida
            ->orderByDesc('remuneracion') // Ordenar por remuneración
            ->take(5) // Limitar a 5 ofertas de mayor remuneración
            ->get();

          // Obtener el promedio de la remuneración para la categoría seleccionada
          $promedioRemuneracion = OfertaLaboral::whereHas('category', function ($query) {
            // Filtrar por categoría seleccionada
            $query->where('name', $this->categoriaSeleccionada);
        })
            ->avg('remuneracion'); // Obtener el promedio de la columna 'remuneracion'
        // Obtener las ofertas recientes guardadas en la sesión
        $favoritosRecientes = session('favoritos_recientes', []);

        // Si hay ofertas recientes guardadas, obtenerlas de la base de datos
        if (!empty($favoritosRecientes)) {
            $ofertasFavoritas = OfertaLaboral::whereIn('id', $favoritosRecientes)
                ->get();

            // Filtrar las ofertas que coinciden en categoría y remuneración
            $ofertasSugeridas = OfertaLaboral::whereIn('category_id', $ofertasFavoritas->pluck('category_id')->toArray())
                ->where('remuneracion', '>', 0)
                ->orderByDesc('remuneracion')
                ->take(5) // Limitar a las 5 ofertas más relevantes
                ->get();
        } else {
            $ofertasSugeridas = collect(); // Si no hay ofertas recientes, mostrar vacío
        }

        return view('pages.page-buscar-sueldo-resultado', compact('ofertas', 'similares', 'recomendaciones', 'ofertasSugeridas','promedioRemuneracion'));
    }
}