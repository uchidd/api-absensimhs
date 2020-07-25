<?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "db_presensimhs";
    
        $_AUTH = mysqli_connect($server,$username,$password,$database) or die ("Connection failed.");
        
        if($_AUTH) {
            echo json_encode(array(
                "message" => "Congratulation!, your connection is successfully.", 
                "code" => 200, 
                "status" => true)
            );
        }
?>