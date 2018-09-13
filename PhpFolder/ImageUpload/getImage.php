<?php
session_start();
include '../connection.php';
$_SESSION['username'];

//'". $_SESSION['username']."
if (isset($_SESSION['username'])) {
    $imageLocation = $_SESSION['location'] . $_SESSION['date'] . "." . $_SESSION['imagefileType'];
    $query = "SELECT * FROM image_tables WHERE Username ='".$_SESSION['username']."';";
    $stmt = $con->query($query);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($res as $row){
        echo "<img src='".$row['ImageFile']."'>";
        echo "<p>". $row['Description'] ."</p><br>";
    }

    echo "<a href='UploadImage.php'>Go back</a> ";
    echo "<a href='submitUsername.php'>Use different Username</a> ";




//    if ($_SESSION['EndDate'] == date("Y-m-d")){
//        $EndDate = $_SESSION['EndDate'];
//        $query = "DELETE FROM `image_tables` WHERE EndDate ='".$EndDate."';";
//    }


}

?>