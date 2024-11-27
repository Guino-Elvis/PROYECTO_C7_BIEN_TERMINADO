<?php

namespace App\Http\Livewire;

use App\Models\IteracionUser;
use App\Models\OfertaLaboral;
use App\Models\RecomentOfertaLaboral;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Phpml\Association\Apriori;

class AprioriAlgoritmo extends Component
{
    public function generateRecommendations()
    {
    
        $userLogin = Auth::user();  // Obtener el usuario logueado

        $transactions = IteracionUser::where('user_id', $userLogin->id)->get(); 

        // Si no hay transacciones, no hacer nada
        if ($transactions->isEmpty()) {
            return;
        }

        // Extraer los productos de las transacciones
        $ofertaTransactions = [];
        foreach ($transactions as $transaction) {
            // Asegúrate de que cada transacción sea un array de productos
            $ofertas = json_decode($transaction->pofertas);
            if (is_array($ofertas)) {
                $ofertaTransactions[] = $ofertas;  // Cada transacción es un array de productos
            }
        }
     
        // Parámetros de Apriori
        $minSupport = [0.1];  // Ahora soporte mínimo es un array con el valor flotante
        $minConfidence = 0.5;  // Confianza mínima en formato flotante

        // Crear el objeto Apriori pasando solo la confianza mínima
        $apriori = new Apriori($minConfidence);  // Solo pasamos la confianza mínima al constructor

        // Ahora pasamos ambos parámetros a la función train():
        $apriori->train($ofertaTransactions, $minSupport);

        // Obtener las reglas de asociación
        $rules = $apriori->getRules(); // Aquí obtendremos un array de objetos AssociationRule
    
        // Almacenar las recomendaciones en un array
        $recommendations = [];

        foreach ($rules as $rule) {
            if (is_object($rule)) {

                $antecedent = implode(", ", $rule->getAntecedent());
                $consequent = implode(", ", $rule->getConsequent());
                 
          
                $antecedentOfertas = OfertaLaboral::whereIn('id', $antecedent)->get();
                $consequentOfertas = OfertaLaboral::whereIn('id', $consequent)->get();

                // Create recommendations
                $recommendations[] = [
                    'antecedent' => $antecedentOfertas->pluck('titulo')->implode(", "),
                    'consequent' => $consequentOfertas->pluck('titulo')->implode(", "),
                    'support' => $rule->getSupport(),
                    'confidence' => $rule->getConfidence(),
                ];
            }
        }


        // Guardar las recomendaciones en la base de datos
        if (!empty($recommendations)) {
            $recomendacionesCreado = RecomentOfertaLaboral::create([
                'user_id' => $userLogin->id,
                'ofertas_recomendadas' => json_encode($recommendations),  // Guardamos las recomendaciones como un JSON
            ]);
           
          
        } else {
          
        }
    }

    public function render()
    {
        return view('livewire.apriori-algoritmo');
    }
}
