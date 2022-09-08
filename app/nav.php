<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="./"><img src="../img/med_logo.png" width="60px" height="auto">
        ระบบสารบัญ</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?= $_SESSION['medcode'];?> <i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <button class="dropdown-item btn_logout"
                    onclick="window.location.href = '../logout.php'">Logout</button>
            </div>
        </li>
    </ul>
</nav>