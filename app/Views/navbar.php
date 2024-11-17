<?php
// Mengambil segmen 1 dan segmen 2 dari URL
$segment1 = service('uri')->getSegment(1); // Mengambil segmen pertama
$segment2 = service('uri')->getSegment(2); // Mengambil segmen kedua
$session = session(); // Mengambil session untuk mengecek login status dan role

// Contoh data notifikasi (ini bisa Anda ganti dengan logika dari database)
$notificationModel = new \App\Models\NotificationModel();
$notifications = $notificationModel->getNotificationsByUser(session()->get('id_user'));
$notificationCount = count($notifications);
?>
<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="#">
    <img src="<?= base_url('images/ronas.png'); ?>" width="100" height="50" class="d-inline-block align-top" alt="LOGO">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <?php if ($session->get('isLoggedIn')): ?>
      <ul class="navbar-nav mr-auto">
        <?php if ($session->get('role') == "admin"): ?>
          <!-- Navbar item untuk halaman Dashboard -->
          <li class="nav-item <?= ($segment1 == 'dashboard' && $segment2 == 'index') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('dashboard/index')?>">Dashboard</a>
          </li>
          <!-- Navbar item untuk halaman Barang -->
          <li class="nav-item dropdown <?= ($segment1 == 'barang') ? 'active' : '' ?>">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="<?= site_url('barang/index') ?>">List Product</a>
              <a class="dropdown-item" href="<?= site_url('barang/create') ?>">Tambah Product</a>
            </div>
          </li>
          <!-- Navbar item untuk halaman Transaksi -->
          <li class="nav-item <?= ($segment1 == 'transaksi' && $segment2 == 'index') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('transaksi/index')?>">Transaksi</a>
          </li>
          <!-- Navbar item untuk halaman Payment -->
          <li class="nav-item <?= ($segment1 == 'payment' && $segment2 == 'index') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('transaksi/confirmpayment')?>">Payment</a>
          </li>
          <!-- Navbar item untuk halaman User -->
          <li class="nav-item <?= ($segment1 == 'user' && $segment2 == 'index') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('user/index')?>">User</a>
          </li>
          <!-- Navbar item untuk halaman Register -->
          <li class="nav-item <?= ($segment1 == 'auth' && $segment2 == 'register') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('auth/register')?>">Register</a>
          </li>
        <?php else: ?>
          <!-- Navbar untuk pengguna non-admin -->
          <li class="nav-item <?= ($segment1 == 'home' && $segment2 == 'index') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('home/index')?>">Home</a>
          </li>
          <li class="nav-item <?= ($segment1 == 'etalase' && $segment2 == 'index') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('etalase/index')?>">Product</a>
          </li>
          <li class="nav-item <?= ($segment1 == 'pesanan' && $segment2 == 'saya') ? 'active' : '' ?>">
            <a class="nav-link" href="<?= site_url('pesanan/saya')?>">Pesanan</a>
          </li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Notifikasi Pembayaran -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell" aria-hidden="true"></i>
            <?php if ($notificationCount > 0): ?>
              <span class="badge badge-light"><?= $notificationCount ?></span>
            <?php endif; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
            <?php if ($notificationCount > 0): ?>
              <?php foreach ($notifications as $notification): ?>
                <div class="dropdown-item alert alert-<?= $notification['status'] ?> m-0">
                  <?= $notification['message'] ?>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="dropdown-item">Tidak ada notifikasi.</div>
            <?php endif; ?>
          </div>
        </li>
        <!-- Navbar item untuk Profile User -->
        <li class="nav-item <?= ($segment1 == 'profile' && $segment2 == 'index') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= site_url('profile/index')?>">
            <img src="<?= base_url('images/profile.png'); ?>" width="30" height="30" class="d-inline-block align-top" alt="">
          </a>
        </li>
        <!-- Logout/Login Button -->
        <?php if ($session->get('isLoggedIn')): ?>
          <li class="nav-item">
            <a class="btn btn-success" href="<?= site_url('auth/logout') ?>">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="btn btn-primary" href="<?= site_url('auth/login')?>">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    <?php endif; ?>
  </div>
</nav>

<!-- Menambahkan Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Scripts untuk Bootstrap dan jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/js/bootstrap.min.js"></script>
