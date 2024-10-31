<!DOCTYPE html>
<html>
<head>
    <title>{{ $exercise }} Progress</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>{{ $exercise }} Progress Over Time</h1>
    <canvas id="progressChart" width="600" height="50"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const labels = {!! json_encode($dates) !!};
                const data = {!! json_encode($weights) !!};

                console.log('Labels:', labels);  // Debug to check labels
                console.log('Data:', data);      // Debug to check data

                // Check if data is empty before creating the chart
                if (labels.length === 0 || data.length === 0) {
                    console.error('No data available to render the chart.');
                    return;
                }

                const ctx = document.getElementById('progressChart')?.getContext('2d');

                if (!ctx) {
                    console.error('Canvas element not found. Check the ID or ensure it exists in the DOM.');
                    return;
                }

                const progressChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '{{ $exercise }} Weight Over Time',
                            data: data,
                            fill: false,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            } catch (error) {
                console.error('Error rendering the chart:', error);
            }
        });
    </script>
</body>
</html>
