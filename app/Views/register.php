<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
  body {
    background: url('<?= base_url('images/Capture.jpg'); ?>') no-repeat center center fixed;
    background-size: cover;
    height: 100%;
    margin: 0;
    padding: 0;
  }
  .register-box {
    background: rgba(255, 255, 255, 0.8); /* Background with transparency */
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	margin-top: 100px;
  }
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
</style>

<div class="container">
  <div class="register-box">
    <h1 class="register-title">Register Form</h1>
    <?php
      $username = [
        'name' => 'username',
        'id' => 'username',
        'value' => null,
        'class' => 'form-control'
      ];

      $password = [
        'name' => 'password',
        'id' => 'password',
        'class' => 'form-control'
      ];

      $repeatPassword = [
        'name' => 'repeatPassword',
        'id' => 'repeatPassword',
        'class' => 'form-control'
      ];

      $session = session();
      $errors = $session->getFlashdata('errors');
    ?>
    <?php if($errors != null): ?>
      <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Terjadi Kesalahan</h4>
        <hr>
        <p class="mb-0">
          <?php
            foreach($errors as $err){
              echo $err.'<br>';
            }
          ?>
        </p>
      </div>
    <?php endif ?>
    <?= form_open('Auth/register') ?>
      <div class="form-group">
        <?= form_label("Username", "username") ?>
        <?= form_input($username) ?>
      </div>
      <div class="form-group">
        <?= form_label("Password", "password") ?>
        <?= form_password($password) ?>
      </div>
      <div class="form-group">
        <?= form_label("Repeat Password", "repeatPassword") ?>
        <?= form_password($repeatPassword) ?>
      </div>
      <div class="text-right">
        <?= form_submit('submit', 'Submit', ['class' => 'btn btn-success']) ?>
      </div>
    <?= form_close() ?>
  </div>
</div>

<?= $this->endSection() ?>
