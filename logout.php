<?php

SESSION_START();

if(isset($_SESSION['auth']))
{
	// delete session and make users to logout!
	session_destroy();
	header("location:index.php");
}
else
{
	header("location:index.php");
}


?>
