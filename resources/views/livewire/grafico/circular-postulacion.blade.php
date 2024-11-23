<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="circularGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
        var ctx = document.getElementById('circularGrafica').getContext('2d');

        var data = {
            labels: ['PE', 'AP', 'RE'], // Etiquetas de los estados
            datasets: [
                {
                label: 'Estados de Postulaciones',
                data: [
                 
                    {!! json_encode($estadoPostulaciones['PE'] ?? 0) !!}, // Pendientes
                    {!! json_encode($estadoPostulaciones['AP'] ?? 0) !!}, // Aceptadas
                    {!! json_encode($estadoPostulaciones['RE'] ?? 0) !!} // Rechazadas
             
                
                ],
                backgroundColor: [
                    'rgba(0, 204, 255, 0.9)', // Celeste para "Pendientes"
                    'rgba(0, 255, 128, 0.9)', // Jade para "Aceptadas"
                    'rgba(255, 105, 180, 0.9)'  // Rosa para "Rechazadas"
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)', // Borde para "Pendientes"
                    'rgba(75, 192, 192, 1)', // Borde para "Aceptadas"
                    'rgba(255, 99, 132, 1)'  // Borde para "Rechazadas"
                ],
                borderWidth: 1, // Ancho del borde del anillo exterior
               
            }]
        };

        var myPieChart = new Chart(ctx, {
            type: 'doughnut', // Tipo de gráfico: Doughnut (rosquilla)
            data: data,
            options: {
                responsive: true,
                cutout: '80%', 
                plugins: {
                    tooltip: { enabled: true }, // Activar tooltips
                    legend: {
                        position: 'top',
                        labels: {
                            font: { size: 14 }
                        }
                    },
                    datalabels: {
                        color: 'white', // Color de las etiquetas
                        anchor: 'end', // Alineación de las etiquetas
                        align: 'end',  // Alineación final de las etiquetas
                        offset: 10,    // Desplazamiento de las etiquetas
                        font: {
                            weight: 'bold' // Fuente en negrita para las etiquetas
                        }
                    }
                }
            }
        });
    </script>
</div>
