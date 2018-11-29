<?php
	session_start();
	session_destroy();
	echo("<script>alert('AGUR')</script>");
    echo("<script>window.location = '../login.php';</script>");
?>