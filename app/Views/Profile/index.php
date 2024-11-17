<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>User Profile</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Profile Information</h5>
        <p><strong>Username:</strong> <?= $user->username ?></p>
        <p><strong>Avatar:</strong></p>
        <img src="<?= base_url('images/' . $user->avatar) ?>" alt="Avatar" width="100" height="100">
        <p><strong>Created Date:</strong> <?= $user->created_date ?></p>
        <p><strong>Updated Date:</strong> <?= $user->updated_date ?></p>

        <a href="<?= site_url('profile/edit') ?>" class="btn btn-primary">Edit Profile</a>
    </div>
</div>

<?= $this->endSection() ?>
