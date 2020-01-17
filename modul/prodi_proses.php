<?php

$prodi = new Prodi();

if (isset($_POST['prcinput'])) {

	$prodi->input();
	header("location:" . URL . "prodi_tampil");
}

if (isset($_POST['prcupdate'])) {

	$prodi->update();
	header("location:" . URL . "prodi_tampil");
}
