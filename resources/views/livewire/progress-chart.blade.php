<!-- resources/views/livewire/progress-chart.blade.php -->
<x-layout title="{{ $exercise }} Progress" header="{{ $exercise }} Progress Over Time">
    @if (!empty($dates) && !empty($weights))
        <canvas id="progressChart" width="800" height="500"></canvas>

        <script>
            document.addEventListener('livewire:load', function () {
                const labels = @json($dates);
                const data = @json($weights);

                const ctx = document.getElementById('progressChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '{{ $exercise }} Weight Over Time',
                            data: data,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true },
                            x: { title: { display: true, text: 'Date' } }
                        },
                        plugins: {
                            legend: { position: 'top' }
                        }
                    }
                });
            });
        </script>
    @else
        <p>No progress data available to display the chart.</p>
    @endif
</x-layout>
