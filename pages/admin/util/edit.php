<?php 

    session_start();

    include_once("../../includes/connection.php");

    $room = $date = $time = $accountType = $updateID = "";

    if(isset($_GET["update_id"])) {

        $updateID = $_GET["update_id"];

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST["edit"])) {
                
                if(empty($_POST["room"]) || empty($_POST["date"]) || empty($_POST["time"])) {
                    $_SESSION["error"] = "Error!";
                } else {

                    $select_query = "SELECT * FROM `$db_tbl_sched` WHERE `sched_id` = $updateID";
                    $result = $conn -> query($select_query);

                    $room = $_POST["room"];
                    $date = $_POST["date"];
                    $time = $_POST["time"];

                    while($row = $result -> fetch_assoc()) {
                        if($row["room_no"] == $room && $row["date"] == $date && $row["time"] == $time) {
                            $_SESSION["warn"] = "NO CHANGES APPLIED!";
                        } else {
                            $update_query = mysqli_query($conn, "UPDATE `$db_tbl_sched` SET `room_no` = '$room', `date` = '$date', `time` = '$time' WHERE `sched_id` = $updateID");

                            if($update_query) {
            
                                $_SESSION["popup"] = "Update Success!";
                            }
                        }
                    }
                }
            }
        }
    }

    header("location:../table.php");
?>