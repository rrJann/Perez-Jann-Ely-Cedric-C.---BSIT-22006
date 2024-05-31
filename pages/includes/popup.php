<?php 

    
    $popupMess = $errorMess = $warnMess = $popupMessDisplay = "";

    if(isset($_SESSION["popup"])) {
        $popupMess = $_SESSION["popup"];
        $popupMessDisplay = "display:block";
        unset($_SESSION["popup"]);
    } else if(isset($_SESSION["error"])) {
        $errorMess = $_SESSION["error"];
        $popupMessDisplay = "display:block";
        unset($_SESSION["error"]);
    } else if(isset($_SESSION["warn"])) {
        $warnMess = $_SESSION["warn"];
        $popupMessDisplay = "display:block";
        unset($_SESSION["warn"]);
    } else {
        $popupMess = "";
        $errorMess = "";        
        $popupMessDisplay = "display:none";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="popup" id="popup" style="<?php echo $popupMessDisplay;?>">
        <span class="success text-small" id="popup"><b><?php echo $popupMess;?></b></span>
        <span class="error text-small" id="popup"><b><?php echo $errorMess;?></b></span>
        <span class="warn text-small" id="popup"><b><?php echo $warnMess;?></b></span>

        <script>
            const timeOut = setTimeout(closeAlert, 3000);
    
            function closeAlert() {
                const alert = document.getElementById('popup');
                alert.style.display = 'none';
            }
        </script>
    </div>
</body>
</html>