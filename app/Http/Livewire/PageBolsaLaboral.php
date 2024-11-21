<?php

namespace App\Http\Livewire;

use App\Models\OfertaLaboral;
use App\Models\OfertaLaboralReciente;
use Livewire\Component;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
class PageBolsaLaboral extends Component
{

    public $primerDetalle;
    public $search;
    public $searchUbi;
    public $amount = 10;
    public $loadingMore = false;
    public $noMoreResults = false;


    public function handleClick()
    {
        $this->emit('iniciarPostulacion');
    }

    public function mount()
    {
        $this->primerDetalle = OfertaLaboral::where('state', 2)->first();
    }

    public function render()
    {

        $query = OfertaLaboral::query();
        $query->where(function ($q) {
            $q->where('titulo', 'like', '%' . $this->search . '%')
                ->orWhere('remuneracion', 'like', '%' . $this->search . '%');
        });

        // Realizamos la búsqueda por ubicación (departamento, provincia, distrito)
        if (!empty($this->searchUbi)) {
            $this->searchByLocation($query);
        }

        $ofertas = $query->latest('id')->take($this->amount)->get();
        if ($ofertas->count() < $this->amount) {
            $this->noMoreResults = true;
        }
        return view('pages.page-bolsa-laboral', compact('ofertas'));
    }
    protected function searchByLocation($query)
    {
        $query->where(function ($q) {
            // Búsqueda por departamento
            $q->orWhereHas('departamento', function ($subquery) {
                $subquery->where('name', 'like', '%' . $this->searchUbi . '%');
            })
                // Búsqueda por provincia
                ->orWhereHas('provincia', function ($subquery) {
                    $subquery->where('name', 'like', '%' . $this->searchUbi . '%');
                })
                // Búsqueda por distrito
                ->orWhereHas('distrito', function ($subquery) {
                    $subquery->where('name', 'like', '%' . $this->searchUbi . '%');
                });
        });
    }

    public function cargarMas()
    {
        $this->loadingMore = true;
        $this->amount += 10;
        $totalOfertas = OfertaLaboral::count();
        if ($this->amount >= $totalOfertas) {
            $this->noMoreResults = true;
        }

        $this->loadingMore = false;
    }
    public function obtenerDetallesOferta($id)
    {
        $this->primerDetalle = OfertaLaboral::find($id);
    }

    public function toggleFavorite($id)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            Toastr::error('Para agregar, necesitas Iniciar Sesión', 'Error');
            return redirect('/login-bolsa')->with('message', '¡Para agregar, necesitas Iniciar Sesión!');
        }

        // Verificar si el correo del usuario está verificado
        if (Auth::user()->email_verified_at == null) {
            Toastr::error('¡Para continuar, necesitas verificar tu dirección de correo electrónico!', 'Error');
            return view('auth.verify-email');
        }

        $user = auth()->user();
        $oferta = OfertaLaboral::findOrFail($id);

        // Verificar si el usuario ya tiene la oferta marcada como favorita
        $existingFavorite = OfertaLaboralReciente::where('oferta_laboral_id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingFavorite) {
            // Si ya existe un favorito, eliminarlo
            $existingFavorite->delete();
            Toastr::success('¡Se ha eliminado de tus favoritos!', 'Éxito');
        } else {
            // Si no existe, crear un nuevo favorito
            $favorito = new OfertaLaboralReciente();
            $favorito->marcado = '1';
            $favorito->oferta_laboral_id = $oferta->id;
            $favorito->user_id = $user->id;
            $favorito->save();
            session()->push('favoritos_recientes', $oferta->id);
            Toastr::success('¡Oferta añadida a tus favoritos!', 'Éxito');
        }

        // Emitir un evento para actualizar la vista
        $this->emit('favoriteUpdated');
    }
}
