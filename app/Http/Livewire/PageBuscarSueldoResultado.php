<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\OfertaLaboral;
use App\Models\Provincia;
use Livewire\Component;

class PageBuscarSueldoResultado extends Component
{
    public $categoriaSeleccionada;
    public $localidadSeleccionada;

    public $search;
    public $searchUbi;

    public $localidades = []; // Resultados de ubicación
    public $categorias = []; // Resultados de categorías

    public function selectCategoria($categoria)
    {
        $this->search = $categoria; // Actualiza el campo de búsqueda con la categoría seleccionada
        $this->categoriaSeleccionada = $categoria; // Guarda la categoría seleccionada
        $this->categorias = []; // Limpia los resultados de búsqueda
    }

    // Método para seleccionar localidad
    public function selectLocalidad($localidad)
    {
        $this->searchUbi = $localidad; // Actualiza el campo de búsqueda con la localidad seleccionada
        $this->localidadSeleccionada = $localidad; // Guarda la localidad seleccionada
        $this->localidades = []; // Limpia los resultados de búsqueda
    }

    public function updatedSearch()
    {
        $this->categorias = []; // Limpiar resultados anteriores

        // Búsqueda de categorías que coincidan con el término ingresado
        if (!empty($this->search)) {
            $categorias = Category::where('name', 'like', '%' . $this->search . '%')->get();
            foreach ($categorias as $categoria) {
                $this->categorias[] = $categoria;
            }
        }
    }

    // Método para actualizar la búsqueda de ubicaciones
    public function updatedSearchUbi()
    {
        $this->localidades = []; // Limpiar resultados anteriores

        // Búsqueda en Departamentos
        if (!empty($this->searchUbi)) {
            $departamentos = Departamento::where('name', 'like', '%' . $this->searchUbi . '%')->get();
            foreach ($departamentos as $departamento) {
                $this->localidades[] = [
                    'type' => 'Departamento',
                    'name' => $departamento->name,
                ];
            }

            // Búsqueda en Provincias
            $provincias = Provincia::where('name', 'like', '%' . $this->searchUbi . '%')->get();
            foreach ($provincias as $provincia) {
                $this->localidades[] = [
                    'type' => 'Provincia',
                    'name' => $provincia->name,
                ];
            }

            // Búsqueda en Distritos
            $distritos = Distrito::where('name', 'like', '%' . $this->searchUbi . '%')->get();
            foreach ($distritos as $distrito) {
                $this->localidades[] = [
                    'type' => 'Distrito',
                    'name' => $distrito->name,
                ];
            }
        }
    }

    public function mount()
    {
        // Obtener los valores de la sesión
        $this->categoriaSeleccionada = session('categoria');
        $this->localidadSeleccionada = session('localidad');
        // Asignar valores iniciales a las búsquedas
        $this->search = $this->categoriaSeleccionada;
        $this->searchUbi = $this->localidadSeleccionada;
    }

    public function render()
    {
        $categorias = $this->categorias;
        $localidades = $this->localidades;
        // Si no hay valores en la sesión, usar $search y $searchUbi para buscar
        $categoria = $this->categoriaSeleccionada ?? $this->search;
        $localidad = $this->localidadSeleccionada ?? $this->searchUbi;

        // Obtener las ofertas laborales filtradas
        $ofertas = OfertaLaboral::when($categoria, function ($query) use ($categoria) {
            $query->whereHas('category', function ($q) use ($categoria) {
                $q->where('name', 'like', '%' . $categoria . '%');
            });
        })
            ->when($localidad, function ($query) use ($localidad) {
                $query->where(function ($q) use ($localidad) {
                    $q->whereHas('departamento', function ($q) use ($localidad) {
                        $q->where('name', 'like', '%' . $localidad . '%');
                    })
                        ->orWhereHas('provincia', function ($q) use ($localidad) {
                            $q->where('name', 'like', '%' . $localidad . '%');
                        })
                        ->orWhereHas('distrito', function ($q) use ($localidad) {
                            $q->where('name', 'like', '%' . $localidad . '%');
                        });
                });
            })
            ->get();

        // Obtener las IDs de las ofertas ya filtradas
        $ofertaIds = $ofertas->pluck('id')->toArray();

        // Obtener el sueldo más alto de las ofertas filtradas
        $sueldoMaximo = $ofertas->isNotEmpty() ? $ofertas->max('remuneracion') : 0; // Si no hay resultados, usar 0

        // Obtener ofertas similares en la misma categoría con mejor sueldo
        $similares = OfertaLaboral::whereHas('category', function ($query) {
            // Filtrar por categoría seleccionada
            $query->where('name', $this->categoriaSeleccionada);
        })
            ->where('remuneracion', '>', $sueldoMaximo) // Solo ofertas con sueldo mayor al máximo filtrado
            ->whereNotIn('id', $ofertaIds) // Excluir las ofertas ya seleccionadas
            ->orderByDesc('remuneracion') // Ordenar por mejor sueldo
            ->get();

        // Ofertas recomendadas
        $recomendaciones = OfertaLaboral::when($categoria, function ($query) use ($categoria) {
            $query->whereHas('category', function ($q) use ($categoria) {
                $q->where('name', 'like', '%' . $categoria . '%');
            });
        })
            ->where('remuneracion', '>', 0)
            ->orderByDesc('remuneracion')
            // ->take(5)
            ->get();

        // Promedio de remuneración
        $promedioRemuneracion = OfertaLaboral::when($categoria, function ($query) use ($categoria) {
            $query->whereHas('category', function ($q) use ($categoria) {
                $q->where('name', 'like', '%' . $categoria . '%');
            });
        })
            ->avg('remuneracion');

        // Obtener favoritos recientes
        $favoritosRecientes = session('favoritos_recientes', []);
        $ofertasSugeridas = collect();

        if (!empty($favoritosRecientes)) {
            $ofertasFavoritas = OfertaLaboral::whereIn('id', $favoritosRecientes)->get();

            $ofertasSugeridas = OfertaLaboral::whereIn('category_id', $ofertasFavoritas->pluck('category_id')->toArray())
                ->where('remuneracion', '>', 0)
                ->orderByDesc('remuneracion')
                // ->take(5)
                ->get();
        }

        return view('pages.page-buscar-sueldo-resultado', compact('ofertas', 'similares', 'recomendaciones', 'ofertasSugeridas', 'promedioRemuneracion', 'categorias', 'localidades'));
    }
    public function redirectOtraClase()
    {
        // Guardar los valores seleccionados en la sesión
        session()->put('categoria', $this->search);
        session()->put('localidad', $this->searchUbi);
        return Redirect()->route('page.buscar.sueldo.resultados');

    }
}
