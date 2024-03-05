<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Создать договор аренды</title>
</head>
<body>
<form method="POST" action="/rent/create">
    <label for="client">Клиент:</label>
    <input type="text" name="client_id" id="client_id"><br>

    <label for="inventory">Инвентарь:</label>
    <input type="text" name="inventory_id" id="inventory_id"><br>

    <label for="employee">Сотрудник:</label>
    <input type="text" name="employee_id" id="employee_id"><br>

    <label for="active_to">Активен до:</label>
    <input type="date" name="active_to" id="active_to"><br>

    <button type="submit">Submit</button>
</form>
<h1>Свободные предметы(к сожалению я не умею передавать через ajax)</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>price_for_week</th>
        <th>price_for_day</th>
    </tr>
@foreach($Inventories as $Invent)
    <tr>
        <td>{{ $Invent->id }}</td>
        <td>{{ $Invent->name }}</td>
        <td>{{ $Invent->status }}</td>
        <td>{{ $Invent->price_for_week }}</td>
        <td>{{ $Invent->price_for_day }}</td>
    </tr>
@endforeach
</table>
</body>
</html>
