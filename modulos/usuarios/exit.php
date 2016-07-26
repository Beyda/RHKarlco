<?php
session_start();

 


if (isset($_SESSION["session"])) {
	session_destroy();
  $_SESSION["session"];

	header("location: /rhkarlco/login.php");
}




?>