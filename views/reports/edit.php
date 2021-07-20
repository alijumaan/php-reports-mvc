<?php
/** @var $config */
include_once __DIR__. "/../../config/app.php";

$pageTitle = 'Edit report';
/** @var $report */

if (!isset($_SESSION['logged_in'])) {
    header('location: /login');
}
?>

<div class="row justify-content-center">
    <div class="col-8">
        <div class="p-2 d-flex">
            <h2>Edit Report <b><?php echo $report['title'] ?></b></h2>
            <a href="/reports" class="ml-auto btn-primary btn">Back</a>
        </div>
        <div class="card p-5">
            <?php include __DIR__."/../messages/errors.php" ?>
            <form action="/reports/update?id=<?php echo $report['id']?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" value="<?php echo $report['title'] ?>"
                           id="title" aria-describedby="titleHelp">
                </div>
                <div class="form-group">
                    <label for="body">Report</label>
                    <textarea name="body" type="text" class="form-control"
                              id="body" cols="30" rows="10"><?php echo $report['body'] ?></textarea>
                </div>
                <div class="form-group">
                    <?php if ($report['image']): ?>
                        <img class="thumbnail" src="<?php echo $config['app_url'].'assets/uploads/'.$report['image'] ?>"
                             alt="image not found">
                    <?php endif; ?>
                    <input type="file" name="image">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>

        </div>
    </div>
</div>