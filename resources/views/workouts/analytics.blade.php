<!DOCTYPE html>
<html>
<head>
    <title>Workout Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Workout Analytics</h1>
    <canvas id="weightChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('weightChart').getContext('2d');
        const weightChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($totalWeightByCategory->keys()) !!},
                datasets: [{
                    label: 'Total Weight by Category',
                    data: {!! json_encode($totalWeightByCategory->values()) !!},
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
    </script>
</body>
</html>
