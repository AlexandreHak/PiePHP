<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="rounded w-75" src="https://image.tmdb.org/t/p/w500/<?= $movie->poster_path; ?>" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col">
                <div class="row mb-5">
                    <h1 class="display-3"><?= $movie->title?></h1>
                </div>
                <div class="row mb-4">
                    <div class="col-3">
                        <h5>Release Date</h5>
                        <p><?= $movie->release_date; ?></p>
                    </div>
                    <div class="col-3">
                        <h5>Runtime</h5>
                        <p><?= $movie->runtime; ?></p>
                    </div>
                    <div class="col-3">
                        <h5>Genre</h5>
                        <!-- relations !!! -->
                        <p><?= $movie->id_genre; ?></p>
                    </div>
                    <div class="col-3">
                        <h5>Publisher</h5>
                        <p><?= $movie->id_publisher; ?></p>
                    </div>
                </div>
                <div class="row mb-4">
                    <h5>Overview</h5>
                    <p><?= $movie->overview; ?></p>
                </div>
                <?php if (isset($_SESSION['auth'])): ?>
                <div class="row">
                    <a href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' . DIRECTORY_SEPARATOR . 'edit?id=' . $movie->id_movie; ?>" class="btn btn-light">Edit</a>
                    <a href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'history' . DIRECTORY_SEPARATOR . 'add?id_u=' . $_SESSION['auth'] . '&id_m=' . $movie->id_movie; ?>" class="btn btn btn-dark">Add</a>
                </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>