<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="lineaGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('lineaGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($meses) !!}, // Meses del año
            datasets: [{
                label: 'Postulantes por Mes',
                data: {!! json_encode(array_values($postulantesPorMes)) !!}, // Número de postulantes por mes
                fill: false, // No rellenar el área debajo de la línea
                borderColor: 'rgba(75, 192, 192, 1)', // Color de la línea (Verde)
                borderWidth: 2, // Ancho de la línea
                tension: 0.4, // Curvatura de la línea
            }]
        };

        var myLineChart = new Chart(ctx, {
            type: 'line', // Tipo de gráfico (línea)
            data: data,
            options: {
                responsive: true,
                plugins: {
                    tooltip: { enabled: true },
                    legend: { display: true }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Meses'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Número de Postulantes'
                        },
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</div>
