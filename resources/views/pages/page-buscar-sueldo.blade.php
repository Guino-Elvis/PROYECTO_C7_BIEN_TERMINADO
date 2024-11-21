<div class="flex flex-col contenedorDiv">
    <div class=" gradiante  justify-center items-center flex w-full flex-col">

        <div class="w-8/12 flex justify-center items-start flex-col gap-2 pb-10">
            <samp class="text-2xl font-bold text-white">
                Descubre tu potencial de ingresos
            </samp>
            <samp class="text-md font-bold text-white">
                Explora carreras profesionales bien remuneradas, sueldos y ofertas de empleo por sector y ubicación.
            </samp>
        </div>
        <div class="w-8/12 flex justify-center items-center">
            <div
                class="w-full flex justify-between flex-wrap lg:flex-nowrap xl:flex-nowrap md:flex-wrap sm:flex-wrap  text-lg gap-4  bg-white rounded-md py-4 px-4">

                <div class="flex flex-col w-6/12">
                    <div class=" flex flex-col gap-2 w-6/6">
                        <samp class="font-bold text-xl">Que</samp>
                        <input type="search" wire:model="search"
                            placeholder="Título del empleo, palabras clave o empresa"
                            class="w-full  rounded-lg   text-ellipsis">
                    </div>
                    @if ($search)
                        <div class="relative">
                            <div class="w-6/6 h-40 overflow-auto absolute bg-white px-10 py-4 rounded-md">
                                @if (!empty($categorias))
                                    <ul>
                                        @foreach ($categorias as $categoria)
                                            <li class="cursor-pointer"
                                                wire:click="selectCategoria('{{ $categoria->name }}')">
                                                <strong>{{ $categoria->name }}</strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No se encontraron resultados.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <samp></samp>
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
                    @if ($searchUbi)
                        <div class="relative">
                            <div class="w-6/6 h-40 overflow-auto absolute bg-white px-10 py-4 rounded-md">
                                @if (!empty($localidades))
                                    <ul>
                                        @foreach ($localidades as $localidad)
                                            <li class="cursor-pointer"
                                                wire:click="selectLocalidad('{{ $localidad['name'] }}')">
                                                {{ $localidad['name'] }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p>No se encontraron resultados.</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <samp></samp>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .contenedorDiv {
        position: relative;
        width: 100%;
        height: 100vh;
        background-image: url('/img/salaraio_fondo.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
    }

    .gradiante {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: rgba(19, 34, 71, 0.801);
    }
</style>
