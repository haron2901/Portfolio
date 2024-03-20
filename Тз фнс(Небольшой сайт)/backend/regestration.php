<!DOCTYPE html>
<html>
<head>
  <title>Регистрация</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
<h1>Зарегестрироваться</h1>
<form
        enctype="multipart/form-data"
        method="post"
        action="regestration.php"
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
  <input type="submit" name="regestration" class="buttonsend" value="Войти" />
</form>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['regestration'])){
    $conn = new mysqli('localhost', 'root', '', 'miudol');
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";

    if ($conn->query($sql) === TRUE) {
      echo "Данные успешно сохранены в базе данных!";
    } else {
      echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

  }
}
?>
<h3>Уже зарегестрирован? ><a href="index.php">Войди в свой аккаунт!</a><</h3>
</body>
</html>
