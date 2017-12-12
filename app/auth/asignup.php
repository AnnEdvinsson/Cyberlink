<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// $statement = $pdo->query('SELECT * FROM users'); //ska jag välja hela users?
// $?? = $statement->fetchAll(PDO::FETCH_ASSOC);  FF vad ska jag sätta in här

$errors = [];

if (isset($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['userName'], $_POST['password'])) {
    //check if input chacters are valid
    $firstName = trim(filter_var($_POST['firstName'], FILTER_SANITIZE_SPECIAL_CHARS));
    $lastName = trim(filter_var($_POST['lastName'], FILTER_SANITIZE_SPECIAL_CHARS));
    $userName = trim(filter_var($_POST['userName'], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim($_POST['email']);
    //check if email is invalid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'The email is not a valid email address.';
    }
    $password = filter_var($_POST['password']);
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

    //check if the user id is taken
    $query = 'SELECT email FROM users WHERE email=:email';
    $statement = $pdo->prepare($query);
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $email = $statement ->fetchAll(PDO::FETCH_ASSOC);
    if ($query === $email) {
        //take the user back to the login page
        redirect("../../login.php");
    }

    $query = 'INSERT INTO users(email, password, firstName, lastName, userName) VALUES (:email, :password, :firstName, :lastName, :userName )';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    //Bind the parameter/argument to the variable.
    $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':userName', $userName, PDO::PARAM_STR);
    $statement->bindParam(':password', $hashed_pwd, PDO::PARAM_STR);
    // $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    // $statement->bindParam(':avatar', $avatar['name'], PDO::PARAM_STR);
    // When the SQL statement is prepared and all parameters are bound, the query with the execute function runs.
    $statement->execute();

    }
    redirect('../../login.php');
