<?php
$pageTitle = 'Login';

if(isset($_SESSION['logged_in'])){
    header('location: ../');
}
$email = '';
?>

<?php include __DIR__."/../messages/success.php" ?>
<div class="row justify-content-center">
    <div class="col-8">
        <div class="p-2 text-center">
            <h2>Login</h2>
        </div>
        <div class="card p-5">
            <?php include __DIR__."/../messages/errors.php" ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email"
                           class="form-control"
                           id="email"
                           aria-describedby="emailHelp"
                           value="<?php echo $email?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input name="password" type="password"
                           class="form-control"
                           id="exampleInputPassword">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
