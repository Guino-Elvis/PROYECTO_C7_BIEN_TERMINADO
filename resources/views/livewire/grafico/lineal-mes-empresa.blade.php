<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="lineaEmpresasGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('lineaEmpresasGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($meses) !!}, // Meses del año
            datasets: [{
                label: 'Empresas por Mes',
                data: {!! json_encode(array_values($empresasPorMes)) !!}, // Número de empresas por mes
                fill: false, // No rellenar el área debajo de la línea
                borderColor: 'rgba(54, 162, 235, 1)', // Color de la línea (Azul)
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
                            text: 'Número de Empresas'
                        },
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</div>
