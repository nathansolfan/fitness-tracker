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

                console.log('Labels:', labels);
                console.log('Data:', data);

                if (labels.length === 0 || data.length === 0) {
                    console.error('No data available to render the chart.');
                    return;
                }

                // Calculate average, max, and min weights
                const totalWeight = data.reduce((sum, weight) => sum + weight, 0);
                const averageWeight = totalWeight / data.length;
                const maxWeight = Math.max(...data);
                const minWeight = Math.min(...data);

                const ctx = document.getElementById('progressChart')?.getContext('2d');
                if (!ctx) {
                    console.error('Canvas element not found. Check the ID or ensure it exists in the DOM.');
                    return;
                }

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: '{{ $exercise }} Weight Over Time',
                                data: data,
                                fill: false,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                tension: 0.1
                            },
                            {
                                label: 'Average Weight',
                                data: Array(labels.length).fill(averageWeight),
                                fill: false,
                                borderColor: 'rgba(255, 165, 0, 0.8)',
                                borderDash: [5, 5],
                                pointRadius: 0
                            },
                            {
                                label: 'Max Weight',
                                data: Array(labels.length).fill(maxWeight),
                                fill: false,
                                borderColor: 'rgba(255, 99, 132, 0.8)',
                                borderDash: [5, 5],
                                pointRadius: 0
                            },
                            {
                                label: 'Min Weight',
                                data: Array(labels.length).fill(minWeight),
                                fill: false,
                                borderColor: 'rgba(54, 162, 235, 0.8)',
                                borderDash: [5, 5],
                                pointRadius: 0
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
                                    text: 'Weight (kg)'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        size: 12
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
