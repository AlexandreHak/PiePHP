<div class="container w-50">
    <h2 class="text-center display-3">Sign Up</h2>
    <?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger" role="alert">
    <?php foreach ($_SESSION['errors'] as $key => $value): ?> 
        <p class=""><strong><?= $key ?></strong> field <?= $value ?></p>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form action="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'signup'?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" class="form-control" id="firstname" <?= !empty($_SESSION['post']['firstname']) ? "value=\"{$_SESSION['post']['firstname']}\"" : null; ?>>
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" class="form-control" id="lastname" <?= !empty($_SESSION['post']['lastname']) ? "value=\"{$_SESSION['post']['lastname']}\"" : null; ?>>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" <?= !empty($_SESSION['post']['email']) ? "value=\"{$_SESSION['post']['email']}\"" : null; ?>>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="form-group col-md-6">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" name="confirm-password" class="form-control" id="confirm-password" value="">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="birthday">Birthday</label>
                <input type="date" name="birthday" class="form-control" id="birthday" max="<?= date('Y-m-d', strtotime('-18 years')); ?>" <?= !empty($_SESSION['post']['birthday']) ? "value=\"{$_SESSION['post']['birthday']}\"" : null; ?>>
            </div>

            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" <?= !empty($_SESSION['post']['address']) ? "value=\"{$_SESSION['post']['address']}\"" : null; ?>>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" name="city" class="form-control" id="inputCity" <?= !empty($_SESSION['post']['city']) ? "value=\"{$_SESSION['post']['city']}\"" : null; ?>>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" name="state" class="form-control">
                    <option selected>France</option>
                    <option>England</option>
                    <option>Spain</option>
                    <option>Brazil</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" name="zip" class="form-control" id="inputZip" minlength="5" maxlength="5" <?= !empty($_SESSION['post']['zip']) ? "value=\"{$_SESSION['post']['zip']}\"" : null; ?>>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign in</button>
    </form>
</div>