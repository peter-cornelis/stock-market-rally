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
        let currentPeriod = '1Y';
        let filteredData = filterChartDataByPeriod(chartData, currentPeriod);

        const chartInstance = initStockChart(filteredData, symbol);

        const periodBtns = document.querySelectorAll('.chartBtn');
    
        periodBtns.forEach(btn => {
            if (currentPeriod == btn.dataset.period) {
                btn.classList.add('bg-black/5', 'shadow', 'border-black/10');
            }
            btn.addEventListener('click', () => {
                if (currentPeriod == btn.dataset.period) return;
                currentPeriod = btn.dataset.period; 

                btn.classList.add('bg-black/5', 'shadow', 'border-black/10');
                periodBtns.forEach(otherBtn => {
                    if (otherBtn !== btn) otherBtn.classList.remove('bg-black/5', 'shadow', 'border-black/10');
                });
                filteredData = filterChartDataByPeriod(chartData, currentPeriod);
                chartInstance.data.labels = filteredData.map(item => item.date);
                chartInstance.data.datasets[0].data = filteredData.map(item => item.price);
                chartInstance.update();
            });
        });
    }
});

// Auto-initialize password strength indicator if password field is present
document.addEventListener('DOMContentLoaded', () => { 
    const password = document.getElementById("password");
    if(password) {
        password.oninput = () => {
            const length = document.getElementById('password').value.length;
            if(length >= 12) {
                document.getElementById('12chars').classList.add('text-notice');
            } else {
                document.getElementById('12chars').classList.remove('text-notice');
            }
        }
    }
});

// Helper function to filter chart data based on selected period
function filterChartDataByPeriod(chartData, period) {
    const now = new Date();
    let cutoffDate;

switch(period) {
        case '1M':
            cutoffDate = new Date(now.setMonth(now.getMonth() - 1));
            break;
        case '3M':
            cutoffDate = new Date(now.setMonth(now.getMonth() - 3));
            break;
        case '6M':
            cutoffDate = new Date(now.setMonth(now.getMonth() - 6));
            break;
        case 'YTD':
            cutoffDate = new Date(now.getFullYear(), 0, 1);
            break;
        case '1Y':
            cutoffDate = new Date(now.setFullYear(now.getFullYear() - 1));
            break;
        case '3Y':
            cutoffDate = new Date(now.setFullYear(now.getFullYear() - 3));
            break;
        default:
            return chartData;
    }
    return chartData.filter(item => new Date(item.date) >= cutoffDate);
}