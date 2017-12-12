<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_FILES['avatar'])) {

    $avatar = $_FILES['avatar'];
    //check if the avatar image is the right file type
    if (!in_array($avatar['type'], ['avatar/jpeg', 'avatar/jpg', 'avatar/png'])) {
        $errors[] = 'The file type is not allowed';
    }
    //check if the avatar image is the right file size, maximum 2MB
    if($avatar['size'] > 2000000) {
        $error[] = 'The file is larger than 2 megabyte.';
    }
    // If there are any errors in the array, upload the file. DB ska vi uploada el till db?
    if (count($errors) === 0) {
        $destination = __DIR__.'/../../avatars/'.$avatar['name'];//DB vilken är den korrekta sökvägen?
        //upload file from the temporary path to a new destination.
        move_uploaded_file($avatar['tmp_name'], $destination);
    }
    $query = 'INSERT INTO users(avatar) VALUES (:avatar)';

    $statement = $pdo->prepare($query);

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    //Bind the parameter/argument to the variable.
    $statement->bindParam(':avatar', $avatar['name'], PDO::PARAM_STR);

    // When the SQL statement is prepared and all parameters are bound, the query with the execute function runs.
    $statement->execute();
}

if(isset($_POST['bio'])){
$bio = trim(filter_var($_POST['bio'], FILTER_SANITIZE_SPECIAL_CHARS));
$query = 'INSERT INTO users(bio) VALUES (:bio)';

$statement = $pdo->prepare($query);

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->execute();
}
