<div class="container">
    <div class="row">
        <div class="col-6">
            <form class="form-inline">
                <div class="fluid-container">
                    <label for="movie-search">Search in TMDB</label>
                    <input class="form-control mr-2 movie-search" type="search" placeholder="Search">
                </div>
            </form>
            <div class="list-group movie-search-list">
                <!-- movie list goes here -->
            </div>
        </div>
        
        <div class="col">
            <form action="<?= BASE_URI . DIRECTORY_SEPARATOR . 'movie' . DIRECTORY_SEPARATOR . 'add'; ?>" method="post">
                <div class="form-row">
                    <div class="col-8">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control <?= isset($_SESSION['errors']['title']) ? 'is-invalid' : ''; ?>" <?= isset($_SESSION['post']['titre']) ? 'value=' . $_SESSION['post']['genre'] : 'placeholder="Enter movie title"'; ?>>
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
                            <option value="<?= $genre->name ?>"><?= $genre->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="publisher">Publisher</label>
                        <select name="id_publisher" class="form-control" id="publisher">
                            <option value="">Select publisher</option>
                            <?php foreach ($publisherList as $publisher): ?>
                            <option value="<?= $publisher->name ?>"><?= $publisher->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="runtime">Runtime</label>
                        <input type="number" name="runtime" id="runtime" class="form-control" min="0" placeholder="90">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col text-center">
                        <label for="overview">Overview</label>
                        <textarea name="overview" id="overview" class="form-control"><?= isset($_SESSION['post']['overview']) ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col text-center">
                        <label for="poster">Poster Path</label>
                        <input type="text" name="poster_path" id="poster" class="form-control" placeholder="Optional (get it from tmdb)">
                    </div>
                    <div class="col text-center">
                        <label for="id_tmdb">TMDB ID</label>
                        <input type="text" name="id_tmdb" id="id_tmdb" class="form-control" placeholder="Optional (get it from tmdb)">
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary mt-3 btn-block">Add</button>
            </form>
        </div>
    </div>
</div>