<?php var_dump($movie); ?>
<div class="container w-50">
    <form action="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' . DIRECTORY_SEPARATOR . 'edit' . '?id=' . $movie->id_movie; ?>" method="post">
        <div class="form-row">
            <div class="col-8">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control <?= isset($_SESSION['errors']['title']) ? 'is-invalid' : ''; ?>" placeholder="<?= $movie->title; ?>">
                <?php if(isset($_SESSION['errors']['title'])): ?>
                <div class="invalid-feedback">
                    <?= $_SESSION['errors']['title']; ?>                        
                </div>
                <?php endif; ?>
            </div>
            <div class="col-4">
                <label for="release_date">Release Date</label>
                <input type="date" name="release_date" id="release_date" class="form-control" maxlength="4">
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="genre">Genre</label>
                <select name="id_genre" class="form-control" id="genre">
                    <option value="">Select genre</option>
                    <?php foreach ($genreList as $genre): ?>
                    <option value="<?= $genre->id_genre ?>"><?= $genre->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="publisher">Publisher</label>
                <select name="id_publisher" class="form-control" id="publisher">
                    <option value="">Select publisher</option>
                    <?php foreach ($publisherList as $publisher): ?>
                    <option value="<?= $publisher->id_publisher ?>"><?= $publisher->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label for="runtime">Runtime</label>
                <input type="number" name="runtime" id="runtime" class="form-control" min="0" placeholder="<?= $movie->runtime; ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="col text-center">
                <label for="overview">Overview</label>
                <textarea name="overview" id="overview" class="form-control" style="height:180px"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col text-center">
                <label for="poster">Poster Path</label>
                <input type="text" name="poster_path" id="poster" class="form-control" placeholder="<?= !empty($movie->poster_path) ? $movie->poster_path : 'Optional (get it from tmdb)'; ?>">
            </div>
            <div class="col text-center">
                <label for="id_tmdb">TMDB ID</label>
                <input type="text" name="id_tmdb" id="id_tmdb" class="form-control" placeholder="<?= !empty($movie->id_tmdb) ? $movie->id_tmdb : 'Optional (get it from tmdb)'; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 btn-block">Edit</button>
    </form>
    <a href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' . DIRECTORY_SEPARATOR . 'delete?id=' . $movie->id_movie; ?>" class="btn btn-outline-danger mt-5">Delete</a>
</div>