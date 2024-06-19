<?php
    session_start();
    include('../db.php');

    // Retrieve and validate the JSON payload
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $user_id = $_SESSION['user_id'];
    $book_id = $data['book_id'];
    $loan_date = date("Y-m-d");
    $return_date = date("Y-m-d", strtotime($loan_date . "+1 month"));

    $query = "INSERT INTO loans (user_id, book_id, loan_date, return_date)
              VALUES ('$user_id', '$book_id', '$loan_date', '$return_date')";

    try {
        $result = $db->query($query);

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Berhasil meminjam buku',
        ];
    } catch (Exception $e) {
        $response = [
            'code' => 400,
            'status' => 'success',
            'message' => 'Gagal meminjam buku karena: ' . $e->getMessage(),
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    $db->close();
?>
