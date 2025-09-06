<?php
include 'config.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM Livres ORDER BY titre";
$result = $conn->query($sql);

$books = array();
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

echo json_encode($books);

$conn->close();
?>