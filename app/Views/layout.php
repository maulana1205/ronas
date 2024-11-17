
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Ronas</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('bootstrap-4.5.3/css/bootstrap.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('js/Chart.min.js') ?>"></script>
 <!-- Custom styles for this template -->
 <style>
      body {
        padding-top: 5rem;
      }
      .starter-template {
        padding: 3rem 1.5rem;
        text-align: center;
      }
    </style>
  </head>
  <?= $this->include('navbar') ?>
<main role="main" class="container">
    <?= $this->renderSection('content') ?>
</main><!-- /.container -->
<script src="<?= base_url('bootstrap-4.5.3/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('jquery-3.7.1.min.js') ?>"></script>
<?= $this->renderSection('script') ?>
</html>