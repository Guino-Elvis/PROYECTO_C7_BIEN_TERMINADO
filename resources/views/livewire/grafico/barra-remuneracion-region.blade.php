<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="barrasRemuneracionRegionGrafica" width="700" height="400"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('barrasRemuneracionRegionGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($regiones) !!}, // Nombres de las regiones
            datasets: [{
                label: 'Remuneración Promedio por Región',
                data: {!! json_encode(array_values($remuneracionPromedio)) !!}, // Promedio de remuneración por región
                backgroundColor: 'rgba(153, 102, 255, 0.2)', // Color de las barras
                borderColor: 'rgba(153, 102, 255, 1)', // Borde de las barras
                borderWidth: 1 // Ancho del borde de las barras
            }]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico: barras
            data: data,
            options: {
                responsive: false, // Desactiva el redimensionamiento automático
                maintainAspectRatio: false, // Desactiva mantener el aspecto
                plugins: {
                    tooltip: { enabled: true },
                    legend: { display: true }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Región'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Remuneración Promedio'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toFixed(2); // Formatear la remuneración con símbolo de dólar
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>
