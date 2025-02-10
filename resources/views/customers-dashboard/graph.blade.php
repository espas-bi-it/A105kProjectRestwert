@extends('layout')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Empfehlung Grafik</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="min-width: 80%; margin: auto; padding: 50px">
        <canvas id="suggestionsChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('suggestionsChart').getContext('2d');

        const data = @json(array_values($suggestionsData));
        const labels = @json(array_keys($suggestionsData));

        new Chart(ctx, {
            type: 'bar', // You can also use 'pie', 'line', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: " {{ __('fields.graph_text') }} ",
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
           options: {
                plugins: {
                    legend: {
                        onClick: null, // Disable click events on legend items
                    }
                },
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
@endsection
