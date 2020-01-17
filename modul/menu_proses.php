<?php

$mn = new Menu();

if (isset($_POST['prcinput'])) {

	$mn->input();
	header("location:" . URL . "menu_tampil");
}

if (isset($_POST['prcupdate'])) {

	$mn->update();
	header("location:" . URL . "menu_tampil");
}
