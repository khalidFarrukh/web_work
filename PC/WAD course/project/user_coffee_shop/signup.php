<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./styles/signup.css">
    <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
    <script src="./script.js"></script>
    <title>Coffee Shop</title>
</head>

<body>
    <div class="left_colm">
        <img src="./images/logo.png" alt="" id="logo">
    </div>
    <div class="right_colm">
        <form method="POST" action="insert_signups.php" id="signup_form">
            <div class="signup_form_row">
                <div class="input_field">
                    <img src="./images/useracc.png" alt="" id="user_icon">
                    <input type="text" name="userName" id="username_input" placeholder="User Name" required>
                </div>
            </div>
            <div class="signup_form_row">
                <div class="input_field">
                    <img src="./images/phone.png" alt="" id="phone_icon">
                    <input type="text" name="phoneNumber" id="phonenumber_input" placeholder="Phone number" required>
                </div>
            </div>
            <div class="signup_form_row">
                <div class="input_field">
                    <img src="./images/key.png" alt="" id="key_icon">
                    <input type="password" name="passWord" id="password_input" placeholder="Password" required>
                </div>
            </div>
            <div class="signup_form_row">
                <input type="submit" name="signup_submit" id="signup_btn" value="Sign Up">
            </div>
        </form>
        <a href="http://localhost/project/user_coffee_shop/login.php" id="already_have_account">
            <p>
                Already have an account
            </p>
        </a>
    </div>
</body>

</html>