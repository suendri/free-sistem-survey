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

class Dashboard extends Koneksi {

	public function getMenu()
	{
		$sql = "SELECT * FROM tb_usermenu WHERE menu_parent='0' AND menu_aktif='Y'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function getProdi($kode=false)
	{
		if ($kode==false) {
			$sql = "SELECT * FROM tb_prodi WHERE prodi_aktif='Y' ORDER BY prodi_kode";
		} else {
			$sql = "SELECT * FROM tb_prodi WHERE prodi_kode='$kode' AND prodi_aktif='Y' ORDER BY prodi_kode";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function getTahunAktif()
	{
		$sql = "SELECT * FROM tb_tahun WHERE thn_aktif='Y' LIMIT 0,1";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function getProdiFakultas($kode=false)
	{
		if ($kode==false) {
			$sql = "SELECT p.prodi_kode AS PR, f.fak_kode AS FA, CONCAT(p.prodi_kode, ' - ', p.prodi_nama) AS PRD, 
			CONCAT(f.fak_kode, ' - ', f.fak_nama) AS FAK
			FROM tb_prodi p 
			INNER JOIN tb_fakultas f 
			WHERE p.prodi_kd_fak=f.fak_kode AND p.prodi_kode='$kode'";
		} else {
			$sql = "SELECT p.prodi_kode AS PR, f.fak_kode AS FA, CONCAT(p.prodi_kode, ' - ', p.prodi_nama) AS PRD, 
			CONCAT(f.fak_kode, ' - ', f.fak_nama) AS FAK
			FROM tb_prodi p 
			INNER JOIN tb_fakultas f 
			WHERE p.prodi_kd_fak=f.fak_kode";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function getPrivilage($menu_link)
	{
		$sql = "SELECT * FROM tb_usermenu WHERE menu_link=:menu_link AND menu_aktif='Y'";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":menu_link", $menu_link);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (strpos($row['menu_privilage'], Fungsi::getSession('user_level')) !== false) {
			return true;
		} else {
			return false;
		}

	}

	public function getKuesioner($prodi=false, $user=false)
	{
		if ($prodi==false) {
			$sql = "SELECT k.kue_kd_kls AS KLS
			FROM tb_kuesioner k 
			INNER JOIN tb_prodi p 
			ON k.kue_kd_prodi=p.prodi_kode
			WHERE k.kue_aktif='Y' GROUP BY k.kue_kd_kls";
		} else {
			$sql = "SELECT k.kue_kd_kls AS KLS
			FROM tb_kuesioner k 
			INNER JOIN tb_prodi p 
			ON k.kue_kd_prodi=p.prodi_kode
			INNER JOIN tb_kelas_mhsw km 
			ON km.km_kd_kelas=k.kue_kd_kls
			WHERE k.kue_aktif='Y' AND p.prodi_kode='$prodi' 
			AND km.km_user='$user' GROUP BY k.kue_kd_kls";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}
	
	public function getKuesionerKelas($kls)
	{
		$sql = "SELECT k.*, m.mk_nama AS MK, d.dosen_nama AS DSN,
		CONCAT(k.kue_kd_prodi, '-', p.prodi_nama) AS PRD
		FROM tb_kuesioner k 
		INNER JOIN tb_prodi p 
		ON k.kue_kd_prodi=p.prodi_kode
		INNER JOIN tb_matakuliah m 
		ON k.kue_kd_mk=m.mk_kode
		INNER JOIN tb_dosen d
		ON k.kue_id_dosen=d.dosen_id
		WHERE k.kue_aktif='Y' AND k.kue_kd_kls='$kls'
		ORDER BY m.mk_nama";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}
}
