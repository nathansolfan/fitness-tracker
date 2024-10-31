<!DOCTYPE html>
<html>
<head>
    <title>Workout Analytics</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>Workout Analytics</h1>

    {{-- Bar chart for total weight by category --}}
    @if(!empty($totalWeightByCategory) && is_array($totalWeightByCategory) && count($totalWeightByCategory) > 0)
        <canvas id="weightChart" width="400" height="50"></canvas>
    @else
        <p>No workout data available to display the analytics chart.</p>
    @endif

    {{-- Pie chart for count by category --}}
    @if(!empty($countByCategory) && is_array($countByCategory) && count($countByCategory) > 0)
        <canvas id="categoryChart" width="400" height="200"></canvas>
    @else
        <p>No workout data available to display the category distribution chart.</p>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                // Data for bar chart
                const labels = {!! json_encode(array_keys($totalWeightByCategory)) !!};
                const data = {!! json_encode(array_values($totalWeightByCategory)) !!};

                console.log('Labels:', labels);
                console.log('Data:', data);

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
                                scales: {
                                    y: {
                                        beginAtZero: true
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

                console.log('Pie Labels:', pieLabels);
                console.log('Pie Data:', pieData);

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
                            }
                        });
                    }
                } else {
                    console.error('No data available to render the pie chart.');
                }

            } catch (error) {
                console.error('Error rendering the charts:', error);
            }
        });
    </script>
</body>
</html>
