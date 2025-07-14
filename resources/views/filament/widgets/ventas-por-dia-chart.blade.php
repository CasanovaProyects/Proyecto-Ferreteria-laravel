<x-filament::widget>
    <div class="p-6">
        <h3 class="text-lg font-bold mb-4">Ventas por Día (últimos 30 días)</h3>
        <canvas id="ventasPorDiaChart" height="100"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('ventasPorDiaChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($this->getData()['labels']),
                    datasets: [
                        {
                            label: 'Cantidad de Ventas',
                            data: @json($this->getData()['data']),
                            backgroundColor: 'rgba(255, 107, 53, 0.7)',
                            borderColor: 'rgba(255, 107, 53, 1)',
                            borderWidth: 2,
                        },
                        {
                            label: 'Total Vendido ($)',
                            data: @json($this->getData()['totales']),
                            type: 'line',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderWidth: 2,
                            yAxisID: 'y1',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: { mode: 'index', intersect: false },
                    stacked: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Cantidad de Ventas' }
                        },
                        y1: {
                            beginAtZero: true,
                            position: 'right',
                            grid: { drawOnChartArea: false },
                            title: { display: true, text: 'Total Vendido ($)' }
                        }
                    }
                }
            });
        });
    </script>
</x-filament::widget>
