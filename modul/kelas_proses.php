<?php

$kls = new Kelas();

if (isset($_POST['prcinput'])) {

	$kls->input();
	header("location:" . URL . "kelas_tampil");
}

if (isset($_POST['prcupdate'])) {

	$kls->update();
	header("location:" . URL . "kelas_tampil");
}

if (isset($_POST['prcimhsw'])) {

	$kls->klsMhswInput();
	header("location:" . URL . "kelas_mhsw/kode/" . $_POST['kode'] . "");
}
