<?php
//$errors = [];
//
//if($_SERVER['REQUEST_METHOD'] == 'POST'){
//    $email = mysqli_real_escape_string($conn, $_POST['email']);
//    $password = mysqli_real_escape_string($conn, $_POST['password']);
//
//    if(empty($email)){array_push($errors, "Email is required");}
//    if(empty($password)){array_push($errors, "Password is required");}
//
//    if(!count($errors)){
//        $userExists = $conn->query("select id, email, username, password from users where email='$email' limit 1");
//
//        if(!$userExists->num_rows){
//            array_push($errors, "Your email ".$email."does not exists in our records");
//        }else{
//            $foundUser = $userExists->fetch_assoc();
//            // مقارنة الهاش باسوورد مع الباسوورد المدخل عن طريق اليوزر
//            if(password_verify($password, $foundUser['password'])){
//                $_SESSION['logged_in'] = true;
//                $_SESSION['user_id'] = $foundUser['id'];
//                $_SESSION['user_name'] = $foundUser['username'];
//                $_SESSION['user_email'] = $foundUser['email'];
//                $_SESSION['success'] = 'Welcome '.$foundUser['username'];
//            }else{
//                array_push($errors, "wrong credential");
//            }
//        }
//    }
//    mysqli_close($conn);
//}
