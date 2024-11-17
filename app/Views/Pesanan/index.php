<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Pesanan Anda</h1>

<?php if (!empty($pesanan)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Alamat</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pesanan as $index => $item): ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td><?= $item['id_barang'] ?></td>
                    <td><?= $item['alamat'] ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td><?= $item['total_harga'] ?></td>
                    <td><?= ucfirst($item['status']) ?></td>
                    <td>
                        <a href="<?= site_url('pesanan/detail/' . $item['id']) ?>" class="btn btn-info">Lihat Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Anda belum memiliki pesanan.</p>
<?php endif; ?>

<?= $this->endSection() ?>
