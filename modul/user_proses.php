<?php

$user = new User();

if (isset($_POST['prcinput'])) {

	$user->input();
	header("location:" . URL . "user_tampil");
}

if (isset($_POST['prcupdate'])) {

	$user->update();
	header("location:" . URL . "user_tampil");
}
