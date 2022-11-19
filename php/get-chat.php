<?php

session_start();
if(isset($_SESSION['unique_id'])){
    include_once "config.php";
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $output = '';

    $sql = "SELECT * FROM messages WHERE (outgoing_msg_id, = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) OR (outgoing_msg_id, = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){ //sender
                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                            </div>';
            }else{ //receiver
                $output .= '<div class="chat incoming">
                            <img src="images/img.jpg" alt="">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                            </div>';
            }
        }
        echo $output;
    }
}else{
    header("../login.php");
}

?>