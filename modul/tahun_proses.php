<?php

$thn = new Tahun();

if (isset($_POST['prcinput'])) {

	$thn->input();
	header("location:" . URL . "tahun_tampil");
}

if (isset($_POST['prcupdate'])) {

	$thn->update();
	header("location:" . URL . "tahun_tampil");
}
