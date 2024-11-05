<!-- resources/views/livewire/progress-chart.blade.php -->
<x-layout title="{{ $exercise }} Progress" header="{{ $exercise }} Progress Over Time">
    @if (!empty($dates) && !empty($weights))
        <canvas id="progressChart" width="800" height="500"></canvas>

        <script>
            document.addEventListener('livewire:load', function () {
                const labels = @json($dates);
                const data = @json($weights);

                // Calculate average, max, and min weights
                const totalWeight = data.reduce((sum, weight) => sum + weight, 0);
                const averageWeight = totalWeight / data.length;
                const maxWeight = Math.max(...data);
                const minWeight = Math.min(...data);

                const ctx = document.getElementById('progressChart').getContext('2d');
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
            });
        </script>
    @else
        <p>No progress data available to display the chart.</p>
    @endif
</x-layout>
