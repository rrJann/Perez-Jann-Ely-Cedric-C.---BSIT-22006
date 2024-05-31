<?php 

    //----------variables

    //database connections variables 

    $locashost = "localhost";
    $root = "root";
    $db_conn_password = "";
    $database = "test";
    $db_tbl_user = "test1";
    $db_tbl_sched = "bed-schedule";
    
    $conn = mysqli_connect($locashost, $root, $db_conn_password, $database);

    if($conn -> connect_error) {
        die("Connection Failed: ". $conn -> connect_error);
    }
?>