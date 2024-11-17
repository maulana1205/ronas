<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Transaksi</h1>
<a href="<?= site_url('report') ?>" class="btn btn-success">Export Data</a>
<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Product</th>
			<th>Id Pembeli</th>
			<th>Alamat</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($model as $index=>$transaksi): ?>
			<tr>
				<td><?= $transaksi->id ?></td>
				<td><?= $transaksi->id_barang ?></td>
				<td><?= $transaksi->id_pembeli ?></td>
				<td><?= $transaksi->alamat ?></td>
				<td><?= $transaksi->jumlah ?></td>
				<td><?= $transaksi->total_harga ?></td>
				<td>
					<a href="<?= site_url('Transaksi/view/'.$transaksi->id) ?>" class="btn btn-primary">View</a>
					<a href="<?= site_url('Transaksi/invoice/'.$transaksi->id) ?>" class="btn btn-info">Invoice</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?= $this->endSection() ?>
