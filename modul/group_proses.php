<?php

$gr = new Group();

if (isset($_POST['prcinput'])) {

	$gr->input();
	header("location:" . URL . "group_tampil");
}

if (isset($_POST['prcupdate'])) {

	$gr->update();
	header("location:" . URL . "group_tampil");
}
