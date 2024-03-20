<?php


session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
$login = $_SESSION['login'];

if($_SESSION['role'] == 'администратор'){
    echo '<a class="btn" href="users.php">Посмотреть всех пользователей</a>';
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Посты</title>
    <link rel="stylesheet" href="css/items.css">
</head>
<body>
<h1 class="greetings">Добро пожаловать, <?php echo $login?>!</h1>
<div class="posts-container">
    <?php
    $conn = new mysqli('localhost', 'root', '', 'miudol');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM news";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['text'] . "</p>";

            // Получаю путь к картинке
            $sql_picture = "SELECT path FROM pictures WHERE id=" . $row['picture_id'];
            $result_picture = $conn->query($sql_picture);
            $picture_row = $result_picture->fetch_assoc();
            $image_path = $picture_row['path'];

            echo "<img src='pictures/" . $image_path . "' alt='Post Picture'>";

            echo "<a href='post_details.php?id=" . $row['id'] . "' class='btn'>Подробнее</a>";
            echo "</div>";
        }
    }
    ?>
</div>
</body>
</html>