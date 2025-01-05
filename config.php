<?php
    $con = mysqli_connect("localhost", "root", "", "toko");

    if(!$con){
        echo "Connection failed" . mysqli_connect_error();
    }
?>
