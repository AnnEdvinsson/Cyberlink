<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Sign up</h1>

<!-- If the errors array contains any errors, error message will display to the user.
If not, a welcome message will show.  -->
    <?php if (isset($errors)): ?>
               <?php if (count($errors) > 0): ?>
                   <ol>
                       <?php foreach ($errors as $error): ?>
                           <li><?php echo $error; ?></li>
                       <?php endforeach; ?>
                   </ol>
               <?php else: ?>
                   <p><?php echo 'Welcome to Cyberlink'; ?></p>
               <?php endif; ?>
           <?php endif; ?>

    <form action="app/auth/asignup.php" method="post" enctype="multipart/form-data">
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
            <label for="userName">Username</label>
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
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
