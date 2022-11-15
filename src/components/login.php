<?php
include "../php/loginBE.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/loginregister.css">
    <title>Login Page</title>
    
</head>
<body>
    <div class='container'>
        <form action="" method="POST" class='login-email'>
        <p style="font-size: 2rem; font-weight: 850;">LOGIN</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password"  required>
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <p class="login-register-text">Don't Have an Account? <a href="register.php">Register Here</a>.</p>
        </form>
    </div>
</body>
</html>