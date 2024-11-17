<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Jumlah Pesanan dengan Status: <?= ucfirst($status) ?></h2>

<p>Jumlah pesanan dengan status "<?= ucfirst($status) ?>" adalah: <?= $jumlahPesanan ?></p>

<a href="<?= base_url('pesanan') ?>" class="btn btn-secondary">Kembali ke Riwayat Pesanan</a>

<?= $this->endSection() ?>
