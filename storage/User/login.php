<div class="container">
    <div class="row justify-content-center">
        <h2 class="display-3">Login</h2>
    </div>

    <?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger" role="alert">
        <p><?= $_SESSION['errors']; ?></p>
    </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <form action="./login" method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="">
        </div>
        <button type="submit" class="btn btn-outline-primary w-100">Submit</button>
        </form>
    </div>
</div>