<?php

$dosen = new Dosen();

if (isset($_POST['prcinput'])) {

	$dosen->input();
	header("location:" . URL . "dosen_tampil");
}

if (isset($_POST['prcupdate'])) {

	$dosen->update();
	header("location:" . URL . "dosen_tampil");
}
