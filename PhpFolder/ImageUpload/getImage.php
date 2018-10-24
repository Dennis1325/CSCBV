<style>
    .imageFormDiv {
        border-bottom: black 1px solid;
        padding: 10px;
        padding-top: 20px;
    }

    .imageTurnedOff {
        color: red;
    }

</style>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
session_start();
include '../connection.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
<div id='result' class='imageFormDiv'>

    <?php
    if (isset($_POST['submit'])) {
        echo $_POST['submit'];
    }

    if (isset($_SESSION['username'])) {

        if ($_SESSION['EndDate'] == date("Y-m-d")) {
            $EndDate = $_SESSION['EndDate'];
            $query = "UPDATE `image_tables` SET `Disabled` = 1 WHERE `Disabled` = 0 AND EndDate ='" . $EndDate . "';";
        }

        $imageLocation = $_SESSION['location'] . $_SESSION['date'] . "." . $_SESSION['imagefileType'];
        $query = "SELECT * FROM image_tables WHERE Username ='" . $_SESSION['username'] . "' ;";
        $stmt = $con->prepare($query);
        $imgs = $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $countRes = count($res);
        $i = 0;



        foreach ($res as $row) {

            if ($row['Disabled'] == '1') {
                echo "<form enctype='multipart/form-data'>";
                echo "Hide Image<input id='radioHide' type='radio' class='radio' onclick='send_value(this);' name='radio' value='FALSE" . $i . "' checked><br>";
                echo "Show Image<input id='radioShow' type='radio' class='radio' onclick='send_value(this);' name='radio' value='TRUE" . $i . "'><br></form>";
            } else if ($row['Disabled'] == '0') {
                echo "<form enctype='multipart/form-data'>";
                echo "Hide Image<input id='radioHide' type='radio' class='radio' onclick='send_value(this);' name='radio' value='FALSE" . $i . "'><br>";
                echo "Show Image<input id='radioShow' type='radio' class='radio' onclick='send_value(this);' name='radio' value='TRUE" . $i . "' checked><br></form>";
            }

            $radioOff = $_POST['radio'];
            $radioOn = $_POST['radio'];

            if (isset($radioOff) && $radioOff == 'FALSE') {
                $query = "UPDATE `image_tables` SET `Disabled` = 1 WHERE `Disabled` = 0 AND ImageFile = '" . $row['ImageFile'] . "';";
                $stmt = $con->exec($query);
            } else if (isset($radioOn) && $radioOn == 'TRUE') {
                $query = "UPDATE `image_tables` SET `Disabled` = 0 WHERE `Disabled` = 1 AND ImageFile = '" . $row['ImageFile'] . "';";
                $stmt = $con->exec($query);
            }

            $i++;

            echo "<div class='imageFormDiv'>";
            if ($row['Disabled'] == '1') {
                echo "<img src='" . $row['ImageFile'] . "'>";
                echo "<p class='imageTurnedOff'>This Image is disabled</p><br>";
            } else {
                echo "<img src='" . $row['ImageFile'] . "'>";
                echo "<p>" . $row['Description'] . "</p><br>";
            }
            echo "</div><br><br>";

        }

        echo "<br><a href='UploadImage.php'>Go back</a><br><br>";
        echo "<br><a href='submitUsername.php'>Use different Username</a> ";
    }

    echo "<p id='result'>";
    if (isset($_POST['radioVal'])){
        echo $_POST['radioVal'];
    }
    echo "</p>";

    ?>

</div>

</body>
</html>

<script>

    // $(document).ready(function() {
// function getVal(data) {
//
//         $('#radioShow').change( function() {
//             let $radioShow = $('#radioShow').val();
//
//             $.ajax({
//                 url: 'getImage.php',
//                 type: 'POST',
//                 async: true,
//                 data: {radioShow: $radioShow},
//                 success: function (result) {
//                     console.log($radioShow);
//                 }
//             });
//         });
//
//
//         $('#radioHide').change( function() {
//             let $radioHide = $('#radioHide').val();
//
//             $.ajax({
//                 url: 'getImage.php',
//                 type: 'POST',
//                 async: true,
//                 data: {radioHide : $radioHide},
//                 success: function (result) {
//                     console.log($radioHide);
//                 }
//             });
//         });
//
// }
    // });


    // $(document).ready(function(){

    function send_value(radioVal) {
        let $radioVal = radioVal.value;

        $.ajax({
            url: 'getImage.php',
            type: 'POST',
            data: {radioVal: $radioVal},
            success: function (result) {
                $('#result').html($radioVal);
            }
        });
    }

        // $('#radioShow').click(function(){
        //     let radioVal = $(this).val();
        //     send_value(radioVal)
        // });

        // $('#radioHide').click(function(){
        //     let radioVal = $(this).val();
        //     send_value(radioVal)
        // });

    // });
//<input id='radioHide' type='radio' class='radio' onclick='send_value(this);' name='radio' value='FALSE" . $i . "' checked=($row['disabled'] === 1 ? true : false)>
</script>
