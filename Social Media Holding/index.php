<?php

// Подключение к базе данных
$servername = "localhost"; // Адрес сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль пользователя базы данных
$dbname = "php"; // Имя базы данных

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение всех продуктов с API
$json = file_get_contents("https://dummyjson.com/products");
$data = json_decode($json, true);

// Фильтрация продуктов "iPhone"
$iphoneProducts = array_filter($data['products'], function($product) {
    return strpos($product['title'], 'iPhone') !== false;
});

// Добавление продуктов в базу данных
foreach ($iphoneProducts as $product) {
    $title = $product['title'];
    $description = $product['description'];
    $price = $product['price'];
    $discountPercentage = $product['discountPercentage'];
    $rating = $product['rating'];
    $stock = $product['stock'];
    $brand = $product['brand'];
    $category = $product['category'];
    $thumbnail = $product['thumbnail'];

    $sql = "INSERT INTO products (title, description, price, discountPercentage, rating, stock, brand, category, thumbnail)
            VALUES ('$title', '$description', $price, $discountPercentage, $rating, $stock, '$brand', '$category', '$thumbnail')";

    if ($conn->query($sql) === true) {
        echo "Продукт $title успешно добавлен.<br>";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

// Закрытие соединения с базой данных
$conn->close();

