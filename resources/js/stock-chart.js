import { format } from "date-fns";

export function initStockChart(chartData, symbol) {
    const ctx = document.getElementById('myChart');
    
    if (!ctx) return;

    new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: chartData.map(item => item.date),
            datasets: [{
                label: `${symbol} Koers`,
                data: chartData.map(item => item.price),
                backgroundColor: 'rgba(86, 186, 154, 0.1)',
                borderColor: 'rgba(86, 186, 154, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return'$' + context.parsed.y.toFixed(2);
                        }
                    }
                }
            },
            elements: {
                point: {
                    radius: 0,
                    hoverRadius: 5,
                    hoverBorderWidth: 2
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    type: 'time',
                    time: {
                        unit: 'month',
                        tooltipFormat: 'dd MMM yyyy',
                        displayFormats: {
                            month: 'MMM'                        }
                    }                    
                },
                y: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toFixed(2);
                        }
                    }
                }
            }
        },
    });
}
