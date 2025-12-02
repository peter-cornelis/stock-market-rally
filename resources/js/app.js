import './bootstrap';
import { initStockChart } from './stock-chart';
import 'chartjs-adapter-date-fns';
import initTransactionForm from './transaction-form';

// Auto-initialize transaction form if present on page
document.addEventListener('DOMContentLoaded', () => initTransactionForm());

// Auto-initialize stock chart if present on page
document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('myChart');
    if (canvas && canvas.dataset.chartData) {
        const chartData = JSON.parse(canvas.dataset.chartData);
        const symbol = canvas.dataset.symbol;
        initStockChart(chartData, symbol);
    }
});

document.addEventListener('DOMContentLoaded', () => { 
    document.getElementById("password").oninput = () => {
        const length = document.getElementById('password').value.length;
        if(length >= 12) {
            document.getElementById('12chars').classList.add('text-notice');
        } else {
            document.getElementById('12chars').classList.remove('text-notice');
        }
    }
});