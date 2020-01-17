<?php

if(!defined('gosoftware')) { header("location:/"); }

$kode = $url[2];
$id = $url[3];

$kls = new Kelas();
$kls->klsMhswHapus($id);

header("location:" . URL . "kelas_mhsw/kode/" . $kode . "");