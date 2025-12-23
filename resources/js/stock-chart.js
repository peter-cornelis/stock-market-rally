import { format } from "date-fns";

export function initStockChart(chartData, symbol) {
    const ctx = document.getElementById('myChart');
    
    if (!ctx) return;

    return new Chart(ctx.getContext('2d'), {
        type: 'line',
        data: {
            labels: chartData.map(item => item.date),
            datasets: [{
                label: `${symbol} Koers`,
                data: chartData.map(item => item.price),
                backgroundColor: 'rgba(78, 145, 204, 0.2)',
                borderColor: 'rgba(78, 145, 204, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            animation: {
                
                x: {
                    type: 'number',
                    easing: 'easeOutQuart',
                    duration: 500,
                    from: (ctx) => {
                        const chart = ctx.chart;
                        const { bottom } = chart.chartArea || {};
                        return bottom || 0;
                    }
                }
            },
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
                    displayColors: false,
                    backgroundColor: 'rgba(245, 245, 244, 0.98)',
                    titleColor: 'rgb(78, 145, 204)',
                    bodyColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: { weight: 'normal' },
                    bodyFont: { weight: 'bold' },
                    cornerRadius: 10,
                    borderColor: 'rgba(0, 0, 0, 0.15)',
                    borderWidth: 1,
                    padding: 10,
                    
                    bodyAlign: 'center',
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
                            month: 'MMM'
                        }
                    },                    
                    ticks: {
                        callback: function(value, index, ticks) {   // !index required to determine number of ticks!
                            const date = new Date(value);
                            const month = date.getMonth();

                            switch (month) {
                                case 0:
                                    return ticks.length > 12 ? format(date, 'yyyy') : format(date, 'yy');
                                case 4:
                                case 8:
                                    return ticks.length > 12 ? format(date, 'MMM') : format(date, 'MMM');
                                default:
                                    return ticks.length > 12 ? undefined : format(date, 'MMM');
                            }                      
                        }
                    }
                },
                y: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        callback: function(value, index) {
                            return index % 2 !== 0 ? '$' + value.toFixed(2) : undefined;
                        },
                    }
                }
            }
        },
    });
}
