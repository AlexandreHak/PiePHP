<div class="container d-flex justify-content-center mb-3">
    <nav class="pagination-bar">
        <ul class="pagination">
            <li class="page-item <?= (!isset($_GET['p']) || $_GET['p'] == 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie?p=1'; ?>" tabindex="-1">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?php ?>">1</a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <!-- maxpage -->
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

</div>
<div class="container d-flex justify-content-around flex-wrap movie">
<?php foreach ($movies as $movie): ?>
    <div class="card mb-5" style="width: 13rem;">
        <a href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' . '?id=' . $movie->id_movie ?>">
            <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?= $movie->poster_path; ?>" alt="Card image cap">
        </a>
        <div class="card-body">
            <h4 class="card-title"><?= $movie->title; ?></h4>
            <p class="font-weight-light"><?= $movie->release_date?></p>
        </div>
    </div>
<?php endforeach; ?>
</div>