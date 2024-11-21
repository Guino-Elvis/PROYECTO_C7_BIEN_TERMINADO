<?php

namespace App\Http\Livewire;

use App\Models\OfertaLaboralReciente;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;
class PageFavoritos extends Component
{
    protected $listeners = ['favoriteUpdated' => 'refreshFavoritos','removeFavorite' => 'removeFavorite'];

    public $ofertas = [];

    public function mount()
    {
     
        $this->refreshFavoritos();
    }

    public function refreshFavoritos()
    {
        $user = auth()->user();

        if ($user === null) {
            $this->ofertas = OfertaLaboralReciente::take(0)->get(); 
        } else {
            $this->ofertas = OfertaLaboralReciente::whereHas('User', function ($query) use ($user) {
                $query->where('id', $user->id);
            })->get();
        }
    }

    public function removeFavorite($favoriteId)
    {
    
        $favorite = OfertaLaboralReciente::find($favoriteId);
        if ($favorite && $favorite->user_id == Auth::id()) {
            $favorite->delete();
            $this->emit('favoriteUpdated');
            Toastr::success('¡Favorito eliminado correctamente!', '¡Éxito!');
        } else {
            Toastr::error('No se pudo eliminar el favorito', 'Error');
        }
    }

    public function render()
    {
        return view('pages.page-favoritos', ['ofertas' => $this->ofertas]);
    }
}
