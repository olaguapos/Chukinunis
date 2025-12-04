class ChartManager {
    constructor() {
        this.comparisonChart = null;
        this.init();
    }

    init() {
        this.createComparisonChart();
    }

    createComparisonChart() {
        const ctx = document.getElementById('comparison-chart').getContext('2d');
        
        this.comparisonChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Emisiones CO2 (kg)', 'Uso de agua (L)', 'Reciclabilidad (%)'],
                datasets: [
                    {
                        label: 'Producto Actual',
                        data: [0, 0, 0],
                        backgroundColor: 'rgba(46, 125, 50, 0.7)',
                        borderColor: 'rgba(46, 125, 50, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Promedio de Categoría',
                        data: [0, 0, 0],
                        backgroundColor: 'rgba(255, 152, 0, 0.7)',
                        borderColor: 'rgba(255, 152, 0, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mejor Opción',
                        data: [0, 0, 0],
                        backgroundColor: 'rgba(33, 150, 243, 0.7)',
                        borderColor: 'rgba(33, 150, 243, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Valores'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Comparación de Impacto Ambiental',
                        font: {
                            size: 16
                        }
                    },
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        window.comparisonChart = this.comparisonChart;
    }
}

// Inicializar el gestor de gráficas
document.addEventListener('DOMContentLoaded', () => {
    window.chartManager = new ChartManager();
});