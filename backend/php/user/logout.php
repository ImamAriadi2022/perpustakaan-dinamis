<?php
    session_start();
    session_unset();
    session_destroy();
    
    $response = [
        'code' => 200,
        'status' => 'success',
        'message' => 'Logout success!',
    ];

    echo json_encode($response);
?>
