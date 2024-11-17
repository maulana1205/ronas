<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Your Name">
    <title><?= $title ?></title>
    <link href="<?= base_url('bootstrap-4.5.3/css/bootstrap.min.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            padding-top: 70px; /* Sesuaikan dengan tinggi navbar Anda */
        }
        #transaksiChartContainer {
            max-width: 600px;
            margin: 0 auto; /* Center the chart */
        }
        #transaksiChart {
            width: 100% !important;
            height: auto !important;
        }
    </style>
</head>
<body>
    <?= $this->include('layout') ?>
    <main role="main" class="container">
        <div class="starter-template">
            <h1 style="margin-top: 20px;">Dashboard</h1> <!-- Penyesuaian margin untuk tulisan Selamat Datang -->
            <p class="lead">Selamat datang, <?= $username ?>!</p>

            <!-- Tabel Data Transaksi -->
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID Barang</th>
                            <th>ID Pembeli</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Waktu Transaksi</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksiData as $transaksi): ?>
                            <tr>
                                <td><?= $transaksi->id ?></td>
                                <td><?= $transaksi->id_barang ?></td>
                                <td><?= $transaksi->id_pembeli ?></td>
                                <td><?= $transaksi->jumlah ?></td>
                                <td><?= $transaksi->total_harga ?></td>
                                <td><?= $transaksi->created_date ?></td>
                                <!-- Tambahkan kolom lain sesuai kebutuhan -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Chart Container -->
            <div id="transaksiChartContainer">
                <canvas id="transaksiChart"></canvas>
            </div>
        </div>
    </main><!-- /.container -->
    <script>
        // Mengambil data transaksi dari PHP
        var transaksiData = <?= json_encode($transaksiData) ?>;

        // Memproses data untuk grafik
        var labels = [];
        var data = [];

        transaksiData.forEach(function(transaksi) {
            labels.push(transaksi.created_date);
            data.push(transaksi.total_harga);
        });

        var ctx = document.getElementById('transaksiChart').getContext('2d');
        var transaksiChart = new Chart(ctx, {
            type: 'line', // Mengatur jenis grafik menjadi 'line'
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Transaksi',
                    data: data,
                    fill: false, // Jangan diisi area di bawah garis
                    borderColor: 'rgba(54, 162, 235, 1)',
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
    <script src="<?= base_url('bootstrap-4.5.3/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('jquery-3.7.1.min.js') ?>"></script>
</body>
</html>
<?= $this->endSection() ?>