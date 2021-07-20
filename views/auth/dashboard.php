<?php
$pageTitle = 'Profile';

if (!isset($_SESSION['logged_in'])) {
    header('location: ../login');
}
?>

<div class="row justify-content-center">
    <div class="col-8">
        <div class="p-2 text-center">
            <h2>My Reports</h2>
        </div>
        <?php foreach ($reports as $report) { ?>
            <div class="card shadow mb-3">
                <div class="card-header">
                    <h3><a href="<?php echo $config['app_url'] ?>views/report/details.php"><?= $report['title'] ?></a></h3>
                </div>
                <div class="card-body">
                    <p class="card-title"><?= $report['body'] ?></p>
                </div>
                <div class="card-footer">
                    <p><?php echo $report['created_at'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="col-4">
        <div class="p-2 text-center">
            <h2>Update Profile</h2>
        </div>
        <div class="card p-5">
            <?php include __DIR__."/../messages/errors.php" ?>
            <form action="/dashboard/update-profile?id=<?= $_SESSION['user_id'] ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input name="username" type="text" class="form-control" id="username" aria-describedby="usernameHelp" value="<?= $_SESSION['user_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?= $_SESSION['user_email'] ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>

        </div>
    </div>
</div>
