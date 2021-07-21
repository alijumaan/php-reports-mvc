<?php

namespace App\Controllers;

use App\Database\Database;
use App\Routes\Router;

class LoginController
{
    public static function loginForm(Router $router)
    {
        $router->renderView('auth/login');
    }

    public static function login(Router $router)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conn = new Database();

            $email = mysqli_real_escape_string($conn->dbConn(), $_POST['email']);
            $password = mysqli_real_escape_string($conn->dbConn(), $_POST['password']);

            if (empty($email)) {
                array_push($errors, "Email is required");
            }
            if (empty($password)) {
                array_push($errors, "Password is required");
            }

            if (!count($errors)) {
                $userExists = $conn->dbConn()
                    ->query("select id, email, username, password from users where email='$email' limit 1");

                if (!$userExists->num_rows) {
                    array_push($errors, "Your email " . $email . " does not exists in our records");
                } else {
                    $foundUser = $userExists->fetch_assoc();
                    // مقارنة الهاش باسوورد مع الباسوورد المدخل عن طريق اليوزر
                    if (password_verify($password, $foundUser['password'])) {
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_id'] = $foundUser['id'];
                        $_SESSION['user_name'] = $foundUser['username'];
                        $_SESSION['user_email'] = $foundUser['email'];
                        $_SESSION['success'] = 'Welcome ' . $foundUser['username'];
                        header('Location: ../');

                    } else {
                        array_push($errors, "wrong credential");
                    }
                }
            }
            mysqli_close($conn->dbConn());
        }

        $router->renderView('auth/login', [
            'errors' => $errors
        ]);
    }

    public static function logout()
    {
        if (isset($_SESSION['logged_in'])) {


            // session_unset();
            // session_destroy();
            $_SESSION = [];
            $_SESSION['success'] = 'You are logged out, See You Soon!';
            header('location: /');
            die();
        }

        if (!isset($_SESSION['logged_in'])) {
            header('location: /');
            die();
        }
    }
}