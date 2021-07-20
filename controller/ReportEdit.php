<?php

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../../index.php");
    exit();
}

$query = "SELECT * FROM reports WHERE id = $id";
$result = mysqli_query($conn, $query);
$report = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$title = $report['title'];
$body = $report['body'];
$errors = [];

$userId = $_SESSION['user_id'];
if ($userId !== $report['user_id']) {
    array_push($errors, "This report not for you!");
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $imageName = $report['image'] ?? null;

    if (!$title) {
        $errors[] = 'Title is required';
    }
    if (!$body) {
        $errors[] = 'Body is required';
    }

    if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/assets/uploads')) {
        mkdir($_SERVER['DOCUMENT_ROOT'].'/assets/uploads');
    }

    if (!$errors) {
        $image = $_FILES['image'] ?? null;

        if ($image && $image['tmp_name']) {
            if ($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'. $report['image']) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'. $report['image']);
            }

            $imageName = randomString(8). '-'. $image['name'];
            $imagePath = $_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'. $imageName;
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        $sql = "UPDATE `reports` SET title = '$title', body = '$body', image = '$imageName' WHERE id = '$id' && user_id = '$userId'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = 'Report updated successfully';
            header('Location: ../../index.php');
        }else {
            array_push($errors, "Something was wrong, Please try again later");
            // echo "Error updating record: " . $conn->error;
        }
    }
}
mysqli_close($conn);

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