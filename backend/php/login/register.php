<?php
    include '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $query = "INSERT INTO users (username, password, role_id)
                  VALUES ('$username', '$password', 2)";

        try {
            $db->query($query);

            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Registrasi sukses, silahkan login'
            ];

            echo json_encode($response);
        } catch (Exception $e) {
            $response = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Failed to add user into database: ' . $e->getMessage(),
            ];
            echo json_encode($response);
            die();
        }
    } else {
        $response = [
            'code' => 405,
            'status' => 'error',
            'message' => 'Invalid request method',
        ];
        http_response_code(405);
        echo json_encode($response);
    }
?>
