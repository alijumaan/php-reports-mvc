<?php
$pageTitle = 'Show '. $report['title'];

/** @var $config */
include_once __DIR__. "/../../config/app.php";

/** @var $report */
if (!isset($_SESSION['logged_in'])) {
    header('location: ../login');
}
?>
<div class="d-flex mt-5 my-3">
    <h4 class="">Report Details</h4>
    <a href="/" class="ml-auto btn-primary btn">Back</a>
</div>

<?php if ($report): ?>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow" style="height: 100%;">
                <div class="card-header bg-secondary text-white d-flex">
                    <div><?php echo $report['title'] ?></div>
                    <div class="ml-auto">
                        <?php if ($_SESSION['user_id'] === $report['user_id']): ?>
                            <a href="/reports/edit?id=<?php echo $report['id']?>"
                               class="btn btn-sm btn-info">Edit</a>
                            <form method="POST" action="/reports/delete?id=<?php echo $report['id']?>"
                                  style="display: inline-block;">
                                <input type="hidden" name="id" value="<?php echo $report['id'] ?>">
                                <button onclick="return confirm('Are you sure you want to delete this report?');"
                                        type="submit"
                                        class="btn btn-sm btn-danger">Delete
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-title p-0">
                    <div class="row mb-4">
                        <div class="col-2">
                            <?php if ($report['image']): ?>
                                <img class="thumbnail"
                                     src="<?php echo $config['app_url'].'assets/uploads/' . $report['image'] ?>"
                                     alt="image not found">
                            <?php endif; ?>
                        </div>
                        <div class="col-10">
                            <div class="p-2 text-dark">
                                <?php echo $report['body'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="footer"><?php echo $report['created_at'] ?></div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <p>No result.</p>
<?php endif; ?>
