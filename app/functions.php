<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}
//function to show database info on profile page
function userInfo($pdo){
    $user_id = (int)$_SESSION['user']['user_id'];
$query = "SELECT * FROM users WHERE user_id = :user_id";
$statement = $pdo->prepare($query);
$statement ->bindParam(':user_id', $user_id,PDO::PARAM_INT);
$statement->execute();

$resultQuery = $statement->fetchAll(PDO::FETCH_ASSOC);
return $resultQuery;
}
