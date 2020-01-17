<?php

$mk = new Matakuliah();

if (isset($_POST['prcinput'])) {

	$mk->input();
	header("location:" . URL . "matakuliah_tampil");
}

if (isset($_POST['prcupdate'])) {

	$mk->update();
	header("location:" . URL . "matakuliah_tampil");
}
