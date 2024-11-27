<?php
namespace App\Http\Livewire;

use App\Models\IteracionUser;
use App\Models\OfertaLaboral;
use App\Models\RecomentOfertaLaboral;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;

class GenerateOferta extends Component
{
    public $recommendations = [];  // Public property for recommendations

    public function mount()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            Toastr::error('Para acceder a esta sección, por favor inicia sesión y disfruta de todas las funcionalidades disponibles.', '¡Acceso Denegado!');
            return redirect('/login-bolsa')->with('message', '¡Necesitas iniciar sesión para continuar!');
        }

        // Verificar si el correo del usuario está verificado
        if (Auth::user()->email_verified_at == null) {
            Toastr::error('¡Para continuar, necesitas verificar tu dirección de correo electrónico!', 'Error');
            return redirect()->route('verification.notice'); // Redirige a la página de verificación
        }

        // Si el usuario está autenticado y su correo está verificado, procedemos a crear las recomendaciones
        $this->crear_recomendacion();
    }

    public function render()
    {
        $recommendations = $this->recommendations;
        return view('livewire.generate-oferta', compact('recommendations'));
    }

    public function crear_recomendacion()
    {
        // Si el usuario no está autenticado, no hacer nada
        if (!Auth::check()) {
            return;
        }

        $userLogin = Auth::user();
        $transactions = IteracionUser::where('user_id', $userLogin->id)->get();

        // Inicializar recomendaciones como un array vacío
        $recommendations = [];

        if (!$transactions->isEmpty()) {
            foreach ($transactions as $transaction) {
                $ofertas = json_decode($transaction->ofertas);

                foreach ($ofertas as $ofertaId) {
                    $oferta = OfertaLaboral::find($ofertaId);
                    if ($oferta) {
                        $similarOfertas = $this->findSimilarOfertas($oferta);
                        foreach ($similarOfertas as $similarOferta) {
                            $recommendations[] = $similarOferta;
                        }
                    }
                }
            }

            // Eliminar duplicados
            $recommendations = array_unique($recommendations, SORT_REGULAR);

            // Almacenar recomendaciones si existen
            if (!empty($recommendations)) {
                RecomentOfertaLaboral::create([
                    'user_id' => $userLogin->id,
                    'ofertas_recomendadas' => json_encode(array_column($recommendations, 'id')),
                ]);
            }
        }

        // Asignar las recomendaciones a la propiedad pública
        $this->recommendations = $recommendations;
    }
    
    public function findSimilarOfertas($oferta)
    {
        return OfertaLaboral::where('id', '!=', $oferta->id)
            ->where(function ($query) use ($oferta) {
                $query->where('titulo', 'like', '%' . $oferta->titulo . '%')
                    ->orWhere('category_id', $oferta->category_id);
            })
            ->get(); // Mantén esto como una colección
    }
}