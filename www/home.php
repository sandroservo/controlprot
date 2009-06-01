<?php
session_start();
if(!isset($_SESSION["loginIndex"])){
echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";
exit;}

echo "<h1>Controlprot</h1>";

?>
