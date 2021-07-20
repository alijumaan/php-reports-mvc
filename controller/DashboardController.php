<?php
//$errors = [];
//
//if($_SERVER['REQUEST_METHOD'] == 'POST'){
//    $email = mysqli_real_escape_string($conn, $_POST['email']);
//    $username = mysqli_real_escape_string($conn, $_POST['username']);
//
//    if(empty($username)){array_push($errors, "Name is required");}
//    if(empty($email)){array_push($errors, "Email is required");}
//
//    if(!count($errors)){
//        $id = $_SESSION['user_id'];
//        $query = "UPDATE `users` SET username='$username', email='$email' WHERE id='$id'";
//
//        $result = mysqli_query($conn, $query);
//        if ($result)
//        {
//            $_SESSION = [];
//            $_SESSION['user_name'] = $result['username'];
//            $_SESSION['user_email'] = $result['email'];
//            $_SESSION['success'] = 'Updated successfully';
//            header('location: ../views/auth/login.php');
//        }
//        else
//        {
//            array_push($errors, "something was wrong");
//        }
//    }
//}
