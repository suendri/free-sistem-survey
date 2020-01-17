<?php

$ins = new Instrumen();

if (isset($_POST['prcinput'])) {

	$ins->input();
	header("location:" . URL . "instrumen_tampil");
}

if (isset($_POST['prcupdate'])) {

	$ins->update();
	header("location:" . URL . "instrumen_tampil");
}
