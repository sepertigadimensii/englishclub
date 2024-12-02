<?php
// Koneksi ke database
$host = "localhost"; // Sesuaikan dengan host Anda
$user = "root";      // Sesuaikan dengan user database Anda
$pass = "";          // Sesuaikan dengan password database Anda
$dbname = "ec"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query data
$sql = "SELECT nama, tingkat_kemampuan, minat_khusus, frekuensi_kehadiran FROM anggota";
$result = $conn->query($sql);

// Siapkan data untuk Chart.js
$labels = [];
$frequencies = [];
$colors = [];
$minat = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['nama'];
        $frequencies[] = $row['frekuensi_kehadiran'];
        $minat[] = $row['minat_khusus'];
        $colors[] = $row['tingkat_kemampuan'] === 'Mahir' ? 'green' : 'orange';
    }
} else {
    echo "Tidak ada data";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #e3f2fd;
                color: #212121;
            }

            .container {
                max-width: 1000px;
                margin: 20px auto;
                background: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            h2 {
                color: #ffffff;
                text-align: center;
                margin-bottom: 20px;
                font-weight: 700;
                text-transform: uppercase;
            }

            .btn-add {
                display: inline-block;
                padding: 12px 24px;
                background-color: #7600bc;
                color: white;
                font-weight: bold;
                text-decoration: none;
                border-radius: 5px;
                margin-bottom: 15px;
                transition: transform 0.2s, background-color 0.3s;
            }

            .btn-add:hover {
                background-color: #7600bc;
                transform: scale(1.05);
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #fafafa;
            }

            th, td {
                padding: 14px 16px;
                text-align: left;
                border-bottom: 2px solid #e0e0e0;
            }

            th {
                background-color: #7600bc;
                color: #ffffff;
                font-weight: bold;
                text-transform: uppercase;
            }

            tr:nth-child(even) {
                background-color: #f5f5f5;
            }

            tr:hover {
                background-color: #ffffff;
            }

            .action-links a {
                text-decoration: none;
                padding: 8px 12px;
                border-radius: 4px;
                font-size: 14px;
                margin-right: 8px;
                transition: background-color 0.3s;
            }

            .edit-btn {
                background-color: #DDA0DD;
                color: white;
            }

            .delete-btn {
                background-color: #FF69B4;
                color: white;
            }

            .edit-btn:hover {
                background-color: #DDA0DD;
            }

            .delete-btn:hover {
                background-color: #FF69B4;
            }
        </style>
    <body><h2>
        <a href="index.html" class="btn-add">Home</a>
</h2>
</body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Kehadiran Anggota</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="attendanceChart" width="800" height="400"></canvas>
    <script>
        // Data dari PHP
        const labels = <?php echo json_encode($labels); ?>;
        const data = <?php echo json_encode($frequencies); ?>;
        const colors = <?php echo json_encode($colors); ?>;
        const minat = <?php echo json_encode($minat); ?>;

        // Konfigurasi Chart.js
        const config = {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Frekuensi Kehadiran (%)',
                    data: data,
                    backgroundColor: colors,
                    borderColor: 'black',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    tooltip: {
    callbacks: {
        label: function(context) {
            return context.dataset.label + ': ' + context.raw + '% (Minat: ' + minat[context.dataIndex] + ')';
        }
    }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Nama Anggota'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Frekuensi Kehadiran (%)'
                        },
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        };

        // Render chart
        const attendanceChart = new Chart(
            document.getElementById('attendanceChart'),
            config
        );
    </script>
    
</body>
</html>