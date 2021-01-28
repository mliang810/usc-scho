<?php
	session_start(); //put it in here so we dont have to write session_start(); ALLL THE TIME
	//so every page with config.php will start the session.

	define('DB_HOST', '303.itpwebdev.com');
	define('DB_USER', 'liangmic_liangmic');
	define('DB_PASS', 'catsarefat2');
	define('DB_NAME', 'liangmic_final_db');

?>