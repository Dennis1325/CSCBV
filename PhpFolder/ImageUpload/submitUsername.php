<?php
//Check if ingelogd
session_start();
include '../connection.php';

?>

<form action="UploadImage.php" method="post" enctype="multipart/form-data" name="usernameForm">
    Username:<br>
    <input type="text" name="Username">
    <input type="submit" name="submitUsername">
</form>
