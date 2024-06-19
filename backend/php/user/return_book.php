<?php
    include('../db.php');

    // Retrieve and validate the JSON payload
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $loan_id = $data['loan_id'];

    $query = "DELETE FROM loans WHERE loan_id = '$loan_id'";

    try {
        $result = $db->query($query);

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Berhasil mengembalikan buku',
        ];
    } catch (Exception $e) {
        $response = [
            'code' => 400,
            'status' => 'success',
            'message' => 'Gagal mengembalikan buku karena: ' . $e->getMessage(),
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);

    $db->close();
?>
