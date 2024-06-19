<?php
    session_start();
    include '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        $result = $db->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['user_id'] = $row['user_id'];
            
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Login success',
                'data' => [
                    'username' => $row['username'],
                    'role_id' => $row['role_id'],
                    'user_id' => $row['user_id']
                ]
            ];

            echo json_encode($response);
        } else {
            $response = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Login failed',
            ];
            http_response_code(401);
            echo json_encode($response);
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

    $db->close();
?>
