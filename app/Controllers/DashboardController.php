<?php

namespace App\Controllers;

use App\Database\Database;
use App\Routes\Router;

class DashboardController
{
    public static function dashboard(Router $router)
    {
        $id = $_SESSION['user_id'];

        if (!$id) {
            header('Location: /login');
            exit();
        }

        $conn = new Database();

        $result = mysqli_query($conn->dbConn(), "SELECT * FROM reports WHERE user_id = '$id'");

        $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);

        mysqli_close($conn->dbConn());

        $router->renderView('auth/dashboard', [
            'reports' => $reports
        ]);
    }

    public static function updateProfile(Router $router)
    {
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $conn = new Database();

            $email = mysqli_real_escape_string($conn->dbConn(), $_POST['email']);
            $username = mysqli_real_escape_string($conn->dbConn(), $_POST['username']);

            if(empty($username)){array_push($errors, "Name is required");}
            if(empty($email)){array_push($errors, "Email is required");}

            if(!count($errors)){
                $id = $_SESSION['user_id'];

                $result = mysqli_query($conn->dbConn(), "UPDATE `users` SET username='$username', email='$email' WHERE id='$id'");
                if ($result)
                {
                    $_SESSION = [];
                    $_SESSION['user_name'] = $result['username'];
                    $_SESSION['user_email'] = $result['email'];
                    $_SESSION['success'] = 'Updated successfully';
                    header('location: ../views/auth/login.php');
                }
                else
                {
                    array_push($errors, "something was wrong");
                }
            }
        }

        $router->renderView('auth/dashboard');
    }
}