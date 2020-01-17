<?php

$mhsw = new Mahasiswa();

if (isset($_POST['prcinput'])) {

	$mhsw->input();
	$mhsw->userAdd();
	header("location:" . URL . "mahasiswa_tampil");
}

if (isset($_POST['prcupdate'])) {

	$mhsw->update();
	header("location:" . URL . "mahasiswa_tampil");
}
