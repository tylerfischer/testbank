<?php
session_start();
include_once "function.php"

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php"); /* user needs to log in */
} else {
    $data_id = $_REQUEST["data_id"]; //todo set to current data
    $sql = "SELECT comment.*, user.username FROM comment INNER JOIN user on comment.user_id = user.user_id WHERE comment.data_id = '$data_id'";
    if ($resultData = mysqli_query($conn, $sql)) {
        while ($rowData = mysqli_fetch_assoc($resultData)) {
            echo json_encode($rowData);
            echo '<br>';
        }
}
?>
