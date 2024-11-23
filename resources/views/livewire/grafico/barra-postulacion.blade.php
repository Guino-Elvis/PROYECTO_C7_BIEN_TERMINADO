<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="barrasPostulacionesGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('barrasPostulacionesGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($meses) !!}, // Meses del año
            datasets: [
                {
                    label: 'Aprobadas',
                    data: {!! json_encode(array_values($ap)) !!}, // Datos de postulaciones aprobadas
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color para las postulaciones aprobadas
                    borderColor: 'rgba(255, 99, 132, 1)', // Borde de las barras (rojo)
                    borderWidth: 1
                },
                {
                    label: 'Pendientes',
                    data: {!! json_encode(array_values($pe)) !!}, // Datos de postulaciones pendientes
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color para las postulaciones pendientes
                    borderColor: 'rgba(54, 162, 235, 1)', // Borde de las barras (azul)
                    borderWidth: 1
                },
                {
                    label: 'Rechazadas',
                    data: {!! json_encode(array_values($re)) !!}, // Datos de postulaciones rechazadas
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Color para las postulaciones rechazadas
                    borderColor: 'rgba(255, 159, 64, 1)', // Borde de las barras (amarillo)
                    borderWidth: 1
                }
            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico: Barras
            data: data,
            options: {
                responsive: true,
                plugins: {
                    tooltip: { enabled: true },
                    legend: { display: true }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Meses'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Postulaciones'
                        }
                    }
                }
            }
        });
    </script>
</div>
