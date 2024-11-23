@section('title', 'Dahsboard - General')
@section('header', 'Dahsboard')
@section('section', 'General')
<div>
    <div>
        <div class="grid sm:grid-cols-2 sm:gap-x-4 md:grid-cols-3 lg:md:grid-cols-4 xl:grid-cols-4">
            <a href="#" class="group">
                <x-card class="pt-0 px-0 hover:border-indigo-600 hover:scale-[1.02] duration-200">
                    <x-dashboard-content-card>
                        <x-slot name="title">Ofertas Laborales</x-slot>
                        <x-slot name="amount">{{ $totalOfertas }}</x-slot>
                        <x-slot name="porcentaje">
                            <span class="{{ $ofertasCrecimiento >= 0 ? 'text-green-300' : 'text-red-300' }}">
                                {{ $ofertasCrecimiento >= 0 ? '+' : '' }}{{ $ofertasCrecimiento }}%
                            </span>
                        </x-slot>
                    </x-dashboard-content-card>
                </x-card>
            </a>
            <a href="#" class="group">
                <x-card class="pt-0 px-0 hover:border-indigo-600 hover:scale-[1.02] duration-200">
                    <x-dashboard-content-card>
                        <x-slot name="title">Postulantes</x-slot>
                        <x-slot name="amount">{{ $totalPostulantes }}</x-slot>
                        <x-slot name="porcentaje">
                            <span class="{{ $postulantesCrecimiento >= 0 ? 'text-green-300' : 'text-red-300' }}">
                                {{ $postulantesCrecimiento >= 0 ? '+' : '' }}{{ $postulantesCrecimiento }}%
                            </span>
                        </x-slot>
                    </x-dashboard-content-card>
                </x-card>
            </a>
            <a href="#" class="group">
                <x-card class="pt-0 px-0 hover:border-indigo-600 hover:scale-[1.02] duration-200">
                    <x-dashboard-content-card>
                        <x-slot name="title">Empresas</x-slot>
                        <x-slot name="amount">{{ $totalEmpresas }}</x-slot>
                        <x-slot name="porcentaje">
                            <span class="{{ $empresasCrecimiento >= 0 ? 'text-green-300' : 'text-red-300' }}">
                                {{ $empresasCrecimiento >= 0 ? '+' : '' }}{{ $empresasCrecimiento }}%
                            </span>
                        </x-slot>
                    </x-dashboard-content-card>
                </x-card>
            </a>
            <a href="#" class="group">
                <x-card class="pt-0 px-0 hover:border-indigo-600 hover:scale-[1.02] duration-200">
                    <x-dashboard-content-card>
                        <x-slot name="title">Postulaciones</x-slot>
                        <x-slot name="amount">{{ $totalPostulaciones }}</x-slot>
                        <x-slot name="porcentaje">
                            <span class="{{ $postulacionesCrecimiento >= 0 ? 'text-green-300' : 'text-red-300' }}">
                                {{ $postulacionesCrecimiento >= 0 ? '+' : '' }}{{ $postulacionesCrecimiento }}%
                            </span>
                        </x-slot>
                    </x-dashboard-content-card>
                </x-card>
            </a>

        </div>

        <div class="grid sm:grid-cols-2 sm:gap-x-4 md:grid-cols-3 lg:md:grid-cols-4 xl:grid-cols-5">
            <div class="col-span-5">
                <div class="grid grid-cols-5 gap-4">
                    <x-card col="5">
                        <div class="flex flex-col">
                            <div class="text-sm text-center">
                                <div class="pb-3 border-b border-gray-300">
                                    Somos innovadores por excelencia
                                </div>
                                <div class="py-2">
                                    <h5 class="text-indigo-600 text-base font-medium mb-2 ">¡Bienvenido al sistema!</h5>
                                    <p class="text-gray-700">
                                        {{ Auth::user()->name }} -
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                                <div class="pt-3 border-t border-gray-300 text-gray-600 items-center">
                                    <div id="fecha"></div>
                                    <div id="tiempo"></div>
                                </div>ea
                            </div>
                            <div>
                                <div class="flex-1 bg-[#7AE2E2] rounded-lg p-1">
                                    <form id="scraping-form" class="flex flex-col w-full gap-2">
                                        <input
                                            class="w-full pr-4 py-2.5 rounded-lg text-sm text-gray-600 outline-none border border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-lg"
                                            type="text" id="link" name="link"
                                            value="https://www.bumeran.com.pe/" required>
                                        <button
                                            class="px-4 py-1 rounded-lg bg-gradient-to-r from-green-700 to-green-600 focus:from-green-700 focus:to-green-600 active:from-green-600 active:to-green-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg"
                                            type="submit">Iniciar Scraping</button>
                                        <button
                                            class="px-4 py-1 rounded-lg bg-gradient-to-r from-amber-700 to-yellow-600 focus:from-amber-700 focus:to-yellow-600 active:from-amber-600 active:to-yellow-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg"
                                            id="stop-button">Detener Scraping</button>
                                        <button
                                            class="px-4 py-1 rounded-lg bg-gradient-to-r from-red-700 to-red-600 focus:from-red-700 focus:to-red-600 active:from-red-600 active:to-red-600 text-sm text-white font-semibold tracking-wide cursor-pointer shadow-lg"
                                            id="shutdown-button">Apagar Servidor</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>
            {{-- remuneracion --}}
            <div class="col-span-5">
                <div class="grid grid-cols-5 gap-4">

                    <x-card col="2">

                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">Gráfico de Barras Remuneración
                            promedio por categoría</h3>
                        <!-- Line Chart -->
                        <div class="w-full overflow-auto"style="max-width: 589px; max-height: 420px;">
                            <livewire:grafico.barra-remuneracion-category />
                        </div>

                    </x-card>
                    <x-card col="2">
                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">
                            Gráfico de Barras Remuneración promedio por región
                        </h3>
                        <!-- Line Chart -->
                        <div class="w-full overflow-auto" style="max-width: 589px; max-height: 420px;">
                            <livewire:grafico.barra-remuneracion-region />
                        </div>
                    </x-card>

                    <x-card col="1">

                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">Gráfico Circular Estados de las
                            postulaciones</h3>
                        <!-- Line Chart -->
                        <div class="w-full" style="height: 395px;">
                            <livewire:grafico.circular-postulacion />
                        </div>

                    </x-card>
                </div>
            </div>
            {{-- end remuneracion --}}

            {{-- Ofertas Laborales por mes --}}
            <div class="col-span-5">
                <div class="grid grid-cols-10 gap-5">
                    <x-card col="5">

                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">Gráfico de Barras Ofertas
                            Laborales
                            por mes</h3>
                        <!-- Line Chart -->
                        <div class="w-auto">
                            <livewire:grafico.barra-oferta-laboral />
                        </div>

                    </x-card>
                    <x-card col="5">

                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">Gráfico Lineal Crecimiento de
                            postulantes</h3>
                        <!-- Line Chart -->
                        <div class="w-auto">
                            <livewire:grafico.lineal-mes-postulante />
                        </div>
                    </x-card>
                </div>
            </div>
            {{-- end Ofertas Laborales por mes --}}

            {{-- Barras Ofertas Laborales por mes --}}
            <div class="col-span-5">
                <div class="grid grid-cols-10 gap-5">
                    <x-card col="5">

                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">Gráfico de Barras de postulaciones mes</h3>
                        <!-- Line Chart -->
                        <div class="w-auto">
                            <livewire:grafico.barra-postulacion />
                        </div>

                    </x-card>
                    <x-card col="5">

                        <h3 class="text-xl font-bold leading-none text-gray-900 me-1">Gráfico Lineal Crecimiento de
                            empresas
                        </h3>
                        <!-- Line Chart -->
                        <div class="w-auto">
                            <livewire:grafico.lineal-mes-empresa />
                        </div>
                    </x-card>
                </div>
            </div>
            {{-- end Barras Ofertas Laborales por mes --}}
        </div>
    </div>
</div>
<script>
    document.getElementById('scraping-form').addEventListener('submit', async (event) => {
        event.preventDefault();
        const link = document.getElementById('link').value;

        try {
            const response = await fetch('http://localhost:3000/start-scraping', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    link_web: link
                })
            });
            const message = await response.text();
            alert(message);
        } catch (error) {
            console.error('Error al iniciar el scraping:', error);
        }
    });

    document.getElementById('stop-button').addEventListener('click', async () => {
        try {
            const response = await fetch('http://localhost:3000/stop-scraping', {
                method: 'POST',
            });
            const message = await response.text();
            alert(message);
        } catch (error) {
            console.error('Error al detener el scraping:', error);
        }
    });

    document.getElementById('shutdown-button').addEventListener('click', async () => {
        try {
            const response = await fetch('http://localhost:3000/shutdown-server', {
                method: 'POST',
            });
            const message = await response.text();
            alert(message);
            // Opcional: Redirige a otra página o muestra un mensaje de cierre
        } catch (error) {
            console.error('Error al apagar el servidor:', error);
        }
    });
</script>
@section('page-script')
    <script>
        const getChartOptions = () => {
            return {
                series: [4, 15, 40, 4, 1],
                colors: ["#1C64F2", "#16BDCA", "#f59e0b", "#9061F9", "#65a30d"],
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: ["Categorias", "Sub-Categorias", "Productos", "Banners", "Usuarios"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + ""
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + ""
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }

        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            chart.render();
        }
    </script>

    <script>
        setInterval(function() {
            var fechaActual = new Date();
            var dia = new Intl.DateTimeFormat("es", {
                weekday: "long"
            }).format(fechaActual);
            var mes = new Intl.DateTimeFormat("es", {
                month: "long"
            }).format(fechaActual);
            var anio = fechaActual.getFullYear();
            document.getElementById("fecha").innerHTML = dia + " " + fechaActual.getDate() + " de " + mes + " de " +
                anio;
        }, 1000);
    </script>
@endsection
