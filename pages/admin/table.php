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
    <link rel="stylesheet" href="../../style/css/table_style.css">
    <link rel="stylesheet" href="../../style/css/main_style.css">
    <script src="../../scripts/main_script.js"></script>
    <title>Admin</title>
</head>
<body>

    <main>
        <div class="sidebar">
            <nav class="nav-sidebar">
                <div class="container sidebar-links">
                    <span class="text sidebar-title">ADMIN</span>

                    <a href="#" class="container sidebar-link">
                        <span class="text sidebar-link">Dashboard</span>
                        <img src="../../style/images/icon/chevron-right-regular-240.png" class="icon">
                    </a>

                    <a class="container sidebar-link current">
                        <span class="text sidebar-link">Table</span>
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

            <div class="container table-container">

                <div class="container insert-btn-container">
                    <button class="def-btn green-btn insert-btn" onclick="openInsertForm()"><b>Insert</b></button>
                </div>

                <table>
                    <tr>
                        <th>No.</th>
                        <th>Schedule ID</th>
                        <th>Room No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
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
                                    "<td class='container act-btn'>". 
                                    '<button onclick="openViewForm('.$row["sched_id"].')" class="def-btn sec-btn">Select</button>'.
                                    '<button onclick="openEditForm('.$row["sched_id"].')" class="def-btn green-btn">Update</button>'.
                                    '<button onclick="openDeleteForm('.$row["sched_id"].')" class="def-btn red-btn">Delete</button>'.
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
    </main>

    <div class="form-bg" id="form-insert">
        <div class="sec-container">
            <div class="box form-container insert-container">    
                <button onclick="closeInsertForm()" class="def-btn red-btn back-btn">Back</button>

                <form method="post" action="util/insert.php">
                    <input type="number" name="room" placeholder="Room No" class="input"><br>
                    <input type="date" name="date" placeholder="Date" class="input"><br>
                    <input type="time" name="time" placeholder="Time" class="input"><br>

                    <input type="submit" name="insert" value="Create" class="def-btn green-btn max-size-btn">
                </form>
            </div>
        </div>
    </div>

    <div class="form-bg" id="form-view" style="<?php if(isset($_GET["view_id"])) { echo "display:block;";} ?>">
        <div class="sec-container">
            <div class="box form-container insert-container">    
                <button onclick="closeForm()" class="def-btn red-btn back-btn">Back</button>

                <?php 

                    if(isset($_GET["view_id"])) {

                        $viewID = $_GET["view_id"];

                        $select_query = "SELECT * FROM `$db_tbl_sched` WHERE `sched_id` = '$viewID'";
                        $result = $conn -> query($select_query);

                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc()) {
                                $viewRoom = $row["room_no"];
                                $viewDate = $row["date"];
                                $viewTime = $row["time"];
                            }
                        }
                    }
                ?>

                <div class="container view-data">
                    <span class="text">ID:</span>
                    <span class="text"><b><?php echo $viewID;?></b></span>
                </div>

                <hr>

                <div class="container view-data">
                    <span class="text">Room No.:</span>
                    <span class="text"><b><?php echo $viewRoom;?></b></span>
                </div>

                <hr>

                <div class="container view-data">
                    <span class="text">Date:</span>
                    <span class="text"><b><?php echo $viewDate;?></b></span>
                </div>

                <hr>

                <div class="container view-data">
                    <span class="text">Time:</span>
                    <span class="text"><b><?php echo $viewTime;?></b></span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-bg" id="form-edit" style="<?php if(isset($_GET["edit_id"])) { echo "display:block;";} ?>">
        <div class="sec-container">
            <div class="box form-container insert-container">    
                <button onclick="closeForm()" class="def-btn red-btn back-btn">Back</button>

                <?php 
                
                    if(isset($_GET["edit_id"])) {

                        $editID = $_GET["edit_id"];

                        $select_query = "SELECT * FROM `$db_tbl_sched` WHERE `sched_id` = '$editID'";
                        $result = $conn -> query($select_query);

                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc()) {
                                $editRoom = $row["room_no"];
                                $editDate = $row["date"];
                                $editTime = $row["time"];
                            }
                        }
                    }
                ?>

                <form method="post" action="util/edit.php?update_id=<?php echo $editID;?>">
                    <input type="number" name="room" placeholder="First Name" class="input" value="<?php echo $editID; ?>"><br>
                    <input type="number" name="room" placeholder="First Name" class="input" value="<?php echo $editRoom; ?>"><br>
                    <input type="date" name="date" placeholder="Last Name" class="input" value="<?php echo $editDate; ?>"><br>
                    <input type="time" name="time" placeholder="Email" class="input" value="<?php echo $editTime; ?>"><br>

                    <input type="submit" name="edit" value="Update" class="def-btn green-btn">
                </form>
            </div>
        </div>
    </div>

    <div class="form-bg" id="form-delete" style="<?php if(isset($_GET["delete_id"])) { echo "display:block;";} ?>">
        <div class="sec-container">
            <div class="box form-container insert-container">    

                <?php 

                    if(isset($_GET["delete_id"])) {

                        $deleteID = $_GET["delete_id"];

                        $select_query = "SELECT * FROM `$db_tbl_sched` WHERE `sched_id` = '$deleteID'";
                        $result = $conn -> query($select_query);

                        if($result -> num_rows > 0) {
                            while($row = $result -> fetch_assoc()) {
                                $deleteRoom = $row["room_no"];
                                $deleteDate = $row["date"];
                                $deleteTime = $row["time"];
                            }
                        }
                    }
                ?>
                
                <p class="text text-delete">Do you want to "<b class="error">DELETE</b>" this field?</p>

                <div class="container container-space-between view-data">
                    <span class="text">Schedule ID:</span>
                    <span class="text"><b><?php echo $deleteID;?></b></span>
                </div>

                <div class="container container-space-between view-data">
                    <span class="text">Room No.:</span>
                    <span class="text"><b><?php echo $deleteRoom;?></b></span>
                </div>

                <div class="container container-space-between view-data">
                    <span class="text">Date:</span>
                    <span class="text"><b><?php echo $deleteDate;?></b></span>
                </div>

                <div class="container container-space-between view-data">
                    <span class="text">Time:</span>
                    <span class="text"><b><?php echo $deleteTime;?></b></span>
                </div>

                <form method="post" action="util/delete.php?remove_id=<?php echo $deleteID;?>">
                    <input type="submit" name="delete" value="Delete" class="def-btn red-btn max-size-btn text-white">
                </form>

                <button onclick="closeForm()" class="def-btn sec-btn max-size-btn">Cancel</button>
            </div>
        </div>
    </div>
</body>
</html>