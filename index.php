<?php 

    session_start();

    include_once("pages/includes/connection.php");
    
    $email = $password = "";
    $emailErr = $passwordErr = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["email"])) {
            $emailErr = "Email is required!";
        } else {
            $email = $_POST["email"];
        }

        if(empty($_POST["password"])) {
            $passwordErr = "Password is required!";
        } else {
            $password = $_POST["password"];
        }

        if($email && $password) {
            $check_email = mysqli_query($conn, "SELECT * FROM $db_tbl_user WHERE email = '$email'");
            $check_email_row = mysqli_num_rows($check_email);

            if($check_email_row > 0) {
                while($row = mysqli_fetch_assoc($check_email)) {
                    $db_password = $row["password"];
                    $db_account_type = $row["account_type"];

                    if($password == $db_password) {
                        if($db_account_type == "1") {
                            header("location:pages/admin/table.php");

                            $db_id = $row["id"];
                            $_SESSION["id"] = $db_id;
                            $_SESSION["popup"] = "Login Success!";
                        } else if($db_account_type == "2") {
                            header("location:pages/employee/schedule.php");

                            $db_id = $row["id"];
                            $_SESSION["id"] = $db_id;
                            $_SESSION["popup"] = "Login Success!";
                        }
                    } else {
                        $passwordErr = "Password is incorrect!";
                    }
                }
            } else {
                $emailErr = "Email is incorrect!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css/main_style.css">
    <link rel="stylesheet" href="style/css/login_style.css">
    <link rel="stylesheet" href="style/css/admin/admin_style.css">
    <title>Login</title>
</head>
<body>
    <div class="bg-des"></div>
    <div class="box form-container">
        <h1 class="text title">BED MANAGEMENT</h1>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <span class="error"><?php echo $emailErr;?></span><br>
            <input class="input" type="email" name="email" placeholder="Email" value="<?php echo $email?>"><br>

            <span class="error"><?php echo $passwordErr;?></span><br>
            <input class="input" type="password" name="password" placeholder="Password" value="<?php echo $password?>"><br>

            <input class="def-btn pri-btn sbt-btn" type="submit" name="submit" value="Log In">
        </form>
    </div>
</body>
</html>