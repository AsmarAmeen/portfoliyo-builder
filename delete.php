<?php
include("config.php");

$id = $_GET['id'];

$sql = "DELETE FROM Form WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view.php");
} else {
    echo "Error: " . $conn->error;
}
?>
