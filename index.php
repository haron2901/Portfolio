<?php
require_once 'sql.php';
?>
<head>
    <link rel="stylesheet" type="text/css" href=style.css>
</head>
<body>
<table class="aboutUsers">
    <thead>
    <tr>
        <th>ID</th>
        <th>NAME</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $output = new sql();
    $result = $output->getAll();

    ?>
    <?php while($row = $result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
        </tr>
<?php } ?>
    </tbody>
</table>

<form action="index.php" method="post">
    <label for="input1">Добавить пользователя</label>
    <input type="text" id="input1" name="input1" placeholder="введите имя"><br><br>

    <input type="submit" name="submit1" value="Отправить"><br>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['submit1'])) {
        $request = $_POST['input1'];
        $output = new sql();
        $output->insert($request);
    } elseif(isset($_POST['submit2'])) {
        $request = $_POST['input2'];
        $output = new sql();
        $output->delete($request);
    }
}
?>

<br><br><br><br><br>

<form action="index.php"  method="post">
    <label for="input2">Какого пользователя удалить?</label>
    <input type="text" id="input2" name="input2" placeholder="введите id"><br><br>

    <input type="submit" name="submit2" value="Удалить">
</form>

</form>
</body>

