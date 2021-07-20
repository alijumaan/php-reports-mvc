<?php
/** @var $pageTitle */
/** @var $config */
/** @var $content */
require_once __DIR__.'/../../config/app.php';

?>
<!doctype html>
<html lang="<?php echo $config['lang'] ?>" dir="<?php echo $config['dir'] ?>" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $config['app_name']?> | <?php echo $pageTitle ?></title>
    <link rel="stylesheet" href="<?php echo $config['app_url'] ?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $config['app_url'] ?>assets/css/style.css">
</head>
<body class="d-flex flex-column h-100">
    <?php include_once __DIR__ . "/../partials/header.php" ?>
<main role="main" class="flex-shrink-0">
    <div class="container mt-3 my-5">
        <?php echo $content; ?>
    </div>
</main>
    <?php include_once __DIR__ . "/../partials/footer.php" ?>
    <script src="<?php echo $config['app_url'] ?>assets/vendors/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?php echo $config['app_url'] ?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>