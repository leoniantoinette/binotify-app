<?php
include "../config/config.php";

session_start();
error_reporting(0);

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password_1'];
    $_cppassword = $_POST['password_2'];
    //enkripsi password
    if ($password == $_cppassword) {
        //enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM user WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (username, email, password,isAdmin) VALUES ('$username', '$email', '$password',0)";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Registration Successful!')</script>";
                $username = "";
                $email = "";
                $_POST['password_1'] = "";
                $_POST['password_2'] = "";
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['isAdmin'] = 0;
                header("location: ../homepageUser.php");
            } else {
                echo "<script>alert('Registration Failed!')</script>";
            }
        } else {
            echo "<script>alert('Username OR Email Already Exists!')</script>";
        }
    } else {
        echo "<script>alert('Password and Confirm Password does not match!')</script>";
    }
}
