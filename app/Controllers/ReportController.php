<?php

namespace App\Controllers;

use App\Database\Database;
use App\Helpers\RandomStringHelper;
use App\Routes\Router;

class ReportController
{

    public static function index(Router $router)
    {
        $conn = new Database();

        $search = $_GET['search'] ?? '';

        if ($search) {
            $sql = "SELECT * FROM reports WHERE title LIKE '%$search%' ORDER BY id desc";
        } else {
            $sql = "SELECT * FROM reports ORDER BY id desc";
        }

        $result = mysqli_query($conn->dbConn(), $sql);

        $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);

        mysqli_close($conn->dbConn());

        $router->renderView('reports/index', [
            'reports' => $reports,
            'search' => $search
        ]);
    }

    public static function show(Router $router)
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /reports');
            $_SESSION['warning'] = 'Report does not exist';
            exit();
        }

        $conn = new database();

        $result = mysqli_query($conn->dbConn(), "SELECT * FROM reports WHERE id = $id");

        $report = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn->dbConn());

        $router->renderView('reports/show', [
            'report' => $report
        ]);
    }

    public static function create(Router $router)
    {
        $errors = [];
        $report = [
            'title' => '',
            'body' => ''
        ];

        $router->renderView('reports/create', [
            'report' => $report,
            'errors' => $errors
        ]);
    }

    public static function store(Router $router)
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conn = new Database();

            $title = mysqli_real_escape_string($conn->dbConn(), $_POST['title']);
            $body = mysqli_real_escape_string($conn->dbConn(), $_POST['body']);
            $imageName = '';

            if (empty($title)) {
                $errors[] = 'Title is required';
            }
            if (empty($body)) {
                $errors[] = 'Body is required';
            }

            if (!is_dir(__DIR__ . '/../../assets/uploads')) {
                mkdir(__DIR__ . '/../../assets/uploads');
            }

            if (empty($errors)) {
                $image = $_FILES['image'] ?? null;
                if ($image && $image['tmp_name']) {
                    $imageName = RandomStringHelper::randomString(8) . '-' . $image['name'];
                    $imagePath = __DIR__ . '/../../assets/uploads/' . $imageName;
                    mkdir(dirname($imagePath));
                    move_uploaded_file($image['tmp_name'], $imagePath);
                }
                $userId = $_SESSION['user_id'];
                $report = $conn->dbConn()->query("INSERT INTO reports (title, body, image, user_id) VALUE ('$title', '$body', '$imageName', $userId)");

                if ($report->num_rows) {
                    array_push($errors, "Something was wrong, Please try again later");
                } else {
                    $_SESSION['success'] = 'Report added successfully';
                    header('Location: ../../');
                }
            }
            mysqli_close($conn->dbConn());
        }

        $router->renderView('reports/create', [
            'errors' => $errors
        ]);
    }

    public static function edit(Router $router)
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /reports');
            $_SESSION['warning'] = 'Report does not exist';
            exit();
        }

        $conn = new database();

        $result = mysqli_query($conn->dbConn(), "SELECT * FROM reports WHERE id = $id");

        $report = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn->dbConn());

        $router->renderView('reports/edit', [
            'report' => $report
        ]);
    }

    public static function update(Router $router): bool
    {
        $id = $_GET['id'];

        if (!$id) {
            header('Location: /reports');
            $_SESSION['warning'] = 'Report does not exist';
            exit();
        }

        $conn = new Database();

        $result = mysqli_query($conn->dbConn(), "SELECT * FROM reports WHERE id = $id");
        $report = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

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

            if (!is_dir(__DIR__ . '/../../assets/uploads')) {
                mkdir(__DIR__ . '/../../assets/uploads');
            }

            if (!$errors) {
                $image = $_FILES['image'] ?? null;

                if ($image && $image['tmp_name']) {
                    if ( __DIR__ . '/../../assets/uploads/' . $report['image']) {
                        unlink( __DIR__ . '/../../assets/uploads/' . $report['image']);
                    }

                    $imageName = RandomStringHelper::randomString(8). '-'. $image['name'];
                    $imagePath = __DIR__ . '/../../assets/uploads/' . $imageName;
                    mkdir(dirname($imagePath));
                    move_uploaded_file($image['tmp_name'], $imagePath);
                }

                $sql = "UPDATE `reports` SET title = '$title', body = '$body', image = '$imageName' WHERE id = '$id' && user_id = '$userId'";

                if ($conn->dbConn()->query($sql) === TRUE) {
                    $_SESSION['success'] = 'Report updated successfully';
                    header('Location: ../../index.php');
                }else {
                    array_push($errors, "Something was wrong, Please try again later");
                    // echo "Error updating record: " . $conn->error;
                }
            }
        }
        mysqli_close($conn);

        $router->renderView('reports/edit', [
            'errors' => $errors,
            'report' => $report
        ]);
    }

    public static function destroy(): bool
    {
        $id = $_POST['id'] ?? null;
        $errors = [];

        if (!$id) {
            header("Location: ../../index.php");
            exit();
        }

        $conn = new Database();
        $result = mysqli_query($conn->dbConn(), "SELECT * FROM reports WHERE id = $id");
        $report = mysqli_fetch_assoc($result);

        $userId = $_SESSION['user_id'];
        if ($userId !== $report['user_id']) {
            array_push($errors, "This report not for you!");
            return false;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (__DIR__ . '/../../assets/uploads/' . $report['image']) {
                unlink(__DIR__ . '/../../assets/uploads/' . $report['image']);
            }

            $sql = "DELETE FROM reports WHERE id = $id && user_id = $userId";

            if ($conn->dbConn()->query($sql) === TRUE) {
                $_SESSION['success'] = 'Report deleted successfully';
                header('Location: ../../');
            } else {
                array_push($errors, "Something was wrong, Please try again later");
            }
        }

        mysqli_close($conn);
    }
}