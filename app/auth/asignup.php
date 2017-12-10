<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$errors = [];

if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['userName'], $_POST['pwd'], $_POST['bio'], $_POST['avatar'])) {
    //check if input chacters are valid
    $firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_SPECIAL_CHARS));
    $lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim($_POST['email']);
    //check if email is invalid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'The email is not a valid email address.';
    }
    $userName = trim(filter_var($_POST['userName'], FILTER_SANITIZE_SPECIAL_CHARS));
    $pwd = trim(filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS));//DB vilka krav här?
    $bio = trim(filter_var($_POST['bio'], FILTER_SANITIZE_SPECIAL_CHARS));
    $avatar = $_FILES['avatar'];
    //check if the avatar image is the right file type
    if (!in_array($avatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
        $errors[] = 'The file type is not allowed';
    }
    //check if the avatar image is the right file size, maximum 2MB
    if($avatar['size'] > 2000000) {
        $error[] = 'The file is larger than 2 megabyte.';
    }
    // If there are any errors in the array, upload the file. DB ska vi uploada el till db?
    if (count($errors) === 0) {
        $destination = __DIR__.'/uploads/'.$avatar['name'];//DB vilken är den korrekta sökvägen?
    //upload file from the temporary path to a new destination.
          move_uploaded_file($avatar['tmp_name'], $destination);
    }




    //include the database file.
    //DB
    //get the data from the asignup form.
    $firstName = mysqli_real_escape_string($pdo, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($pdo, $_POST['lastName']);
    $email = mysqli_real_escape_string($pdo, $_POST['email']);
    $userName = mysqli_real_escape_string($pdo, $_POST['userName']);
    $pwd = mysqli_real_escape_string($pdo, $_POST['pwd']);
    $bio = mysqli_real_escape_string($pdo, $_POST['bio']);
    $avatar = mysqli_real_escape_string($pdo, $_POST['avatar']);


                //connect to database to check if the username already exist in the database
                //DB
                //return result from database
                // $result = sqlite ????($pd, $sql);
                //DB
                //check if we have any results
                // $resultCheck = sqlite????($result);
                //DB
                //check if the user id is taken
                if ($resultCheck > 0) {
                    redirect("../../signup.php");
                } else {
                    //if the user id does not exit, hash the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    //
                    //take the user back to the login page
                    redirect("../../login.php");
                }
            } else {
    redirect("../../login.php");
}
