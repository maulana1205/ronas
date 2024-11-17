<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Product</h1>

<a href="<?= site_url('barang/export') ?>" class="btn btn-success mb-3">Export to Excel</a> <!-- Tombol Export -->

<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Product</th>
			<th>Gambar</th>
			<th>Harga</th>
			<th>Stok</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($barangs as $index=>$barang): ?>
			<tr>
				<td><?= ($index+1) ?></td>
				<td><?= $barang->nama ?></td>
				<td>
					<img class="img-fluid" width="200px" alt="gambar" src="<?= base_url('uploads/'.$barang->gambar) ?>" />
				</td>
				<td><?= $barang->harga ?></td>
				<td><?= $barang->stok ?></td>
				<td>
					<a href="<?= site_url('barang/view/'.$barang->id) ?>" class="btn btn-primary">View</a>
					<a href="<?= site_url('barang/update/'.$barang->id) ?>" class="btn btn-success">Update</a>
					<a href="<?= site_url('barang/delete/'.$barang->id) ?>" class="btn btn-danger">Delete</a>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<?= $this->endSection() ?>
