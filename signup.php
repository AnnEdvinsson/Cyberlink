<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Sign up</h1>

    <form action="app/auth/asignup.php" method="post">
        <div class="form-group">
            <label for="firstName">First name</label>
            <input class="form-control" type="text" name="firstName" placeholder="First name" required>
            <small class="form-text text-muted">Please provide your first name.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastName">Last name</label>
            <input class="form-control" type="text" name="lastName" placeholder="Last name" required>
            <small class="form-text text-muted">Please provide your last name.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="lastName">Username</label>
            <input class="form-control" type="text" name="userName" placeholder="Username" required>
            <small class="form-text text-muted">Please provide your username.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="Password" required>
            <small class="form-text text-muted">Please provide your password.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="biography">Biography</label>
            <input class="form-control" type="text" name="biography">
            <small class="form-text text-muted">Please tell us something about who you are.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="avatar">Choose an image to upload</label>
            <input class="form-control" type="file" name="avatar">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
