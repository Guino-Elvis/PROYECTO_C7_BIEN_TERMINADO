<div class="flex flex-col ">
    <div class="bg-white  w-full h-52 justify-center items-start flex border-b relative">
        <div class="bg-blue-900 rounded-br-[4.5rem] flex w-full h-36 "></div>
        <div class="justify-center items-center flex w-full flex-col absolute">
            <div class="w-7/12 flex justify-center items-start flex-col gap-2 pl-10 pb-6 pt-8">
                <div class="text-2xl font-bold text-white">
                    Sigue una carrera profesional que disfrutarás
                </div>
            </div>
            <div class="w-7/12 flex justify-center items-center">
                <div
                    class="w-full flex justify-between flex-wrap lg:flex-nowrap xl:flex-nowrap md:flex-wrap sm:flex-wrap  text-lg gap-4  bg-white rounded-md py-4 px-4">

                    <div class="flex flex-col w-6/12">
                        <div class=" flex flex-col gap-2 w-6/6">
                            <samp class="font-bold text-xl">Que</samp>
                            <input type="search" wire:model="search"
                                placeholder="Título del empleo, palabras clave o empresa"
                                class="w-full  rounded-lg   text-ellipsis">
                        </div>
                        @if ($search && $search !== $categoriaSeleccionada && empty($categorias))
                            <div class="relative">
                                <div class="w-6/6 absolute bg-white px-10 py-4 rounded-md">
                                    <p>No se encontraron resultados.</p>
                                </div>
                            </div>
                        @endif

                        @if ($search && $search !== $categoriaSeleccionada && !empty($categorias))
                            <div class="relative">
                                <div class="w-6/6 h-40 overflow-auto absolute bg-white px-10 py-4 rounded-md">
                                    <ul>
                                        @foreach ($categorias as $categoria)
                                            <li class="cursor-pointer"
                                                wire:click="selectCategoria('{{ $categoria->name }}')">
                                                <strong>{{ $categoria->name }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col w-6/12">
                        <div class="flex flex-col gap-2 w-6/6">
                            <samp class="font-bold text-xl">Donde</samp>
                            <div class="flex justify-between gap-4 ">
                                <input type="search" wire:model="searchUbi"
                                    placeholder="Título del empleo, palabras clave o empresa"
                                    class="w-4/6  rounded-lg   text-ellipsis">
                                <button wire:click="redirectOtraClase"
                                    class="w-2/6 px-6 bg-[#164081] font-bold text-white rounded-md">
                                    Buscar
                                </button>
                            </div>
                        </div>
                        @if ($searchUbi && $searchUbi !== $localidadSeleccionada && empty($localidades))
                            <div class="relative">
                                <div class="w-6/6 absolute bg-white px-10 py-4 rounded-md">
                                    <p>No se encontraron resultados.</p>
                                </div>
                            </div>
                        @endif

                        @if ($searchUbi && $searchUbi !== $localidadSeleccionada && !empty($localidades))
                            <div class="relative">
                                <div class="w-6/6 h-40 overflow-auto absolute bg-white px-10 py-4 rounded-md">
                                    <ul>
                                        @foreach ($localidades as $localidad)
                                            <li class="cursor-pointer"
                                                wire:click="selectLocalidad('{{ $localidad['name'] }}')">
                                                {{ $localidad['type'] }}: {{ $localidad['name'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class=" bg-white  justify-center items-center flex w-full flex-col ">
        <div class="w-7/12 flex justify-center items-start flex-col  pb-10">
            <div class="flex flex-row justify-center items-center text-xs py-5 gap-1 text-blue-500">
                <a href="" class="">Inicio</a>
                <i class=" fa-solid fa-angle-right fa-xs"></i>
                <a href="">Explorador de empleos</a>
                <i class=" fa-solid fa-angle-right fa-xs"></i>
                <a href="">{{ $categoriaSeleccionada ?? '' }}</a>
                <i class=" fa-solid fa-angle-right fa-xs"></i>
                <a href="">{{ $localidadSeleccionada ?? '' }}</a>
            </div>
            <div class="text-xl font-bold text-black tracking-wider">
                Sueldo de {{ $categoriaSeleccionada ?? '' }} en {{ $localidadSeleccionada ?? '' }}
            </div>
            <div class="text-xs font-bold text-gray-500">
                ¿Cuánto se gana como uno {{ $categoriaSeleccionada ?? '' }} en {{ $localidadSeleccionada ?? '' }}?
            </div>
            <div class="bg-orange-50 rounded-lg justify-center items-start flex flex-col my-4 px-8 py-10 w-full">
                <div class="text-md  text-gray-900">
                    Sueldo base promedio
                </div>
                <div class="flex-row flex gap-4 justify-center items-center">
                    <div class="text-[3rem] font-extrabold text-black ">
                        @if ($promedioRemuneracion)
                            S/ {{ number_format($promedioRemuneracion, 2) }}
                        @else
                            00.0
                        @endif
                    </div>
                    <div>por mes</div>
                </div>
            </div>
            <div class="text-xs font-bold text-gray-500">
                El sueldo promedio para {{ $categoriaSeleccionada ?? '' }} es de S/
                {{ number_format($promedioRemuneracion, 2) ?? '' }} por mes en {{ $localidadSeleccionada ?? '' }}.
                56 sueldos
                publicados.
                Actualizado en 12 de noviembre de 2024
            </div>
            <div class="text-xl font-bold text-black ">
                Ofertas de empleo en {{ $localidadSeleccionada ?? '' }}
            </div>


            <!-- component -->
            <div class="w-full bg-white mt-4">
                <div class="w-full relative flex items-center justify-center">
                    <button aria-label="slide backward"
                        class="absolute z-30 left-0 ml-10 focus:outline-none rounded-full px-4 py-4 focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 cursor-pointer"
                        id="prev">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>
            
                    <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
                        <div id="slider"
                            class="h-full w-12/12 flex lg:gap-8 md:gap-6 gap-14 items-center justify-start transition ease-out duration-700">
                            @if($ofertas->isEmpty())
                                <div class="flex justify-center items-center w-full">
                                    <div class="text-center text-lg text-gray-500">
                                        <p>No se encontraron ofertas laborales.</p>
                                    </div>
                                </div>
                            @else
                                @foreach ($ofertas as $oferta)
                                    <div class="flex w-full flex-shrink-0 relative sm:w-auto rounded-lg bg-white border">
                                        <div class="max-w-[22rem] h-[20rem] px-6 py-4 rounded-lg flex flex-col justify-between">
                                            <div class="flex flex-row gap-4 pb-10">
                                                <div>
                                                    <div class="text-md font-extrabold text-black w-52">
                                                        {{ $oferta->titulo ?? '' }}
                                                    </div>
                                                    <div class="text-sm text-gray-400">
                                                        {{ $oferta->empresa->ra_social ?? '' }}
                                                    </div>
                                                    <div class="text-sm text-gray-400 pb-2 flex flex-wrap">
                                                        {{ $oferta->departamento->name ?? '' }},
                                                        {{ $oferta->provincia->name ?? '' }},
                                                        {{ $oferta->distrito->name ?? '' }}
                                                    </div>
                                                    <span class="flex justify-start items-center text-sm gap-2">
                                                        <i class="fa-solid fa-briefcase"></i>
                                                        <div class="max-w-40 font-bold">
                                                            {{ $oferta->category->name ?? '' }}
                                                        </div>
                                                    </span>
                                                    <span class="flex justify-start items-center text-sm gap-2">
                                                        <i class="fa-solid fa-sack-dollar"></i>
                                                        <div class="max-w-40 font-bold">
                                                            s/ {{ $oferta->remuneracion ?? '' }}
                                                        </div>
                                                    </span>
                                                </div>
                                                <div class="w-28 flex justify-end items-start">
                                                    <img src="{{ $oferta->empresa->image ? Storage::url($oferta->empresa->image->url) : '/img/no_imagen.jpg' }}"
                                                        class="max-w-[4rem] rounded-md" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div
                                                    class="bg-white border rounded-md py-2 justify-center items-center flex mb-2 hover:bg-blue-100 hover:border-blue-400 duration-300">
                                                    <h4 class="text-cyan-500 font-bold">View job details</h4>
                                                </div>
                                                <div class="flex flex-row gap-2 text-xs text-gray-400 pb-2">
                                                    <div>
                                                        <i class="fa-regular fa-calendar fa-xs"></i>
                                                        {{ \Carbon\Carbon::parse($oferta->created_at)->format('d-m-Y') ?? '' }}
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock fa-xs"></i>
                                                        {{ \Carbon\Carbon::parse($oferta->created_at)->format('H:i:s') ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
            
                    <button aria-label="slide forward"
                        class="absolute z-30 right-0 mr-10 rounded-full px-4 py-4 focus:outline-none focus:bg-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400"
                        id="next">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
            <div class="w-full h-0.5 bg-gray-300 my-10"></div>
            <div class="flex flex-col w-full py-10">
                <div class="text-xl font-bold text-black ">
                    Ofertas de empleo similares recomendadas con mayor sueldo para {{ $categoriaSeleccionada ?? '' }}.
                </div>
                <div class="w-full flex flex-wrap  gap-4">

                    @if ($similares->isEmpty())
                        <p>No se encontraron ofertas similares recomendadas con mayor sueldo para esta categoría y
                            localidad.</p>
                    @else
                        @foreach ($similares as $oferta)
                        <div class="flex w-full flex-shrink-0 relative  sm:w-auto   rounded-lg bg-white border ">
                            <div class="max-w-[22rem] px-6 py-4  rounded-lg flex flex-col justify-between">
                                <div class="flex flex-row gap-4 pb-10">
                                    <div>
                                        <div class="text-md font-extrabold text-black w-52">
                                            {{ $oferta->titulo ?? '' }}</div>
                                        <div class="text-sm  text-gray-400">
                                            {{ $oferta->empresa->ra_social ?? '' }}
                                        </div>
                                        <div class="text-sm  text-gray-400 pb-2 flex flex-wrap">
                                            {{ $oferta->departamento->name ?? '' }},
                                            {{ $oferta->provincia->name ?? '' }},
                                            {{ $oferta->distrito->name ?? '' }}

                                        </div>
                                        <span class="flex justify-start items-center text-sm gap-2">
                                            <i class="fa-solid fa-briefcase"></i>
                                            <div class=" max-w-40 font-bold">
                                                {{ $oferta->category->name ?? '' }}
                                            </div>
                                        </span>
                                        <span class="flex justify-start items-center text-sm gap-2">
                                            <i class="fa-solid fa-sack-dollar"></i>
                                            <div class=" max-w-40 font-bold">
                                                s/ {{ $oferta->remuneracion ?? '' }}
                                            </div>
                                        </span>
                                    </div>
                                    <div class="w-28 flex justify-end items-start">
                                        <img src="{{ $oferta->empresa->image ? Storage::url($oferta->empresa->image->url) : '/img/no_imagen.jpg' }}"
                                            class="max-w-[4rem] rounded-md" alt="">
                                    </div>
                                </div>
                                <div>
                                    <div
                                        class="bg-white border rounded-md py-2 justify-center items-center flex mb-2 hover:bg-blue-100 hover:border-blue-400 duration-300">
                                        <h4 class="text-cyan-500 font-bold"> View job details</h4>
                                    </div>

                                    <div class="flex flex-row gap-2 text-xs  text-gray-400 pb-2">
                                        <div>
                                            <i class="fa-regular fa-calendar fa-xs"></i>
                                            {{ \Carbon\Carbon::parse($oferta->created_at)->format('d-m-Y') ?? '' }}
                                        </div>
                                        <div>
                                            <i class="fa-regular fa-clock fa-xs"></i>
                                            {{ \Carbon\Carbon::parse($oferta->created_at)->format('H:i:s') ?? '' }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex  flex-col gap-4 w-full py-10">
                <div class="text-xl font-bold text-black ">
                    Ofertas de empleo recomendadas para {{ $categoriaSeleccionada ?? '' }} en otras partes
                    del Perú.
                </div>
                <div class="flex flex-wrap gap-2">

                    @if ($recomendaciones->isEmpty())
                        <p>No se encontraron ofertas recomendadas en otras partes
                            del Perú.</p>
                    @else
                        @foreach ($recomendaciones as $oferta)
                            <div class="flex w-full flex-shrink-0 relative  sm:w-auto   rounded-lg bg-white border ">
                                <div class="max-w-[22rem] px-6 py-4  rounded-lg flex flex-col justify-between">
                                    <div class="flex flex-row gap-4 pb-10">
                                        <div>
                                            <div class="text-md font-extrabold text-black w-52">
                                                {{ $oferta->titulo ?? '' }}</div>
                                            <div class="text-sm  text-gray-400">
                                                {{ $oferta->empresa->ra_social ?? '' }}
                                            </div>
                                            <div class="text-sm  text-gray-400 pb-2 flex flex-wrap">
                                                {{ $oferta->departamento->name ?? '' }},
                                                {{ $oferta->provincia->name ?? '' }},
                                                {{ $oferta->distrito->name ?? '' }}

                                            </div>
                                            <span class="flex justify-start items-center text-sm gap-2">
                                                <i class="fa-solid fa-briefcase"></i>
                                                <div class=" max-w-40 font-bold">
                                                    {{ $oferta->category->name ?? '' }}
                                                </div>
                                            </span>
                                            <span class="flex justify-start items-center text-sm gap-2">
                                                <i class="fa-solid fa-sack-dollar"></i>
                                                <div class=" max-w-40 font-bold">
                                                    s/ {{ $oferta->remuneracion ?? '' }}
                                                </div>
                                            </span>
                                        </div>
                                        <div class="w-28 flex justify-end items-start">
                                            <img src="{{ $oferta->empresa->image ? Storage::url($oferta->empresa->image->url) : '/img/no_imagen.jpg' }}"
                                                class="max-w-[4rem] rounded-md" alt="">
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="bg-white border rounded-md py-2 justify-center items-center flex mb-2 hover:bg-blue-100 hover:border-blue-400 duration-300">
                                            <h4 class="text-cyan-500 font-bold"> View job details</h4>
                                        </div>

                                        <div class="flex flex-row gap-2 text-xs  text-gray-400 pb-2">
                                            <div>
                                                <i class="fa-regular fa-calendar fa-xs"></i>
                                                {{ \Carbon\Carbon::parse($oferta->created_at)->format('d-m-Y') ?? '' }}
                                            </div>
                                            <div>
                                                <i class="fa-regular fa-clock fa-xs"></i>
                                                {{ \Carbon\Carbon::parse($oferta->created_at)->format('H:i:s') ?? '' }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex  flex-col gap-4 w-full py-10">
                <div class="text-xl font-bold text-black ">
                    Ofertas de empleo recomendadas basadas en tus intereses.
                </div>
                <div class="flex flex-wrap gap-2">

                    @if ($ofertasSugeridas->isEmpty())
                        <p>No se encontraron ofertas recomendadas basadas en tus intereses.</p>
                    @else
                        @foreach ($ofertasSugeridas as $oferta)
                            <div class="flex w-full flex-shrink-0 relative  sm:w-auto   rounded-lg bg-white border ">
                                <div class="max-w-[22rem] px-6 py-4  rounded-lg flex flex-col justify-between">
                                    <div class="flex flex-row gap-4 pb-10">
                                        <div>
                                            <div class="text-md font-extrabold text-black w-52">
                                                {{ $oferta->titulo ?? '' }}</div>
                                            <div class="text-sm  text-gray-400">
                                                {{ $oferta->empresa->ra_social ?? '' }}
                                            </div>
                                            <div class="text-sm  text-gray-400 pb-2 flex flex-wrap">
                                                {{ $oferta->departamento->name ?? '' }},
                                                {{ $oferta->provincia->name ?? '' }},
                                                {{ $oferta->distrito->name ?? '' }}

                                            </div>
                                            <span class="flex justify-start items-center text-sm gap-2">
                                                <i class="fa-solid fa-briefcase"></i>
                                                <div class=" max-w-40 font-bold">
                                                    {{ $oferta->category->name ?? '' }}
                                                </div>
                                            </span>
                                            <span class="flex justify-start items-center text-sm gap-2">
                                                <i class="fa-solid fa-sack-dollar"></i>
                                                <div class=" max-w-40 font-bold">
                                                    s/ {{ $oferta->remuneracion ?? '' }}
                                                </div>
                                            </span>

                                        </div>
                                        <div class="w-28 flex justify-end items-start">
                                            <img src="{{ $oferta->empresa->image ? Storage::url($oferta->empresa->image->url) : '/img/no_imagen.jpg' }}"
                                                class="max-w-[4rem] rounded-md" alt="">
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="bg-white border rounded-md py-2 justify-center items-center flex mb-2 hover:bg-blue-100 hover:border-blue-400 duration-300">
                                            <h4 class="text-cyan-500 font-bold"> View job details</h4>
                                        </div>

                                        <div class="flex flex-row gap-2 text-xs  text-gray-400 pb-2">
                                            <div>
                                                <i class="fa-regular fa-calendar fa-xs"></i>
                                                {{ \Carbon\Carbon::parse($oferta->created_at)->format('d-m-Y') ?? '' }}
                                            </div>
                                            <div>
                                                <i class="fa-regular fa-clock fa-xs"></i>
                                                {{ \Carbon\Carbon::parse($oferta->created_at)->format('H:i:s') ?? '' }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    let defaultTransform = 0;

    function goNext() {
        defaultTransform = defaultTransform - 398;
        var slider = document.getElementById("slider");
        if (Math.abs(defaultTransform) >= slider.scrollWidth / 1.7)
            defaultTransform = 0;
        slider.style.transform = "translateX(" + defaultTransform + "px)";
    }
    next.addEventListener("click", goNext);

    function goPrev() {
        var slider = document.getElementById("slider");
        if (Math.abs(defaultTransform) === 0) defaultTransform = 0;
        else defaultTransform = defaultTransform + 398;
        slider.style.transform = "translateX(" + defaultTransform + "px)";
    }
    prev.addEventListener("click", goPrev);
</script>
