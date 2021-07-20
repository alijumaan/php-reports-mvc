<?php
$pageTitle = 'All reports';
/** @var $config */
/** @var $search */
/** @var $reports */
require_once __DIR__.'/../../config/app.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php include __DIR__ . "/../messages/success.php" ?>
<div class="d-flex mt-5 my-3">
    <h4 class="">Reports</h4>
    <a href="/reports/create" class="ml-auto btn-primary btn">New Report</a>
</div>
<form action="">
    <div class="input-group mb-3 w-50">
        <input type="text" class="form-control"
               placeholder="Search title of report"
               value="<?php echo $search ?>"
               name="search">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
    </div>
</form>
<div class="row">
    <?php foreach ($reports as $report): ?>
        <div class="col-6 col-md-6 col-lg-4 col-xl-3 mb-4">
            <a href="/reports/show?id=<?php echo $report['id']?>" class="text-decoration-none">
                <div class="card shadow" style="height: 100%;">
                    <div class="card-header bg-secondary text-white"><?php echo $report['title'] ?></div>
                    <div class="card-body p-0">
                        <?php if ($report['image']): ?>
                            <div style="background-image: url(<?php echo $config['app_url'].'assets/uploads/'.$report['image'] ?>)"
                                 class="thumbnail" ></div>
                        <?php else: ?>
                            <div style="background-image: url(<?php echo $config['app_url'].'assets/uploads/default.jpg' ?>)"
                                 class="thumbnail" ></div>
                        <?php endif; ?>
                        <div class="p-2 text-dark">
                            <?php echo strlen($report['body']) > 50 ? substr($report['body'], 0, 50) . "..." : $report['body']; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="footer"><?php echo $report['created_at'] ?></div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>