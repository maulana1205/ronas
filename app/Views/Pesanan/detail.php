<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Detail Pesanan</h1>

<?php if ($pesanan): ?>
    <table class="table">
        <tr>
            <th>No</th>
            <td><?= $pesanan['id'] ?></td>
        </tr>
        <tr>
            <th>Produk</th>
            <td><?= $pesanan['id_barang'] ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?= $pesanan['alamat'] ?></td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td><?= $pesanan['jumlah'] ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td><?= $pesanan['total_harga'] ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= ucfirst($pesanan['status']) ?></td>
        </tr>
    </table>
    <a href="<?= site_url('pesanan/index') ?>" class="btn btn-secondary">Kembali ke Daftar Pesanan</a>
<?php else: ?>
    <p>Pesanan tidak ditemukan.</p>
<?php endif; ?>

<?= $this->endSection() ?>
