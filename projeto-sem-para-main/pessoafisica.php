<?php
session_start()

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home -Usuário</title>
</head>
<body>
 <?php
    if(isset($_SESSION['msg2'])) {
        echo $_SESSION['msg2'];
        unset($_SESSION['msg2']);
    }
    ?>
</body>
</html>
