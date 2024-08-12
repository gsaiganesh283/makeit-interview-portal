<?php
session_start();

$timeout_duration = 900;

if (isset($_SESSION['loggedin_time'])) {
    $time_lapsed = time() - $_SESSION['loggedin_time'];

    if ($time_lapsed > $timeout_duration) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['loggedin_time'] = time();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
