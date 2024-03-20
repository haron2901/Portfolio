<?php
session_start();

if(isset($_POST['loginButton'])) {
  $login = $_POST['login'];
  $password = $_POST['password'];
  $conn = new mysqli("localhost", "root", "", "miudol");


$query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
$result = $conn->query($query);
if ($result->num_rows == 1) {

  $_SESSION['logged_in'] = true;
  $_SESSION['login'] = $login;

  $result = $conn->query("SELECT role FROM users WHERE login='$login' AND password='$password'");
  $row = $result->fetch_assoc();
  $_SESSION['role'] = $row['role'];

  header("Location: items.php");
  exit;
} else {
  echo '404 error';
  return '404 error';
  exit;
}
}
?>
<!DOCTYPE html>
<head>
  <title>Вход</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
<h1>Войти в аккаунт</h1>
<form
    enctype="multipart/form-data"
    method="post"
    action="index.php"
>
  <div class="titlecontainer">ВХОД</div>
  <div>
    <input
        class="inputlogin"
        type="text"
        name="login"
        placeholder="Логин"
    />
  </div>
  <div>
    <input
        class="inputlogin"
        type="text"
        name="password"
        placeholder="Пароль"
    />
  </div>
  <input type="submit" name="loginButton" class="buttonsend" value="Войти" />
</form>

<h3>Не зарегестрирован? ><a href="regestration.php">Исправь это!</a><</h3>
</body>
