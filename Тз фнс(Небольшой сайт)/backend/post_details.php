<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали поста</title>
    <link rel="stylesheet" href="css/post_details.css">
</head>
<body>
<div class="container">
    <?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'miudol');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST['edit-post'])) {
        $newText = $_POST['edit-textarea'];
        $postId = $_GET['id'];

        $updateQuery = "UPDATE news SET text='$newText' WHERE id=$postId";
        $conn->query($updateQuery);
    }

    if(isset($_POST['delete-post'])) {
        $postId = $_GET['id'];


        $deleteQuery = "DELETE FROM news WHERE id=$postId";
        $conn->query($deleteQuery);
    }
    ?>
    <form method="post" action="post_details.php?id=<?php echo $_GET['id']; ?>">
        <?php

        if ($_SESSION['role'] == 'модератор' || $_SESSION['role'] == 'администратор') {
            // Добавляем кнопки и поле для редактирования поста
            echo "<button type='submit' name='edit-post' class='edit-btn'>Редактировать пост</button>";
            echo "<button type='submit' name='delete-post' class='delete-btn'>Удалить пост</button>";
            echo "<input type='text' placeholder='Новый текст поста' name='edit-textarea' class='edit-textarea'>";
        }
        ?>
    </form>
    <?php
    //Вывод данных
    if (isset($_GET['id'])) {
        $post_id = $_GET['id'];
        $sql = "SELECT n.title, n.text, p.path
                    FROM news n
                    JOIN pictures p ON n.picture_id = p.id
                    WHERE n.id = $post_id";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<h1>" . $row['title'] . "</h1>";
            echo "<img src='pictures/" . $row['path'] . "' alt='Post Picture'>";
            echo "<p>" . $row['text'] . "</p>";
        } else {
            echo "<p>Пост не найден.</p>";
        }
    }

    $conn->close();
    ?>
</div>
</body>
</html>