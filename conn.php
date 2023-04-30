<?php
require "config.php";
$name = "";
$mail = "";
$pos = "";

if (isset($_POST['add'])) {
    if (empty($_POST['name'])) {
        echo "name required <BR>";
    } elseif (empty($_POST['email'])) {
        echo "email required <br>";
    } elseif (empty($_POST['pos'])) {
        echo "position required <br>";
    } else {
        $name = $_POST['name'];
        $mail = $_POST['email'];
        $pos = $_POST['pos'];
        $stmt = $conn->prepare("INSERT INTO emp_dets (name, email) VALUES (:name, :email)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $mail);
        $stmt->execute();
        $last_id = $conn->lastInsertId();
        $stmt = $conn->prepare("INSERT INTO emp_adds (pos,emp_id) VALUES (:pos,:last_id)");
        $stmt->bindParam(':pos', $pos);
        // $stmt->bindParam(':emp_id',$last_id);
        $stmt->bindParam(':last_id', $last_id);

        $stmt->execute();
    }
    $name = "";
    $mail = "";
    $pos = "";
} elseif (isset($_POST['edit'])) {
    header("Location: http://localhost/CRUD/listing1.php");
    exit;
}


$conn = null;

require "form.html";
