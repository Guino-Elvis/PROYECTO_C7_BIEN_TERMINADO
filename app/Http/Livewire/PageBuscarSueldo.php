<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Livewire\Component;

class PageBuscarSueldo extends Component
{
    public $search; // Búsqueda por categoría
    public $searchUbi; // Búsqueda por ubicación
    public $localidades = []; // Resultados de ubicación
    public $categorias = []; // Resultados de categorías

    // Método para seleccionar categoría
    public function selectCategoria($categoria)
    {
        $this->search = $categoria; // Actualiza el campo de búsqueda con la categoría seleccionada
        $this->categorias = []; // Limpia los resultados de búsqueda
    }

    // Método para seleccionar localidad
    public function selectLocalidad($localidad)
    {
        $this->searchUbi = $localidad; // Actualiza el campo de búsqueda con la localidad seleccionada
        $this->localidades = []; // Limpia los resultados de búsqueda
    }

    // Método para actualizar la búsqueda de categorías
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

    // Método render
    public function render()
    {
        // Obtener resultados de búsqueda de categorías
        $categorias = $this->categorias;
        $localidades = $this->localidades;

        return view('pages.page-buscar-sueldo', compact('localidades', 'categorias'));
    }

    public function redirectOtraClase()
    {
        // Guardar los valores seleccionados en la sesión
        session()->put('categoria', $this->search);
        session()->put('localidad', $this->searchUbi);
        return Redirect()->route('page.buscar.sueldo.resultados');

    }

}
