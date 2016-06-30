<?php
session_start();

 


if (isset($_SESSION["login_session"])) {
	session_destroy();
  $_SESSION["login_session"];

	header("location: /rhkarlco/login.php");
}




?>