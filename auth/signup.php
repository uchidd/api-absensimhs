<?php
    include '../config/connection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $access_for = trim($_POST['access_for']);
        $id_code = trim($_POST['id_code']);
        $nama_lengkap = trim($_POST['nama_lengkap']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        $_query_cekuser_exist = mysqli_query($_AUTH, "SELECT * FROM tbl_user WHERE username = '$username'");
        $_execute_cekuser_exist = mysqli_num_rows($_query_cekuser_exist);

        $_response = array();
        if ($_execute_cekuser_exist > 0) {
            $_response["message"] = trim("Username already exist! Try again.");
            $_response["code"] = 400;
            $_response["status"] = false;

            echo json_encode($_response);
        } else {
            $_query_insert_new_user = "INSERT INTO tbl_user (access_for, id_code, nama_lengkap, username, password, email) VALUES ('$access_for', '$id_code', '$nama_lengkap', '$username', '$password', '$email')";
            $_execute_register = mysqli_query($_AUTH, $_query_insert_new_user);

            $_query_cekuser_exist = mysqli_query($_AUTH, "SELECT * FROM tbl_user WHERE username_user = '$username'");

            if ($_execute_register > 0) {
                $_response["data_user"] = array();

                while ($row = mysqli_fetch_array($_query_cekuser_exist)) {
                    $data = array();

                    $data["kode_user"] = $row["kode_user"];
                    $data["access_for"] = $row["access_for"];
                    $data["id_code"] = $row["id_code"];                    
                    $data["nama_lengkap"] = $row["nama_lengkap"];
                    $data["username"] = $row["username"];
                    $data["password"] = $row["password"];
                    $data["email"] = $row["email"];

                    $_response["message"] = trim("You have been registered.");
                    $_response["code"] = 200;
                    $_response["status"] = true;

                    array_push($_response["data_user"], $data);
                }
                echo json_encode($_response);
            } else {
                $_response["message"] = trim("Failed to registered.");
                $_response["code"] = 400;
                $_response["status"] = false;

                echo json_encode($_response);
            }
        }
    } else {
        $_response["message"] = trim("Forbiedden.");
        $_response["code"] = 400;
        $_response["status"] = false;

        echo json_encode($_response);
    }
?>