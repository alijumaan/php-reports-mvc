<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-white" href="/">Home</a>
            <?php if (isset($_SESSION['logged_in'])) { ?>
                <li class="nav-item dropdown">
                    <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="/dashboard?id=<?= $_SESSION['user_id'] ?>">Dashboard</a>
                        <form action="/logout" method="post">
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </div>
                </li>
            <?php } else { ?>
                <a class="navbar-brand text-white" href="/login">Login</a>
            <?php } ?>
        </div>
    </nav>
</header>