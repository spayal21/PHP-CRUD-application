<?php
require "./config.php";
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT ed.id,ed.name,ed.email,ea.pos FROM emp_dets ed INNER JOIN emp_adds ea ON (ed.id=ea.emp_id) WHERE ed.id=:id";
    $prepared = $conn->prepare($query);
    $employee = ['id' => $id];
    $prepared->execute($employee);
    $employees = $prepared->fetch(PDO::FETCH_OBJ);
}
?>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?= $employees->id; ?>"><br>
        NAME:<input type="text" name="name" value="<?= $employees->name; ?>"><br>
        EMAIL:<input type="email" name="email" value="<?= $employees->email; ?>"><br>
        POSITION:<input type="text" name="pos" value="<?= $employees->pos; ?>"><br>
        <button type="submit" name="update" id="update">Update </button>
    </form>

</body>

</html>