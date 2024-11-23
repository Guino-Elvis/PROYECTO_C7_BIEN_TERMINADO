<div>
    <div style="max-width: 700px; height: auto">
        <canvas id="barrasGrafica"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('barrasGrafica').getContext('2d');

        var data = {
            labels: {!! json_encode($meses) !!}, // Etiquetas para los meses
            datasets: [
                {
                    label: 'Ofertas Escondidas',
                    data: {!! json_encode(array_values($escondido)) !!}, // Datos de ofertas escondidas
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color para las ofertas escondidas (Rojo)
                    borderColor: 'rgba(255, 99, 132, 1)', // Color para el borde de las barras (Rojo)
                    borderWidth: 1 // Ancho del borde de las barras
                },
                {
                    label: 'Ofertas Visibles',
                    data: {!! json_encode(array_values($visible)) !!}, // Datos de ofertas visibles
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color para las ofertas visibles (Azul)
                    borderColor: 'rgba(54, 162, 235, 1)', // Color para el borde de las barras (Azul)
                    borderWidth: 1 // Ancho del borde de las barras
                }
            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico (barras)
            data: data,
            options: {
                responsive: true,
                plugins: {
                    tooltip: { enabled: true },
                    legend: { display: true }
                },
                scales: {
                    x: {
                        stacked: true, // Habilitar apilamiento en el eje X
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Meses'
                        }
                    },
                    y: {
                        stacked: true, // Habilitar apilamiento en el eje Y
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Número de Ofertas'
                        }
                    }
                }
            }
        });
    </script>
</div>