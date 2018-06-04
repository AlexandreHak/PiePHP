<nav class="navbar navbar-expand-lg navbar-dark main-navbar">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URI ?>">My Cinema</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-film"></i>
                        Movies
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' . DIRECTORY_SEPARATOR . 'add'; ?>">Add</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' ?>">All movies</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-users"></i>
                        Community
                    </a>
                </li>
            </ul>
            
            <!-- shouldn't use session auth but variable extract -->
            <?php if (isset($_SESSION['auth'])): ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="profile-logo"><?= $_SESSION['auth'] ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR. 'profile'; ?>">Profile</a>
                            <a class="dropdown-item" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'history'; ?>">History</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'logout'?>">Logout</a>
                        </div>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav">
                    <li class="nav-item btn btn-outline-primary">
                        <a class="nav-link" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'login'?>">Login</a>
                    </li>
                    <li class="nav-item btn btn-outline-secondary ml-2">
                        <a class="nav-link" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'signup'?>">Sign Up</a>
                    </li>
                </ul>
            <?php endif;?>
        </div>
    </div>
</nav>
 
<nav class="navbar navbar-light d-flex justify-content-center search-movie mb-5">
  <form class="form-inline" action="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie'; ?>" method="get">
    <input type="search" name="search" class="form-control mr-sm-2"  placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
  </form>
</nav>

<?php if (isset($_SESSION['info'])): ?>
<div class="alert alert-info alert-dismissible fade show text-center" role="alert">
  <strong><?= $_SESSION['info'] ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>