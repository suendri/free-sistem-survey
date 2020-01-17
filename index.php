<?php 

require "lib/autoload.php";
require "lib/config.php";

ob_start();

if (empty(Fungsi::getSession('user_name'))) {
	require "login.php";
} else {

	// Universal Instance $dashb
	$dashb = new Dashboard();
	require "dashboard.php";
}

ob_end_flush();