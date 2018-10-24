<?php
session_start();
include '../connection.php';
if (isset($_POST['Username'])){
    $Username = $_POST['Username'];
    $_SESSION['username'] = $Username;
}
else{
    $_SESSION['username'];
}
?>
<html>
<form method="post" action="UploadFunction.php" name="uploadFile" enctype="multipart/form-data">
    Select Image to upload:
    <input type="file" name="fileUpload" id="fileUpload">
    <input type="submit" value="Upload Image" name="submitFile"><br>
    Description / ImageName:<br>
    <input type="text" size="30"  maxlength="50" name="descriptionBox"><br>
    Pick until when:<br>
    <?php
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) {
         echo '
         <input name="IEdateY" class="dateInput" type="number" maxlength="4" placeholder="YYYY" max="2100" min="'.date("Y").'">-
         <input name="IEdateM" class="dateInput" type="number" maxlength="2" placeholder="MM" max="12" min="'.date("m").'">-
         <input name="IEdateD" class="dateInput" type="number" maxlength="2" placeholder="DD" max="31" min="'.date("d").'">
         ';
    }else{
       echo "<input type='date' class='datepicker' name='endDate' placeholder='yyyy-mm-dd'><br>";
    }
    ?>

    <?php echo "<br><a href='getImage.php'>click here to see your image(s)</a>"; ?>

</form>
</html>
<style>
    ::placeholder{
        color: black;
        opacity: 1;
    }
    :placeholder-shown{
        color: black;
    }
    :-ms-input-placeholder{
        color: black;
    }
    ::-ms-input-placeholder{
        color: black;
    }
    .dateInput{
        width: 40px;
    }
</style>

