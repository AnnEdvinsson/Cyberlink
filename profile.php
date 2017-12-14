<?php require __DIR__.'/views/header.php'; ?>

<div class="article">
    <h1><?php echo $config['title']; ?></h1>
    <p>Welcome, <?php echo $_SESSION['user']['firstName']; ?>!</p>
    <p>This is your profile page.</p>

<div>

    <?php if (isset($_SESSION['user'])): ?>
        <img class="avatar" src=" <?php if(isset($_SESSION['user']['avatar'])): ?>
              <?php echo $_SESSION['user']['avatar']; ?>
          <?php else: echo "/images/kurt_russel.jpg"; ?>
          <?php endif; ?>" alt="">
    <?php endif;
// var_dump($_SESSION['user']);?>
</div>



<!-- Looping user info with function userInfo to show on profile page -->
<?php $infos = userInfo($pdo) ?>
<?php foreach ($infos as $info):?>
<p>Username: <?php echo $info['userName']; ?></p>
<p>Biography: <?php echo $info['bio']; ?></p>

<?php endforeach; ?>

</div>

<a href="update_profile.php">Update your profile</a>



<?php require __DIR__.'/views/footer.php'; ?>
