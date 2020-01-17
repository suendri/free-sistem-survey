<?php 

//--------------------------------------------
// Error reporting dan Session Start
error_reporting(0);

if (!isset($_SESSION)) {
	session_start();
}

new Koneksi();
new Fungsi();

//--------------------------------------------
// Prevent direct access
define('gosoftware', TRUE);


//--------------------------------------------
// Tentang Sistem
define("URL", "http://upmfst-uinsu.web.id/");
define("JUDUL", "SIKUE - Sistem Informasi Kuesioner");
define("PREFIX", "sikue_");
define("SESSION_PREFIX", "sikue_");


//--------------------------------------------
// Timezone Default
date_default_timezone_set("Asia/Bangkok");
