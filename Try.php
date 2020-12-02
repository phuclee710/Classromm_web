<?php
    
    session_start();
    
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'account_manager');

    function connection()
    {
        $conn = new mysqli(HOST, USER, PASS,DB);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    $username = 'luuquyen1909@gmail.com';
    
    $sql = "select * from account where email = ?";
    $conn = connection();
    
    $stm = $conn->prepare($sql);
    $stm->bind_param('s', $username);
    if (!$stm->execute())
    {
        return null;
    }
    $result = $stm->get_result();

    print_r($result);

?>