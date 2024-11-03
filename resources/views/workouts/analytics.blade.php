<!DOCTYPE html>
<html>
<head>
    <title>Workout Analytics</title>
    @vite(['resources/js/app.js'])
    <style>
        #weightChart, #categoryChart, #weightOverTimeChart {
            width: 400px;  /* Set fixed width for all charts */
            height: 250px; /* Set fixed height for all charts */
            margin: 20px auto;  /* Center the charts with some margin */
        }
    </style>
</head>
<body>
    <h1>Workout Analytics</h1>

    {{-- Bar chart for total weight by category --}}
    @if(!empty($totalWeightByCategory) && is_array($totalWeightByCategory) && count($totalWeightByCategory) > 0)
        <canvas id="weightChart"></canvas>
    @else
        <p>No workout data available to display the analytics chart.</p>
    @endif

    {{-- Line chart for total weight lifted over time --}}
    @if(!empty($totalWeightOverTime) && count($totalWeightOverTime) > 0)
        <canvas id="weightOverTimeChart"></canvas>
    @else
        <p>No data available for total weight over time.</p>
    @endif

    {{-- Pie chart for count by category --}}
    @if(!empty($countByCategory) && is_array($countByCategory) && count($countByCategory) > 0)
        <canvas id="categoryChart"></canvas>
    @else
        <p>No workout data available to display the category distribution chart.</p>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                // Data for bar chart
                const labels = {!! json_encode(array_keys($totalWeightByCategory)) !!};
                const data = {!! json_encode(array_values($totalWeightByCategory)) !!};

                if (labels.length > 0 && data.length > 0) {
                    const ctx = document.getElementById('weightChart')?.getContext('2d');
                    if (ctx) {
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total Weight by Category',
                                    data: data,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
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
                                                size: 10 // Smaller font size for labels
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                } else {
                    console.error('No data available to render the weight chart.');
                }

                // Data for pie chart
                const pieLabels = {!! json_encode(array_keys($countByCategory)) !!};
                const pieData = {!! json_encode(array_values($countByCategory)) !!};

                if (pieLabels.length > 0 && pieData.length > 0) {
                    const pieCtx = document.getElementById('categoryChart')?.getContext('2d');
                    if (pieCtx) {
                        new Chart(pieCtx, {
                            type: 'pie',
                            data: {
                                labels: pieLabels,
                                datasets: [{
                                    label: 'Workout Category Distribution',
                                    data: pieData,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        labels: {
                                            font: {
                                                size: 10 // Smaller font size for labels
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                } else {
                    console.error('No data available to render the pie chart.');
                }

                // Data for line chart (Total Weight Over Time)
                const lineLabels = {!! json_encode(array_keys($totalWeightOverTime)) !!};
                const lineData = {!! json_encode(array_values($totalWeightOverTime)) !!};

                if (lineLabels.length > 0 && lineData.length > 0) {
                    const lineCtx = document.getElementById('weightOverTimeChart')?.getContext('2d');
                    if (lineCtx) {
                        new Chart(lineCtx, {
                            type: 'line',
                            data: {
                                labels: lineLabels,
                                datasets: [{
                                    label: 'Total Weight Lifted Over Time',
                                    data: lineData,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    tension: 0.1,
                                    fill: true
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
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
                                                size: 10
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }
                } else {
                    console.error('No data available to render the weight over time chart.');
                }

            } catch (error) {
                console.error('Error rendering the charts:', error);
            }
        });
    </script>
</body>
</html>
