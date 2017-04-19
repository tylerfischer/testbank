<?php

includeonce

if (!isset($_SESSION['glbl_user']) || empty($_SESSION['glbl_user'])) {
    echo '<script language="javascript">';
    echo 'alert("User not logged in!")';
    echo '</script>';
    header("Location: ../login.php"); /* Redirect browser */
    exit();
} else {
    $data_id = $_REQUEST["data_id"]; //todo set to current data
    $sql = "SELECT comment.*, user.username FROM comment INNER JOIN user on comment.user_id = user.user_id WHERE comment.data_id = '$data_id';";
    if ($resultData = mysqli_query($conn, $sql)) {
        while ($rowData = mysqli_fetch_assoc($resultData)) {
            echo json_encode($rowData);
            echo '<br>';
        }
    } else {
        echo "Error with getting comments <br>";
        echo $conn->error;
    }
}
?>
