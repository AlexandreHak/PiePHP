<div class="container d-flex flex-column">
    <div class="row justify-content-center">
        <div class="col-3">
            <form class="add-genre">
                <div class="form-row">
                    <div class="col">
                        <input type="text" name="name" class="form-control" placeholder="Genre">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-12 ">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

        <div class="col-4 text-center">
            <ul class="list-group list-group-flush genre-list">
            <?php foreach ($genreList as $genre): ?>
                <li class="list-group-item"><?= $genre->name; ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>