<?php
if(!isset($_SESSION['user'])){
	//echo '<script language="javascript">alert("Anda harus login!")</script>';
	echo '<script language="javascript">document.location="login.php";</script>';
}
?>