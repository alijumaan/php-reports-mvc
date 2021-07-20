<?php

//$reports = $conn->query("SELECT * FROM reports ORDER BY id desc");
//
//if ($reports->num_rows == 0) {
//    return false;
//}
//
//return $reports->fetch_array(MYSQLI_ASSOC);

$search = $_GET['search'] ?? '';
if ($search) {
    $sql = "SELECT * FROM reports WHERE title LIKE '%$search%' ORDER BY id desc";
} else {
    $sql = "SELECT * FROM reports ORDER BY id desc";
}

$result = mysqli_query($conn, $sql);

$reports = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);