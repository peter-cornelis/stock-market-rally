import './bootstrap';
import { initStockChart } from './stock-chart';

// Auto-initialize stock chart if present on page
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('myChart');
    if (canvas && canvas.dataset.chartData) {
        const chartData = JSON.parse(canvas.dataset.chartData);
        const symbol = canvas.dataset.symbol;
        initStockChart(chartData, symbol);
    }
});