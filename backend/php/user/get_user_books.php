<?php
    session_start();
    include('../db.php');

    $username = $_SESSION['username'];
    $role_id = $_SESSION['role_id'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT loans.loan_id, books.title, books.author, loans.loan_date, loans.return_date, books.image_url
              FROM loans 
              JOIN users ON loans.user_id = users.user_id
              JOIN books ON loans.book_id = books.book_id
              WHERE users.user_id = '".$user_id."'";

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
