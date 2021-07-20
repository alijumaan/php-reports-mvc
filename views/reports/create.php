<?php
$pageTitle = 'Create new report';

if (!isset($_SESSION['logged_in'])) {
    header('location: ../login');
}

$title = '';
$body = '';

?>

<div class="row justify-content-center">
    <div class="col-8">
        <div class="p-2">
            <h2>Create New Report</h2>
        </div>
        <div class="card p-5">
            <?php include __DIR__."/../messages/errors.php" ?>
            <form action="/reports" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input name="title" type="text" class="form-control" value="<?php echo $title ?>"
                           id="title" aria-describedby="titleHelp">
                </div>
                <div class="form-group">
                    <label for="body">Report</label>
                    <textarea name="body" type="text" class="form-control"
                              id="body" cols="30" rows="10"><?php echo $body ?></textarea>
                </div>
                <div class="form-group">
                    <input type="file" name="image">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create new report</button>
            </form>

        </div>
    </div>
</div>