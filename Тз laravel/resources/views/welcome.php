<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Пират Касеткин</title>
</head>
<body>
<h1 class="title" style="margin-left: 80vh; color: #bf0909">Страница создания</h1>
<a href="/Rent" style="font-size: 40px">Страница создания аренд</a><br>
<a href="/employee" style="font-size: 40px">Страница поиска сотрудников по имени</a>

<br>
<h1>Создать или удалить сотрудника магазина</h1>
<form method="POST" action="/employees/create" name="employeeForm">

    <input type="text" name="name" placeholder="Имя сотрудника" required>

    <button type="submit">Создать сотрудника</button>
</form></br>
<form method="POST" action="/employees/delete">

    <input type="text" name="name" placeholder="Имя сотрудника" required>

    <button type="submit">Удалить сотрудника</button>

</form>
<h1>Создать Покупателя</h1>
<form method="POST" action="/client/create" name="clientForm">

    <input type="text" name="name" placeholder="Имя сотрудника" required>

    <button type="submit">Создать сотрудника</button>
</form>
<br><br><br><br><br>
<h3>добавить инвентарь</h3>
<form action="/inventory/create" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="price_for_day">Price for day:</label><br>
    <input type="text" id="price_for_day" name="price_for_day"><br>
    <label for="price_for_week">Price for week:</label><br>
    <input type="text" id="price_for_week" name="price_for_week"><br>
    <button type="submit">Create Inventory</button>
</form>
<br><br>
<h3>удалить инвентарь</h3>
<form action="/inventory/delete" method="post">
    <label for="id">Inventory ID:</label><br>
    <input type="text" id="id" name="id"><br>
    <button type="submit">Delete Inventory</button>
</form>
<br><br>
<h1>Изменить 1 слот инвентаря</h1>
<form action="/inventory/update" method="POST">
    <label for="id">Id слота инвентаря:</label>
    <input type="text" id="id" name="id"><br><br>

    <label for="name">Имя:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="price_for_day">Цена за день:</label>
    <input type="text" id="price_for_day" name="price_for_day"><br><br>

    <label for="price_for_week">Цена за неделю:</label>
    <input type="text" id="price_for_week" name="price_for_week"><br><br>

    <button type="submit">Обновить слот</button>
</form>
</body>
</html>


