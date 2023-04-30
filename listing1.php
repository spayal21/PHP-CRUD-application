<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
$query = "SELECT ed.id, ed.name, ed.email ,ea.pos FROM emp_dets ed INNER JOIN emp_adds ea ON ed.id=ea.emp_id";
$prepared = $conn->prepare($query);
$prepared->execute();
$employees = $prepared->fetchAll(PDO::FETCH_ASSOC);
?>
<html>

<head>
    <style>
        body {
            margin: 50px;
            text-align: center;
        }
    </style>
</head>

<body>
    <form method="GET" action="search.php">
    <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
    <input type="submit" name="search" value="Filter"><br><br></form>
            <table border="1" cellpadding="10" cellspacing="0" align="center">
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>POSITION</th>
                <th>ACTION</th>
                <th>ACTION</th>
                <?php

                foreach ($employees as $employee) {

                ?>
                    <tr>
                        <td><?= $employee['id']; ?> </td>
                        <td><?= $employee['name']; ?> </td>
                        <td><?= $employee['email']; ?> </td>
                        <td><?= $employee['pos']; ?> </td>
                        <td>
                            <a href="edit.php?id=<?= $employee['id'] ?>"> Edit</a>
                        </td>
                        <td>
                            <a href="delete.php?id=<?= $employee['id'] ?>"> Delete</a>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </table>

</body>

</html>