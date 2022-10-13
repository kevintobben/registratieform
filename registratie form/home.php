<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user 
                WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bierhuis de Tweenies </title>
    <link rel="stylesheet" href="home.css">

<body>
<header class="container">
    <?php if (isset($user)): ?>
    <h2>Welkom, <?= htmlspecialchars($user["name"]) ?></h2>

    <a class="uitlog" href="index.html">
        <button class="uitloggen">Uitloggen</button>
    </a>
</header>
<?php else: ?>

<?php endif ?>
</body>
</html>

