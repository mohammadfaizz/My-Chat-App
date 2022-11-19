<?php
$conn = mysqli_connect("localhost","root","","chatapp");

if(!$conn){
    echo "Error: ".mysqli_connect_error();
}
?>