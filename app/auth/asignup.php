<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['submit'])) {
  //include the database file.

  //get the data from the signup form.
  $first = mysqli_real_escape_string($pd, $_POST['first']);
  $last = mysqli_real_escape_string($pd, $_POST['last']);
  $email = mysqli_real_escape_string($pd, $_POST['email']);
  $uid = mysqli_real_escape_string($pd, $_POST['uid']);
  $pwd = mysqli_real_escape_string($pd, $_POST['pwd']);

  //error handlers to check that the user insert data correctly
  //check for empty fields
  if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)) {
    header("Location: ../signup.php?signup=empty");
    exit();
  } else {
    //check if input chacters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
      header("Location: ../signup.php?signup=invalid");
      exit();
    } else {
      //check if email is invalid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup=email");
        exit();
      } else {
        //connect to database to check if the username already exist in the database

        //return result from database
        // $result = sqlite ????($pd, $sql);

        //check if we have any results
        // $resultCheck = sqlite????($result);

         //check if the user id is taken
         if ($resultCheck > 0) {
           header("Location: ../signup.php?signup=usertaken");
           exit();
         } else {
           //if the user id does not exit, hash the password
           $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
           //Insert the user into the database

           //take the user back to the sign up page
           header("Location: ../signup.php?signup=sucess");
           exit();
         }
      }
    }
  }

} else {
  header("Location: ../signup.php");
  exit();
}

// We should put this redirect in the end of this file since we always want to
// redirect the user back from this file.
redirect('/');
