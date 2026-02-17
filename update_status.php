<?php 
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = intval($_POST['id']);
    $status = mysqli_real_escape_string($link, $_POST['status']);

    $sql = "UPDATE documents SET status='$status' WHERE id=$id";
    mysqli_query($link, $sql);
}

header("Location: index.php");
?>