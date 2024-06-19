<?php
    include('../db.php');

    $query = "SELECT * FROM books";

    $result = $db->query($query);

    $response = array(); // Initialize $response as an empty array

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Memasukkan setiap baris hasil query ke dalam array $response
            $response[] = $row;
        }
        // Output JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Handle case where no results are found
        echo json_encode(array('message' => 0));
    }

    $db->close();
?>
