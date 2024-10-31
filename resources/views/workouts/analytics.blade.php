<!DOCTYPE html>
<html>
<head>
    <title>Workout Analytics</title>
    @vite(['resources/js/app.js']) <!-- Use Vite to include your JavaScript -->
</head>
<body>
    <h1>Workout Analytics</h1>

    {{-- Blade error handling to ensure data is available --}}
    @if(!empty($totalWeightByCategory) && is_array($totalWeightByCategory) && count($totalWeightByCategory) > 0)
        <canvas id="weightChart" width="400" height="200"></canvas>
    @else
        <p>No workout data available to display the analytics chart.</p>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const labels = {!! json_encode(array_keys($totalWeightByCategory)) !!};
                const data = {!! json_encode(array_values($totalWeightByCategory)) !!};

                console.log('Labels:', labels);  // Debug to check labels
                console.log('Data:', data);      // Debug to check data

                // Check if data is empty before creating the chart
                if (labels.length === 0 || data.length === 0) {
                    console.error('No data available to render the chart.');
                    return;
                }

                const ctx = document.getElementById('weightChart')?.getContext('2d');

                if (!ctx) {
                    console.error('Canvas element not found. Check the ID or ensure it exists in the DOM.');
                    return;
                }

                const weightChart = new Chart(ctx, {
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

            } catch (error) {
                console.error('Error rendering the chart:', error);
            }
        });
    </script>
</body>
</html>
