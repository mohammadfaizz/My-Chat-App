<?php

session_start();
if(isset($_SESSION['unique_id'])){ //if logged in else redirect to login page
    include "config.php";
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if(isset($logout_id)){ //if logout id is set
        $status = "Offline Now";
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}");
        if($sql){
            session_unset();
            session_destroy();
            header("Location: ../login.php");
        }
    }else{
        header("Location: ../users.php");
    }
}else{
    header("Location: ../login.php");
}

?>