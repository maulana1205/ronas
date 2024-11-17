<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.3/css/bootstrap.min.css">
    <style>
        .iframe-container {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
        }
        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
        .promo-banner {
            margin-bottom: 20px; /* Jarak di bawah banner */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Banner Promo -->
        <div class="promo-banner text-center">
            <img src="<?= base_url('images/promo.jpg') ?>" alt="Promo Banner" class="img-fluid">
        </div>

        <!-- Iframe Container -->
        <div class="iframe-container">
            <iframe src="https://revassbeauty.id/" allowfullscreen></iframe>
        </div>
    </div>

    <script src="<?= base_url('jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap-4.5.3/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
<?= $this->endSection() ?>
