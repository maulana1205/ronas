<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Edit Profile</h1>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?= $user->username ?>" required>
    </div>
    
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>

<?= $this->endSection() ?>
