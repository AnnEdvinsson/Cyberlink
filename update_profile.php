<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';


$statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}
$statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
$statement->execute();

//fetch the user from the database
$user = $statement->fetch(PDO::FETCH_ASSOC);
// var_dump($user);


if (isset($_POST['user_id'], $_POST['userName'], $_POST['bio'])) {
    $user_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $userName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

    //Update users biography
    $query = 'UPDATE users SET userName = :userName, bio = :bio WHERE user_id = :user_id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':userName', $userName, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);

    $statement->execute();
    // die(var_dump($query));
}

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $avatar_info = pathinfo($_FILES['avatar']['name']); //Creates array out of 'name'
    $ext = $avatar_info['extension']; //Chooses 'extension' out of 'name'
    $fileName = $_SESSION['user']['userName'].'.'.$ext;
// die(var_dump($ext));
    move_uploaded_file($avatar['tmp_name'], __DIR__.'/avatars/'.$fileName);



    // $query = "UPDATE users SET avatar = :avatar WHERE user_id = :user_id";

    $statement = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE user_id = :user_id");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':avatar', $fileName, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $statement->execute();
    // die(var_dump($query));
}

?>


<div class="container">

    <div class="row pt-5 justify-content-center">
        <div class="col-md-6">
            <form  action="update_profile.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

                <div class="form-group">
                    <label for="title">Username</label>
                    <input class="form-control" type="text" name="userName" value="<?php echo $user['userName']; ?>">
                </div><!-- /form-group -->

                <img src="
                <?php if (isset($user['avatar'])): ?>
                    <?php echo "/avatars/".$user['avatar'] ?>
                <?php else: echo "/images/rainbow-unicorn.png" ?>
                <?php endif; ?>" alt="avatar"></img>

                <div class="form-group">
                    <label for="avatar">Change profile picture</label>
                    <input class="form-control" type="file" name="avatar" accept = ".png, .jpg, .jpeg">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

                <div class="form-group">
                    <label for="title">Biography</label>
                    <textarea class="form-control" name="bio" rows="8" cols="80"><?php echo $user['bio']; ?></textarea>
                    <small class="form-text text-muted">Please tells us something about you.</small>
                </div><!-- /form-group -->

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div><!-- /col-md-6 -->
    </div><!-- /row -->
</form>
</div><!-- /col-md-6 -->
</body>
</html>
<?php require __DIR__.'/views/footer.php'; ?>
