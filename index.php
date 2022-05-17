<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    </style>
</head>

<body>
    <div class="login-container">
        <?php
        include "config.php";
        if (isset($_POST['login'])) {
            $username = mysqli_escape_string($conn, $_POST['username']);
            $password = md5($_POST['password']);

            $sql = "SELECT user_id, username, role FROM users  WHERE username = '{$username}' AND password = '{$password}'";
            $result = mysqli_query($conn, $sql) or die("Query Failed");


            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    session_start();

                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['role'] = $row['role'];
                }
                header('location: home.php');
            } else {
                echo "<h3>Username or password incorrect</h3>";
            }
        }
        ?>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="user_id">User ID</label>
            <input type="text" name="username" placeholder="user id">
            <input type="password" name="password" placeholder="password">
            <input type="submit" name="login">
        </form>
        <p>Not registered?</p>
        <a href="signup.php">Sign UP!</a>
    </div>
</body>

</html>