<?php

$fak = new Fakultas();

if (isset($_POST['prcinput'])) {

	$fak->input();
	header("location:" . URL . "fakultas_tampil");
}

if (isset($_POST['prcupdate'])) {

	$fak->update();
	header("location:" . URL . "fakultas_tampil");
}
