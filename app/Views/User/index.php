<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h4>Users List</h4>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Created By</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= $user->username ?></td>
                <td><?= $user->created_by ?></td>
                <td>
                    <a href="<?= base_url('user/edit/' . $user->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('user/delete/' . $user->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links() ?>

<?= $this->endSection() ?>
