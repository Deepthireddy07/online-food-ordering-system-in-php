<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
        #buttn {
            color: #fff;
            background-color: #ff3300;
        }
    </style>

</head>

<body>
    <?php
    include("connection/connect.php"); // INCLUDE CONNECTION
    error_reporting(0); // hide undefined index errors
    session_start(); // temp sessions
    $message = '';

    if (isset($_POST['submit'])) // if button is submit
    {
        $username = $_POST['username'];  // fetch records from login form
        $password = $_POST['password'];

        if (!empty($_POST["submit"])) // if records were not empty
        {
            $loginquery = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($db, $loginquery);
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["user_id"] = $row['u_id']; // put user id into temp session
                    header("refresh:1;url=index.php"); // redirect to index.php page
                } else {
                    $message = "Invalid Password!";
                }
            } else {
                $message = "Invalid Username!";
            }
        }
    }
    ?>

    <!-- Form Mixin-->
    <!-- Input Mixin-->
    <!-- Button Mixin-->
    <!-- Pen Title-->
    <div class="pen-title">
        <h1>Login Form</h1>
    </div>
    <!-- Form Module-->
    <div class="module form-module">
        <div class="toggle">

        </div>
        <div class="form">
            <h2>Login to your account</h2>
            <span style="color:red;"><?php echo $message; ?></span>
            <form action="" method="post">
                <input type="text" placeholder="Username" name="username" />
                <input type="password" placeholder="Password" name="password" />
                <input type="submit" id="buttn" name="submit" value="Login" />
            </form>
        </div>

        <div class="cta">Not registered?<a href="registration.php" style="color:#f30;"> Create an account</a></div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>

</html>
