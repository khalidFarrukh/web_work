
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/login.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <script src="./script.js"></script>
    <title>Coffee Shop</title>
</head>

<body>
    <div class="left_colm">
        <img src="./images/logo.png" alt="" id="logo">
    </div>
    <div class="right_colm">
        <form method="POST" action="login_check.php" id="login_form">
        <div class="login_form_row">
                <div class="input_field_normal">
                    <img src="./images/useracc.png" alt="" id="user_icon">
                    <input type="text" name="userName" id="username_input" placeholder="User Name" required>
                </div>
            </div>
            <div class="login_form_row">
                <div class="input_field_normal">
                    <img src="./images/key.png" alt="" id="key_icon">
                    <input type="password" name="passWord" id="password_input" placeholder="Password"
                    required>
                </div>
            </div>
            <div class="login_form_row">
                <input type="checkbox" name="remember" id="remember"/> 
                <label id="remember_me" for="remember-me">Remember me</label>
            </div>
            <div class="login_form_row">
                <input type="submit" name="login_submit" id="login_btn" value="Log in">
            </div>
        </form>
        <a href="#" id="forgotten_pswd">Forgotten password ?</a>
        <a href="http://localhost/project/user_coffee_shop/signup.php" id="create_new_account">
            <p>
                Create new account
            </p>
        </a>
    </div>
</body>
</html>
