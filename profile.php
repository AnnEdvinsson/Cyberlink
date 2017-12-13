<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Welcome, <?php echo $_SESSION['user']['firstName']; ?>!</p>
    <p>This is your profile page.</p>

    <?php if (isset($_SESSION['user'])): ?>
        <img class="avatar" src=" <?php if(isset($_SESSION['user']['avatar'])): ?>
              <?php echo $_SESSION['user']['img']; ?>
          <?php else: echo "/images/kurt_russel.jpg"; ?>
          <?php endif; ?>" alt="">
          <div class="form-group">
              <label for="avatar">Change profile picture</label>
              <input class="form-control" type="file" name="avatar" accept = ".png, .jpg, .jpeg">
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
    <?php endif; ?>

<!-- Looping user info with function userInfo to show on profile page -->
<?php $infos = userInfo($pdo) ?>
<?php foreach ($infos as $info):?>
<p>Username: <?php echo $info['userName']; ?></p>
<p>Biography: <?php echo $info['bio']; ?></p>

<?php endforeach; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
