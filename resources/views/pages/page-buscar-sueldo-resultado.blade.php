







-------------------------------------------------------------------------------------
<h2>Promedio de Remuneración para la Categoría {{ $categoriaSeleccionada }}</h2>
@if($promedioRemuneracion)
    <p>El promedio de la remuneración para esta categoría es: S/ {{ number_format($promedioRemuneracion, 2) }}</p>
@else
    <p>No hay ofertas disponibles para calcular el promedio de remuneración.</p>
@endif


<h1>Resultados de búsqueda</h1>

{{-- Ofertas por categoría y localidad --}}
@if($ofertas->isEmpty())
    <p>No se encontraron ofertas laborales para esta categoría y localidad.</p>
@else
    <h2>Ofertas Encontradas</h2>
    <ul>
        @foreach($ofertas as $oferta)
            <li>
                <strong>{{ $oferta->titulo }}</strong><br>
                <strong>{{ $oferta->category->name }}</strong><br>
                Remuneración: {{ $oferta->remuneracion }}<br>
                Ubicación: 
                {{ $oferta->departamento->name ?? '' }}
                {{ $oferta->provincia->name ?? '' }}
                {{ $oferta->distrito->name ?? '' }}<br>
                Descripción: {{ Str::limit($oferta->descripcion, 100) }}<br>
                <a href="">Ver más detalles</a>
            </li>
        @endforeach
    </ul>
@endif

{{-- Ofertas similares por categoría y ubicación --}}
<h2>Ofertas Similares por Categoría y Ubicación</h2>
@if($similares->isEmpty())
    <p>No se encontraron ofertas similares para esta categoría y localidad.</p>
@else
    <ul>
        @foreach($similares as $oferta)
            <li>
                <strong>{{ $oferta->titulo }}</strong><br>
                <strong>{{ $oferta->category->name }}</strong><br>
                Remuneración: {{ $oferta->remuneracion }}<br>
                Ubicación: 
                {{ $oferta->departamento->name ?? '' }}
                {{ $oferta->provincia->name ?? '' }}
                {{ $oferta->distrito->name ?? '' }}<br>
                <a href="">Ver más detalles</a>
            </li>
        @endforeach
    </ul>
@endif

{{-- Ofertas recomendadas por remuneración --}}
<h2>Recomendaciones: Ofertas por Mejor Remuneración</h2>
@if($recomendaciones->isEmpty())
    <p>No se encontraron ofertas recomendadas basadas en la categoria y  remuneración.</p>
@else
    <ul>
        @foreach($recomendaciones as $oferta)
            <li>
                <strong>{{ $oferta->titulo }}</strong><br>
                <strong>{{ $oferta->category->name }}</strong><br>
                Remuneración: {{ $oferta->remuneracion }}<br>
                Ubicación: 
                {{ $oferta->departamento->name ?? '' }}
                {{ $oferta->provincia->name ?? '' }}
                {{ $oferta->distrito->name ?? '' }}<br>
                <a href="">Ver más detalles</a>
            </li>
        @endforeach
    </ul>
@endif

<h2>Ofertas que te pueden gustar</h2>
@if($ofertasSugeridas->isEmpty())
    <p>No se encontraron ofertas recomendadas basadas en tus intereses.</p>
@else
    <ul>
        @foreach($ofertasSugeridas as $oferta)
            <li>
                <strong>{{ $oferta->titulo }}</strong><br>
                <strong>{{ $oferta->category->name }}</strong><br>

                Remuneración: {{ $oferta->remuneracion }}<br>
                Ubicación: 
                {{ $oferta->departamento->name ?? '' }}
                {{ $oferta->provincia->name ?? '' }}
                {{ $oferta->distrito->name ?? '' }}<br>
                <a href="">Ver más detalles</a>
            </li>
        @endforeach
    </ul>
@endif