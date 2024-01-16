<div class="w-full mx-4 bg-white px-2 py-4 lg:p-10 rounded drop-shadow overflow-x-scroll ">
    <canvas id="myChart" class="max-w-full"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module">
        const ctx = document.getElementById('myChart');
        Chart.defaults.font.family = 'nunito';
        Chart.defaults.plugins.legend.display = false;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($this->years),
                datasets: [{
                    label: '{{ __('form.average') }}',
                    data: @json($this->averages),
                    borderWidth: 5,
                    borderColor: '#5754EA',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 1,
                resizeDelay: 200,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 20,
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                    }
                }
            }
        });
    </script>
</div>
