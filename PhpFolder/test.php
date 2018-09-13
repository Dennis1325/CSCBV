<?php
include 'connection.php';

//$keywords = isset($_POST['searchBar']) ? '%'. $_POST['keywords'].'%' : '';
//$result = mysqli_query("SELECT * FROM member where  Voornaam LIKE $keywords");

?>

<html>
<form name="searchForm" method="post" action="test.php">
    <input name="searchBar" type="text" size="40" maxlength="50">
    <input type="submit" name="Submit" value="search">
    <div id="test">test</div>
</form>
</html>
<?php

echo "<a href='check.php'>Click here to go to the next page</a>";

?>