<?php


require_once realpath("vendor/autoload.php");

use DoctorAppointment\Controller\UserController;

if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = "";

    $userController = new UserController();
    if (empty($email)) {
        $error = "Please give email";
    } elseif (empty($password)) {
        $error = "Please give password";
    } else {
        try {
            $userController = new UserController();
            $user = $userController->registration($email, $password);
            if (isset($user)) {
                echo "Registration success";
            } else {
                echo "Registration failed";
            }
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctors Appointment</title>
</head>
<body>
<h1>Login</h1>

<form action="./src/View/Login.php" method="post">
    <label>Enter email</label><br>
    <input type="text" placeholder="jonh@gmail.com" name="email"><br>
    <label>Enter password</label><br>
    <input type="password" placeholder="password" name="password"><br>
    <input type="submit" value="Registration">
</form>

<a href="./src/View/UserRegistration.php">Registration</a>
<a href="./src/View/UserLogin.php">Login</a>
</body>
</html>