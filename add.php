<?php 
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $author = mysqli_real_escape_string($link, $_POST['author']);
    $responsible = mysqli_real_escape_string($link, $_POST['responsible']);
    $description = mysqli_real_escape_string($link, $_POST['description']);

    $sql = "INSERT INTO documents (title, author, responsible, description) 
            VALUES ('$title', '$author', '$responsible', '$description')";

    if (mysqli_query($link, $sql)) {
        header("Location: index.php?success=1");
    } else {
        header("Location: index.php?error=" . urlencode(mysqli_error($link)));
    }
    exit;
}
?>