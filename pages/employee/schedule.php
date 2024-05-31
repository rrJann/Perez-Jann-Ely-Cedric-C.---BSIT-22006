<?php 

    session_start();
    include_once("../includes/connection.php");
    include_once("../includes/popup.php");

    if(!$_SESSION["id"]) {
        header("location:../../index.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/css/schedule_style.css">
    <link rel="stylesheet" href="../../style/css/main_style.css">
    <script src="../../scripts/main_script.js"></script>
    <title>Home</title>
</head>
<body>

    <main>
        <div class="sidebar">
            <nav class="nav-sidebar">
                <div class="container sidebar-links">
                    <span class="text sidebar-title">EMPLOYEE</span>

                    <a href="#" class="container sidebar-link">
                        <span class="text sidebar-link">Account</span>
                        <img src="../../style/images/icon/chevron-right-regular-240.png" class="icon">
                    </a>

                    <a class="container sidebar-link current">
                        <span class="text sidebar-link">Schedule</span>
                        <img src="../../style/images/icon/chevron-right-regular-240.png" class="icon">
                    </a>
                </div>

                <div class="container sidebar-logout">
                    <a href="../includes/logout.php" class="text def-btn red-btn">Logout</a>
                </div>
            </nav>
        </div>

        <div class="container main-container">
            <header>
                <nav class="nav-header">
                    <div class="container">
                        <span class="text"><b class="title">BED MANAGEMENT</b></span>
                    </div>

                    <div class="container logout-container">
                        <a href="../includes/logout.php" class="text def-btn red-btn">Logout</a>
                    </div>
                </nav>
            </header>

            <div class="container">
                <div class="container table-container">

                <table>
                    <tr>
                        <th>No.</th>
                        <th>Schedule ID</th>
                        <th>Room No.</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>

                    <?php 

                        $no = 1;
                        $noData = "";

                        $sql = "SELECT * FROM `$db_tbl_sched`";
                        $result = $conn -> query($sql);

                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc()) {
                                if ($no <= 100) {
                                    echo "<tr><td>". $no. 
                                    "<td>". $row["sched_id"]. 
                                    "<td>". $row["room_no"]. 
                                    "<td>". $row["date"]. 
                                    "<td>". $row["time"].  
                                    "</td></tr>";
                                }

                                $no++;
                            }
                        } else {
                            $noData = "No Data";
                        }
                    ?>
                </table>

                    <span class="text"><?php echo $noData;?></span>
                </div>
            </div>
        </div>
    </main>
</body>
</html>