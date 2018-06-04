<!-- cut -->
<div class="container w-50">
    <h2 class="text-center display-3">Profile</h2>
    <?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger" role="alert">
    <?php foreach ($_SESSION['errors'] as $key => $value): ?> 
        <p class=""><strong><?= $key ?></strong> field <?= $value ?></p>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <form action="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'profile'; ?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" class="form-control" id="firstname" <?= !empty($_SESSION['post']['firstname']) ? "value=\"{$_SESSION['post']['firstname']}\"" : "placeholder=\"{$user->firstname}\""; ?>>
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" class="form-control" id="lastname" <?= !empty($_SESSION['post']['lastname']) ? "value=\"{$_SESSION['post']['lastname']}\"" : "placeholder=\"{$user->lastname}\""; ?>>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" <?= !empty($_SESSION['post']['email']) ? "value=\"{$_SESSION['post']['email']}\"" : "placeholder=\"{$user->email}\""; ?>>
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
                <input type="date" name="birthday" class="form-control" id="birthday" min="<?= date('Y-m-d', strtotime('-100 years')); ?>" max="<?= date('Y-m-d', strtotime('-18 years')); ?>" <?= !empty($_SESSION['post']['birthday']) ? "value=\"{$_SESSION['post']['birthday']}\"" : "value=\"{$user->birthday}\""; ?>>
            </div>

            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" id="address" <?= !empty($_SESSION['post']['address']) ? "value=\"{$_SESSION['post']['address']}\"" : "placeholder=\"{$user->address}\""; ?>>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" name="city" class="form-control" id="inputCity" <?= !empty($_SESSION['post']['city']) ? "value=\"{$_SESSION['post']['city']}\"" : "placeholder=\"{$user->city}\""; ?>>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" name="state" class="form-control">
                    <!-- later put value="" on selected option -->
                    <option value="">. . .</option>
                    <option>France</option>
                    <option>England</option>
                    <option>Spain</option>
                    <option>Brazil</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" name="zip" class="form-control" id="inputZip" minlength="5" maxlength="5" <?= !empty($_SESSION['post']['zip']) ? "value=\"{$_SESSION['post']['zip']}\"" : "placeholder=\"{$user->zip}\""; ?>>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
    <div class="row justify-content-end mt-5">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#delete-profile">
            Delete profile
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delete-profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p class="font-weight-bold">Do you really want to delete your profile ?</p>
        <p>You won't be able to recover your account</p>
        <a href="<?= BASE_URI . DIRECTORY_SEPARATOR . 'user' . DIRECTORY_SEPARATOR . 'delete'; ?>" class="btn btn-outline-danger">Delete profile</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>