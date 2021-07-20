<?php
include_once "../views/partials/header.php";

$id = $_POST['id'] ?? null;
$query = "SELECT * FROM reports WHERE id = $id";
$result = mysqli_query($conn, $query);
$report = mysqli_fetch_assoc($result);
mysqli_free_result($result);
$errors = [];

if (!$id) {
    header("Location: ../../index.php");
    exit();
}

$userId = $_SESSION['user_id'];
if ($userId !== $report['user_id']) {
    array_push($errors, "This report not for you!");
    return false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'. $report['image']) {
        unlink($_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'. $report['image']);
    }

    $sql = "DELETE FROM reports WHERE id = $id && user_id = $userId";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = 'Report deleted successfully';
        header('Location: ../../index.php');
    } else {
        array_push($errors, "Something was wrong, Please try again later");
    }
}
mysqli_close($conn);