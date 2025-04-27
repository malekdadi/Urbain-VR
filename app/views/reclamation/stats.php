<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Statistiques des Messages - Graphiques</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 40px auto;
        }

        .charts-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            flex-wrap: wrap;
        }

        .chart-box {
            max-width: 500px;
            width: 100%;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }

        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #28a745; /* VERT */
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        h2 {
            margin-bottom: 40px;
        }

        h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Statistiques des Messages</h2>

    <div class="charts-container">
        <!-- Diagramme Circulaire -->
        <div class="chart-box">
            <h3>Diagramme Circulaire</h3>
            <canvas id="pieChart"></canvas>
        </div>

        <!-- Diagramme en Barres -->
        <div class="chart-box">
            <h3>Diagramme en Barres</h3>
            <canvas id="barChart"></canvas>
        </div>

        <!-- Diagramme Linéaire -->
        <div class="chart-box">
            <h3>Diagramme Linéaire</h3>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <!-- Bouton Retour -->
    <a class="btn" href="index.php">← Accueil</a>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Données PHP envoyées au JS
        const labels = <?= json_encode(array_column($stats, 'message'), JSON_UNESCAPED_UNICODE) ?>;
        const data = <?= json_encode(array_column($stats, 'total')) ?>;

        const backgroundColors = [
            '#2ecc71', '#3498db', '#e74c3c', '#9b59b6',
            '#f1c40f', '#1abc9c', '#e67e22', '#34495e',
            '#ff6b6b', '#6c5ce7', '#fd79a8', '#00cec9'
        ];

        // Pie Chart
        new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColors.slice(0, labels.length)
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: 'Répartition des messages (Circulaire)' }
                }
            }
        });

        // Bar Chart
        new Chart(document.getElementById('barChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Nombre de réclamations',
                    data: data,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Nombre de messages' }
                    },
                    x: {
                        title: { display: true, text: 'Messages' }
                    }
                },
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Répartition des messages (Barres)' }
                }
            }
        });

        // Line Chart
        new Chart(document.getElementById('lineChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tendance des réclamations',
                    data: data,
                    fill: false,
                    borderColor: '#3498db',
                    tension: 0.3, // arrondi des courbes
                    pointBackgroundColor: '#2ecc71',
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Nombre de messages' }
                    },
                    x: {
                        title: { display: true, text: 'Messages' }
                    }
                },
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Évolution des messages (Linéaire)' }
                }
            }
        });
        
    </script>

</body>
</html>
