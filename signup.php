<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include 'config.php';
    if (isset($_POST['signup'])) {
        if (!empty($_POST['name']) && !empty($_POST['lname']) && !empty($_POST['username']) && !empty($_POST['password'])) {


            $name = mysqli_escape_string($conn, $_POST['name']);
            $lname = mysqli_escape_string($conn, $_POST['lname']);
            $username = mysqli_escape_string($conn, $_POST['username']);
            $password = md5($_POST['password']);
            $check = mysqli_query($conn, "SELECT username from users WHERE username = '{$username}'");

            if (mysqli_num_rows($check) > 0) {
                echo "<p style='color:red';>username already exist</p>";
            } else {

                $sql = "INSERT INTO users (name,lname,username,password,role) VALUES ('{$name}','{$lname}','{$username}','{$password}',1)";
                $result = mysqli_query($conn, $sql) or die("query failed");

                header('location:index.php');
            }
        }
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="user_id">Name</label>
        <input type="text" name="name" placeholder="first name"><br>
        <label for="user_id">Last Name</label>
        <input type="text" name="lname" placeholder="last name"><br>
        <label for="user_id">Username</label>
        <input type="text" name="username" placeholder="username"><br>
        <label for="user_id">Password</label>
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="signup">
    </form>
</body>

</html>