// chart js
import Chart from 'chart.js/auto';
import { getRelativePosition } from 'chart.js/helpers';

export default class ImageFileViewer {
    static listen() {
        window.addEventListener("load", function () {
            const ctx = document.getElementById('report');
            if (!ctx) return
            const data = JSON.parse(ctx.dataset.report)
            const chart = new Chart(ctx, {
                data: {
                    labels: data.map(row => row.year),
                    datasets: [
                        {
                            type: 'line',
                            label: 'Acquisitions by year',
                            data: data.map(row => row.count),
                            tension: .3
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    onClick: (e) => {
                        const canvasPosition = getRelativePosition(e, chart);

                        // Substitute the appropriate scale IDs
                        const dataX = chart.scales.x.getValueForPixel(canvasPosition.x);
                        const dataY = chart.scales.y.getValueForPixel(canvasPosition.y);
                    },
                },

            });
        })
    }
}