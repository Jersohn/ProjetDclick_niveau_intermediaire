<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['query'])) {
    $query = '%' . $conn->real_escape_string($_GET['query']) . '%';

    $sql = "SELECT * FROM Livres WHERE titre LIKE ? OR auteur LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $result = $stmt->get_result();

    $books = array();
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    echo json_encode($books);
} else {
    echo json_encode(array('error' => 'Aucune requête spécifiée'));
}

$conn->close();
?>