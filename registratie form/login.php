<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user =  $result->fetch_assoc();

    if ($user) {

       if (password_verify($_POST["password"], $user["password_hash"])) {

           session_start();

           session_regenerate_id();

           $_SESSION["user_id"] = $user["id"];

           header("Location: home.php");
           exit;
       }
    }
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inlog pagina</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-vak">
    <h1>Inloggen</h1>


    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password">

        <button type="submit" name="submit">Inloggen</button>
        <p class="text">Heb je nog geen account?
            <a href="registreren.html" >Klik op deze link om je te registeren!</a>
        </p>
    </form>
</div>
</body>
</html>