<?php
require "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "DELETE ed, ea FROM `emp_dets` ed INNER JOIN `emp_adds` ea ON ed.id = ea.emp_id WHERE ed.id=:id";
        $prepared = $conn->prepare($query);
        $employees = [
            ':id' => $id

        ];
        $query_execute = $prepared->execute($employees);


        if ($query_execute) {
            echo "success";
            header("Location: http://localhost/CRUD/listing1.php");
            exit;
?>
    <?php
        } else {
            echo "deletion failed";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
    ?>
