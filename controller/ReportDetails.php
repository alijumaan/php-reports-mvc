<?php

if (isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $query = "SELECT * FROM reports WHERE id = $id";

    $result = mysqli_query($conn, $query);

    $report = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    mysqli_close($conn);
}

