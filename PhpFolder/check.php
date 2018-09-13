<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma"  content="no-cache">
    <meta http-equiv="Expires"  content="0">
    <!--<meta http-equiv="Refresh"  content="10">-->
    <title>Title</title>
</head>
<body>

<a href="test.php">Click here to go back</a>

</body>
</html>

<?php
//header('Location: '.$_SERVER['PHP_SELF']);

$testText = array('tekst0', 'tekst1', 'tekst2', 'tekst3', 'tekst4', 'tekst5', 'tekst6', 'tekst7', 'tekst8');
$randomizer = array_rand($testText);

echo $testText[$randomizer];

?>