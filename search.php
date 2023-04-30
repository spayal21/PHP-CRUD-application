<?php
require "config.php";
if (isset($_GET['search'])) {

$val = $_GET['valueToSearch'];
$query = "SELECT * FROM `emp_dets` ed INNER JOIN `emp_adds` ea ON (ed.id=ea.emp_id) WHERE  name LIKE :name or email like :email or pos like :pos";
$prepared = $conn->prepare($query);
$employee = [
    ':name' => '%' . $val . '%',
    ':email' => '%' . $val . '%',
    ':pos' => '%' . $val . '%',
];

$prepared->execute($employee);
$employees = $prepared->fetchAll(PDO::FETCH_ASSOC);
if ($employees) { ?>
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
<?php
}
} ?>
</body>

</html>