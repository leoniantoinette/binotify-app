<?php
include "../php/registerBE.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/loginregister.css">
    <title>Register Page</title>
    
</head>
<body>
    <div class='container'>
        <form action="" method="POST" class='login-email'>
            <p style="font-size: 2rem; font-weight: 850;">REGISTER</p>
            <div class="input-group">
                <input type="text" placeholder="Username" id='username' name="username" required>
                <span id="errorMsgUsername"></span>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" id='email' required>
                <span id="errorMsgEmail"></span>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" id='password_1' name="password_1" required>
                <span id="errorMsgPassword1"></span>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Confirm Password" id='password_2' name="password_2" required>
                <span id="errorMsgPassword2"></span>
            </div>
            <div class="input-group">
                <button type="submit" id='submit' name="register" class="btn" onclick= handleSubmit() >Register</button>
            </div>
            <p class="login-register-text">Already Have an Account? <a href="login.php">Login Here</a>.</p>
        </form>
    </div>
    <script src="../script/register.js"></script>
</body>
</html>