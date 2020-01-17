<?php

$kue = new Kuesioner();

if (isset($_POST['prcinput'])) {

	$kue->input();
	header("location:" . URL . "kuesioner_tampil");
}

if (isset($_POST['prcupdate'])) {

	$kue->update();
	header("location:" . URL . "kuesioner_tampil");
}

if (isset($_POST['prchasil'])) {

	$kue->hasil();
	header("location:" . URL . "kuesioner_selesai");
}

