import { Chart, registerables } from 'chart.js';
import 'flowbite';

Chart.register(...registerables);
window.Chart = Chart;