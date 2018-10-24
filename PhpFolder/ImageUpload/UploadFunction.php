<?php
session_start();
$_SESSION['fileupload'] = $_FILES['fileUpload']['name'];
include '../connection.php';

$dateAdded = date('Y-m-d_H-i-s');
$target_dir = "../../../NewImage/";
$target_file = $target_dir . $dateAdded;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION));
$descriptionBox = $_POST['descriptionBox'];

if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {
    $dateEndsY = $_POST['IEdateY'];
    $dateEndsM = $_POST['IEdateM'];
    $dateEndsD = $_POST['IEdateD'];
    $IEdateEnds = $dateEndsY.'-'.$dateEndsM.'-'.$dateEndsD;
    $_SESSION['EndDateIE'] = $IEdateEnds;
}else{
    $dateEnds = $_POST['endDate'];
    $_SESSION['EndDate'] = $dateEnds;
}

$maxImgWidth = 375;
$list = list($Width) = getimagesize($_FILES['fileUpload']['tmp_name']);

$_SESSION['username'];
$_SESSION['date'] = $dateAdded;
$_SESSION['location'] = $target_dir;
$_SESSION['imagefileType'] = $imageFileType;
$_SESSION['description'] = $descriptionBox;
$_SESSION['TargetFile'] = $target_file . '.' .$imageFileType;

//check if submit is pressed
if (isset($_POST['submitFile'])) {
    $Username = $_SESSION['username'];
    //check if there is a file
    if (!$_FILES['fileUpload']['name']) {
        echo "Sorry, no file selected<br>";
        $uploadOk = 0;
    } else {
        //get the size of the image
        $check = getimagesize($_FILES['fileUpload']['tmp_name']);
        //check if the file is an image or not
        if ($check !== false) {
            echo "File is an image - " . $check['mime'] . '.<br>';
            $uploadOk = 1;
        } else {
            echo "File is not an image<br>";
            $uploadOk = 0;
        }
    }
    //check if the size of the image is too large.
    //not allowed to be larger than 500 KB.
    if ($_FILES['fileUpload']['size'] > 500000) {
        echo "Sorry, file is too large.<br>";
    }
    //check the file type if its not jpg, jpeg, png, gif it will not be uploaded
    if ($imageFileType != "jpg" && $imageFileType = "jpeg" && $imageFileType = "png" && $imageFileType = "gif") {
        echo "Sorry, please use filetypes: jpg, jpeg, png, gif.<br>";
    }
    if($Width > $maxImgWidth){
        echo "Sorry image is not the right size<br>
        Please use a max Width of 375px<br>";
        $uploadOk = 0;
    }
    //if anything is wrong you get this message
    if ($uploadOk == 0) {
        echo "Sorry, your file could not be uploaded";
        echo "<br><a href='UploadImage.php'>Go back</a>";
    }
    else
        //if everything is okay the file will be uploaded and renamed to the date and time it was uploaded
        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target_file . '.' . $imageFileType)) {
            echo "the file " . basename($_FILES['fileUpload']['name']) . " has been uploaded<br>";
            echo "<a href='UploadImage.php'>Click here to upload another image</a> <br>";
            echo "<a href='getImage.php'>click here to see your image(s)</a>";

        //if the user uses IE this code will be executed
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {

            //the data that will be used in the query
            $id = null;
            $imageLocation = $target_file . '.' . $imageFileType;

            //this is where you execute the query to insert the data into the database
            $query =
                "INSERT INTO image_tables(`id`, `ImageFile`, `Username` , `Description`, `DateAdded`, `EndDate`) 
                VALUES 
                (:id, :imageFile, :Username, :Description, :DateAdded, :EndDate)";
            $stmt = $con->prepare($query);
            $stmt->bindParam('id' , $id);
            $stmt->bindParam('imageFile' , $imageLocation);
            $stmt->bindParam('Username' , $Username);
            $stmt->bindParam('Description' , $descriptionBox);
            $stmt->bindParam('DateAdded' , $dateAdded);
            $stmt->bindParam('EndDate' , $IEdateEnds);
            $stmt->execute();
        }

        //if the user uses any other browser this code will be executed
        else{
            $id = null;
            $imageLocation = $target_file . '.' . $imageFileType;

            //this is where you execute the query to insert the data into the database
            $query =
                "INSERT INTO image_tables(`id`, `ImageFile`, `Username` , `Description`, `DateAdded`, `EndDate`) 
                VALUES 
                (:id, :imageFile, :Username, :Description, :DateAdded, :EndDate)";
            $stmt = $con->prepare($query);
            $stmt->bindParam('id' , $id);
            $stmt->bindParam('imageFile' , $imageLocation);
            $stmt->bindParam('Username' , $Username);
            $stmt->bindParam('Description' , $descriptionBox);
            $stmt->bindParam('DateAdded' , $dateAdded);
            $stmt->bindParam('EndDate' , $dateEnds);
            $stmt->execute();
            }
        }
        //if the upload didn't work this message will be shown
    else {
    echo "Sorry, there was an error uploading your image";
    }
}else{
    echo "Oops Something went wrong";
}

