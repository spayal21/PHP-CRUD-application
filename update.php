<?php
require('config.php');
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mail = $_POST['email'];
    $pos = $_POST['pos'];
    try {
        $query = "UPDATE `emp_dets` ed INNER JOIN `emp_adds` ea ON (ed.id=ea.emp_id) SET ed.name=:name,ed.email=:email,ea.pos=:pos WHERE ed.id=:id ";
        $prepared = $conn->prepare($query);
        $employee = [
            ':name' => $name,
            ':email' => $mail,

            ':pos' => $pos,
            ':id' => $id,
        ];

        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pos'])) {
            echo "fill all the fields";
        } else {
            $query_execute = $prepared->execute($employee);
            if ($query_execute) {
                header("Location: http://localhost/CRUD/listing1.php");
                exit;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
