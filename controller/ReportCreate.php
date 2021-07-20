<?php

$userId = $_SESSION['user_id'];
$errors = [];
$title = '';
$body = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $imageName = '';

    if (empty($title)) {
        // array_push($errors, "Title is required");
        $errors[] = 'Title is required';
    }
    if (empty($body)) {
        // array_push($errors, "Body is required");
        $errors[] = 'Body is required';
    }

    if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/assets/uploads')) {
        mkdir($_SERVER['DOCUMENT_ROOT'].'/assets/uploads');
    }

    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        if ($image && $image['tmp_name']) {
            $imageName = randomString(8). '-'. $image['name'];
            $imagePath = $_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'. $imageName;
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        $report = $conn->query("INSERT INTO reports (title, body, image, user_id) VALUE ('$title', '$body', '$imageName', $userId)");

        if ($report->num_rows) {
            array_push($errors, "Something was wrong, Please try again later");
        }else {
            $_SESSION['success'] = 'Report added successfully';
            header('Location: ../../index.php');
        }
    }
    mysqli_close($conn);
}

function randomString($n): string
{
    $characters = '0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ';
    $str = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}
