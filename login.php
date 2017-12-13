<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <form action="app/auth/alogin.php" method="post">
        <div class="form-group">
            <!-- se extra uppgift project structure om meddelande för att användaren redan finns-->
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <small class="form-text text-muted">First time on Cyberlink?</small>
    <a href="signup.php">Sign up here</a>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
