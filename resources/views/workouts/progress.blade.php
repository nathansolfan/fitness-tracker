<!DOCTYPE html>
<html>
<head>
    <title>{{ $exercise }} Progress</title>
    @vite(['resources/js/app.js'])
    <style>
        #progressChart {
            width: 800px; /* Control the max width of the chart */
            max-height: 500px; /* Control the max height of the chart */
            margin: auto; /* Center the chart on the page */
        }
    </style>
</head>
<body>
    <h1>{{ $exercise }} Progress Over Time</h1>

    {{-- Chart for progress --}}
    @if(!empty($dates) && !empty($weights) && count($dates) > 0 && count($weights) > 0)
        <canvas id="progressChart"></canvas>
    @else
        <p>No progress data available to display the chart.</p>
        <p>Banana</p>
    @endif

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

                new Chart(ctx, {
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
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 12 // Smaller font size for labels
                                    }
                                }
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
