<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Konfirmasi Pembayaran untuk Transaksi #<?= $transaksi->id ?></h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<!-- Transaction Details -->
<div class="alert alert-info">
    <strong>Informasi Transaksi:</strong><br>
    ID Transaksi: <?= $transaksi->id ?><br>
    Total Pembayaran: Rp<?= number_format($transaksi->total_harga, 0, ',', '.') ?><br>
    Status: <?= $transaksi->status === 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar' ?><br>
</div>

<!-- Confirm Payment Button -->
<?php if ($transaksi->status !== 'paid'): ?>
    <form action="<?= site_url('transaksi/confirmpayment/' . $transaksi->id) ?>" method="post">
        <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
    </form>
<?php else: ?>
    <div class="alert alert-success">
        Pembayaran telah dikonfirmasi.
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
