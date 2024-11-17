<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h4>Edit User</h4>

<form action="<?= base_url('user/update/' . $user->id) ?>" method="post">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" value="<?= old('username', $user->username) ?>">
        <?php if (isset($validation) && $validation->hasError('username')): ?>
            <small class="text-danger"><?= $validation->getError('username') ?></small>
        <?php endif; ?>
    </div>

    <!-- New password field -->
    <div class="form-group">
        <label for="password">New Password (leave blank if not changing)</label>
        <input type="password" name="password" class="form-control">
        <?php if (isset($validation) && $validation->hasError('password')): ?>
            <small class="text-danger"><?= $validation->getError('password') ?></small>
        <?php endif; ?>
    </div>

    <!-- Password confirmation field -->
    <div class="form-group">
        <label for="password_confirm">Confirm New Password</label>
        <input type="password" name="password_confirm" class="form-control">
        <?php if (isset($validation) && $validation->hasError('password_confirm')): ?>
            <small class="text-danger"><?= $validation->getError('password_confirm') ?></small>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= base_url('user') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?= $this->endSection() ?>
