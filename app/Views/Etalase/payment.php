<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Pembayaran Transaksi #<?= $transaksi->id ?></h1>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<!-- Informasi Virtual Account BCA -->
<div class="alert alert-info">
    <strong>Informasi Pembayaran:</strong><br>
    Silahkan lakukan pembayaran menggunakan Virtual Account BCA berikut:<br>
    <strong>Virtual Account:</strong> 126089681127532<br>
    Pembayaran harus dilakukan dalam waktu 2 jam setelah transaksi.<br>
</div>

<!-- Total Pembayaran -->
<div class="alert alert-warning">
    <strong>Total Pembayaran:</strong> Rp<?= number_format($total_harga, 0, ',', '.') ?><br>
    <strong>Jatuh Tempo:</strong> <span id="countdown"></span>
</div>

<!-- Hitungan Mundur -->
<script>
    // Set waktu jatuh tempo (2 jam dari sekarang)
    const countdownTime = new Date().getTime() + 2 * 60 * 60 * 1000; // 2 jam

    const countdownFunction = setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownTime - now;

        // Waktu mundur dalam jam, menit, detik
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Menampilkan hasil
        document.getElementById("countdown").innerHTML = hours + " jam " + minutes + " menit " + seconds + " detik ";

        // Jika waktu habis, tampilkan pesan
        if (distance < 0) {
            clearInterval(countdownFunction);
            document.getElementById("countdown").innerHTML = "Waktu pembayaran telah habis.";
        }
    }, 1000);
</script>

<!-- Petunjuk Transfer -->
<div class="alert alert-info">
    <strong>Petunjuk Transfer mBanking:</strong>
    <ol>
        <li>Pilih m-Transfer > BCA Virtual Account.</li>
        <li>Masukkan nomor Virtual Account <strong>126 0896 8112 7532</strong> dan pilih Send.</li>
        <li>Periksa informasi yang tertera di layar.</li>
        <li>Masukkan PIN m-BCA Anda dan pilih OK.</li>
        <li>Jika muncul notifikasi “Transaksi Gagal. Nominal melebihi limit harian”, mohon ulangi transaksi menggunakan KlikBCA (iBanking) atau ATM.</li>
    </ol>
</div>

<form action="<?= base_url('pesanan/index') ?>" method="post">
    <input type="hidden" name="id_transaksi" value="<?= $transaksi->id ?>">
    <button type="submit" class="btn btn-primary">OK</button>
</form>

<?= $this->endSection() ?>
