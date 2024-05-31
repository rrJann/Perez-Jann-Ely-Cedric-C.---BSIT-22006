<?php

    session_start();

    include_once("../../includes/connection.php");

    $room = $date = $time = $insertError = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST["insert"])) {

            if(empty($_POST["room"]) || empty($_POST["date"]) || empty($_POST["time"])) {
                $_SESSION["error"] = "Erro!";
            }
            
            if(!empty($_POST["room"])) {
                $room = $_POST["room"];
                echo $room;
            }
    
            if(!empty($_POST["date"])) {
                $date = $_POST["date"];
                echo $date;
            }
    
            if(!empty($_POST["time"])) {
                $time = $_POST["time"];
                echo $time;
            }

            if ($room && $date && $time) {
                $schedID = date("dH").$room;

                $query_insert = mysqli_query($conn, "INSERT INTO `$db_tbl_sched` (`sched_id`, `room_no`, `date`, `time`) VALUES ('$schedID', '$room', '$date', '$time')");
                
                if($query_insert) {
                    $_SESSION["popup"] = "Insert Success!";
                }
            }
        }
    }

    header("location:../table.php");
?>