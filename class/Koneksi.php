<?php 

/**
 * Gosoftware Media Indonesia
 * --
 * --
 * http://gosoftware.web.id
 * e-mail : cs@gosoftware.web.id
 * WA : 6285263616901
 * --
 * --
 */


class Koneksi {

	private $db_host = "localhost";
	private $db_port = "3306";
	private $db_name = "upmfstui_sikuev1";
	private $db_user = "upmfstui_dsikue";
	private $db_pass = "0V8uiPOrZFKz";
	
	protected $db;

	public function __construct()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		
		try {
			$this->db = new PDO ("mysql:host=" . $this->db_host . ";port=" . $this->db_port . ";dbname=" . $this->db_name . "", $this->db_user, $this->db_pass);
		} catch (PDOException $e) {
			die ("Koneksi database tidak terhubung!" . $e->getMessage());
		}

	}
}