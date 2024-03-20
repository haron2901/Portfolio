<?php
$conn = new mysqli('localhost', 'root', '', 'miudol');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'];
    $newRole = $_POST['newRole'];

    $sql = "UPDATE users SET role='$newRole' WHERE id=$userId";
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Роль изменена успешно!</h1>";
    } else {
        echo "Error updating role: " . $conn->error;
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Login</th><th>Role</th><th>Password</th><th>Created At</th><th>Updated At</th><th>Update Role</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td><td>".$row["login"]."</td><td>".$row["role"]."</td><td>".$row["password"]."</td><td>".$row["created_at"]."</td><td>".$row["updated_at"]."</td>";
        echo "<td><form method='post'><input type='hidden' name='userId' value='".$row["id"]."'><input type='text' name='newRole' value='".$row["role"]."'><input type='submit' value='Save'></form></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>