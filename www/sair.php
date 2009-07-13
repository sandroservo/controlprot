<?php
session_start();
deletarProtocolosAbertos();
session_destroy();


echo "<script language=\"JavaScript\">
document.location=\"index.php\";
</script>";


?>
