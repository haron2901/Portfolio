<h1>Search Employees by Name</h1>
<form action="/employees/search" method="GET">
    <label for="name">Search by Name:</label>
    <input type="text" id="name" name="name">
    <button type="submit">Search</button>
</form>


@foreach($employees as $employ)
    <h1>Найден сотрудник</h1>
    <h2>Id = {{$employ['id']}}</h2>
    <h2>Имя = {{$employ['name']}}</h2>
    <h2>Прибыль = {{$employ['revenue']}}</h2>
@endforeach
