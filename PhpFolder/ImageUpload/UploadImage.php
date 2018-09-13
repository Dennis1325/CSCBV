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
    Description:<br>
    <input type="text" size="30" maxlength="50" name="descriptionBox"><br>
    Pick until when:<br>
    <input type="date" class="datepicker" name="endDate" placeholder="yyyy-mm-dd"><br>
<br>
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
</style>

