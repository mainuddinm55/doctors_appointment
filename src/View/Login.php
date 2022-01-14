<?php

use DoctorAppointment\Controller\UserController;

if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = "";
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
