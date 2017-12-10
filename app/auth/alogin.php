<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$errors = [];

// Check if both email and password exists in the POST request.
if (isset($_POST['email'], $_POST['password'])) {

    // The trim function removes any unwanted spaces.
    $email =trim($_POST['email']);

    //Check if the inputed value is empty or not.
    if(empty($email)) {
        $errors[] ='The email field is empty';
    }
    //filter_var function to validate the input data. If the
    // function returns false the value of $_POST['email'] isn't
    // a valid email address.
    if (!filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) {
        $errors[] ='The email is not a valid email address.';
    }
    $password = filter_var($_POST['password']);

    // Prepare, bind email parameter and execute the database query.
    $checkUser = $pdo->prepare("SELECT email FROM users WHERE email=:email");
    $checkUser ->bindParam(':email', $email, PDO::PARAM_STR);
    $checkUser -> execute();
    // Fetch the result as an associative array.
    $user = $checkUser->fetch(PDO::FETCH_ASSOC);

    // If the user is not in the database, the user will be redirected to
    // the signup page with the redirect function.
    if(!$user) {
        redirect("../../signup.php");
    }
    //If the user is in the database, the given password from the request
    // is compared with the one in the database using the password_verify function.
    if (password_verify($_POST['password'], $user['password'])) {
        //If password is correct the user but not the password will be saved in the session.
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}
// redirect the user
redirect('/');
