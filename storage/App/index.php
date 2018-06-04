<!-- 
<form action="./user/add" method="post">
<form action="./user/connect" method="post">
navbar 
 -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    
        <a class="navbar-brand" href="#">My Cinema</a>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-film"></i>
                        Movies
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Popular</a>
                    <a class="dropdown-item" href="#">Top Rated</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">All movies</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-users"></i>
                        Community
                    </a>
                </li>
            </ul>
            
            <?php if (isset($_SESSION['auth'])): ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="profile-logo">N</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Your profile</a>
                        <a class="dropdown-item" href="#">Watchlist</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a>
                        </div>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav">
                    <li class="nav-item btn btn-outline-primary">
                        <a class="nav-link" href=".">Login</a>
                    </li>
                    <li class="nav-item btn btn-outline-secondary ml-2">
                        <a class="nav-link" href="#">Sign Up</a>
                    </li>
                </ul>
            <?php endif;?>

        </div>
    </div>
</nav>
 
<nav class="navbar navbar-light bg-light d-flex justify-content-center">
  <form class="form-inline" action="/" method="get">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>