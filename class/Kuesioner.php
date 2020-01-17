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


class Kuesioner extends Koneksi {

	public function tampil($user_prodi=false)
	{
		if ($user_prodi==false) {
			$sql = "SELECT k.*, m.mk_nama AS MK, d.dosen_nama AS DSN,
			CONCAT(k.kue_kd_prodi, '-', p.prodi_nama) AS PRD,
			l.kls_kode AS KLS
			FROM tb_kuesioner k 
			INNER JOIN tb_prodi p 
			ON k.kue_kd_prodi=p.prodi_kode
			INNER JOIN tb_kelas l
			ON k.kue_kd_kls=l.kls_kode
			INNER JOIN tb_matakuliah m 
			ON k.kue_kd_mk=m.mk_kode
			INNER JOIN tb_dosen d
			ON k.kue_id_dosen=d.dosen_id ORDER BY l.kls_kode, m.mk_nama";
		} else {
			$sql = "SELECT k.*, m.mk_nama AS MK, d.dosen_nama AS DSN,
			CONCAT(k.kue_kd_prodi, '-', p.prodi_nama) AS PRD,
			l.kls_kode AS KLS
			FROM tb_kuesioner k 
			INNER JOIN tb_prodi p 
			ON k.kue_kd_prodi=p.prodi_kode
			INNER JOIN tb_kelas l
			ON k.kue_kd_kls=l.kls_kode
			INNER JOIN tb_matakuliah m 
			ON k.kue_kd_mk=m.mk_kode
			INNER JOIN tb_dosen d
			ON k.kue_id_dosen=d.dosen_id WHERE k.kue_kd_prodi='$user_prodi' ORDER BY l.kls_kode";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function input()
	{
		$kue_kd_tahun = $_POST['kue_kd_tahun'];
		$kue_kd_fak = $_POST['kue_kd_fak'];
		$kue_kd_prodi = $_POST['kue_kd_prodi'];
		$kue_kd_kls = $_POST['kue_kd_kls'];
		$kue_kd_mk = $_POST['kue_kd_mk'];
		$kue_id_dosen = $_POST['kue_id_dosen'];

		$sql = "INSERT INTO tb_kuesioner SET 
		kue_kd_tahun=:kue_kd_tahun,
		kue_kd_fak=:kue_kd_fak, 
		kue_kd_prodi=:kue_kd_prodi,
		kue_kd_kls=:kue_kd_kls,
		kue_kd_mk=:kue_kd_mk,
		kue_id_dosen=:kue_id_dosen";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':kue_kd_tahun', $kue_kd_tahun);
		$stmt->bindParam(':kue_kd_fak', $kue_kd_fak);
		$stmt->bindParam(':kue_kd_prodi', $kue_kd_prodi);
		$stmt->bindParam(':kue_kd_kls', $kue_kd_kls);
		$stmt->bindParam(':kue_kd_mk', $kue_kd_mk);
		$stmt->bindParam(':kue_id_dosen', $kue_id_dosen);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_kuesioner WHERE kue_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$kue_id = $_POST['kue_id'];
		$kue_kd_fak = $_POST['kue_kd_fak'];
		$kue_kd_prodi = $_POST['kue_kd_prodi'];
		$kue_kd_kls = $_POST['kue_kd_kls'];
		$kue_kd_mk = $_POST['kue_kd_mk'];
		$kue_id_dosen = $_POST['kue_id_dosen'];
		$kue_aktif = $_POST['kue_aktif'];

		$f = $kue_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_kuesioner SET 
		kue_kd_fak=:kue_kd_fak, 
		kue_kd_prodi=:kue_kd_prodi,
		kue_kd_kls=:kue_kd_kls,
		kue_kd_mk=:kue_kd_mk,
		kue_id_dosen=:kue_id_dosen,
		kue_aktif=:kue_aktif
		WHERE kue_id=:kue_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':kue_kd_fak', $kue_kd_fak);
		$stmt->bindParam(':kue_kd_prodi', $kue_kd_prodi);
		$stmt->bindParam(':kue_kd_kls', $kue_kd_kls);
		$stmt->bindParam(':kue_kd_mk', $kue_kd_mk);
		$stmt->bindParam(':kue_id_dosen', $kue_id_dosen);
		$stmt->bindParam(':kue_aktif', $f);
		$stmt->bindParam(':kue_id', $kue_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function isi($kode)
	{
		$sql = "SELECT * FROM tb_instrumen 
		WHERE ins_kd_prodi='$kode' AND ins_aktif='Y' ORDER BY ins_kode";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function hasil()
	{

		$hasil_user_mhsw = $_POST['hasil_user_mhsw'];
		$hasil_id_kue = $_POST['hasil_id_kue'];
		$hasil_nilai = $_POST['hasil_nilai'];

		foreach($hasil_nilai as $key=>$value) {

			$sql = "INSERT INTO tb_hasil SET 
			hasil_user_mhsw=:hasil_user_mhsw,
			hasil_id_kue=:hasil_id_kue, 
			hasil_id_ins=:hasil_id_ins,
			hasil_nilai=:hasil_nilai";

			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(':hasil_user_mhsw', $hasil_user_mhsw);
			$stmt->bindParam(':hasil_id_kue', $hasil_id_kue);
			$stmt->bindParam(':hasil_id_ins', $key);
			$stmt->bindParam(':hasil_nilai', $value);

			$stmt->execute();
		}

	}

	public function cekHasil($user, $id_kue)
	{
		$sql = "SELECT * from tb_hasil 
		WHERE hasil_user_mhsw='$user' AND hasil_id_kue='$id_kue'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $stmt->rowCount();
	}

	public function tampilHasil($id_kue)
	{
		$sql = "SELECT COUNT(h.hasil_nilai) AS JM,
		SUM(h.hasil_nilai) AS NL, i.ins_pernyataan AS IP,
		i.ins_kode AS KD
		FROM tb_hasil h 
		INNER JOIN tb_instrumen i
		WHERE h.hasil_id_ins=i.ins_id AND h.hasil_id_kue='$id_kue'
		GROUP BY h.hasil_id_ins
		ORDER BY i.ins_kode";
		
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function detailHasil($id_kue)
	{

		$sql = "SELECT k.*, m.mk_nama AS MK, d.dosen_nama AS DSN,
		l.kls_kode AS KLS
		FROM tb_kuesioner k 
		INNER JOIN tb_kelas l
		ON k.kue_kd_kls=l.kls_kode
		INNER JOIN tb_matakuliah m 
		ON k.kue_kd_mk=m.mk_kode
		INNER JOIN tb_dosen d
		ON k.kue_id_dosen=d.dosen_id WHERE k.kue_id='$id_kue'";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return $data;
	}


	public function getMatakuliahDosen($id)
	{
		$sql = "SELECT k.*, m.mk_nama AS MK, d.dosen_nama AS DSN
		FROM tb_kuesioner k 
		INNER JOIN tb_matakuliah m 
		ON k.kue_kd_mk=m.mk_kode
		INNER JOIN tb_dosen d
		ON k.kue_id_dosen=d.dosen_id
		WHERE kue_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return $data;
	}

	public function getFakultas($kode=false)
	{
		if ($kode==false) {
			$sql = "SELECT f.fak_kode AS FA, CONCAT(f.fak_kode, ' - ', f.fak_nama) AS FAK
			FROM tb_prodi p 
			INNER JOIN tb_fakultas f 
			WHERE p.prodi_kd_fak=f.fak_kode GROUP BY f.fak_kode";
		} else {
			$sql = "SELECT f.fak_kode AS FA, CONCAT(f.fak_kode, ' - ', f.fak_nama) AS FAK
			FROM tb_prodi p 
			INNER JOIN tb_fakultas f 
			WHERE p.prodi_kd_fak=f.fak_kode AND p.prodi_kode='$kode' GROUP BY f.fak_kode";
		}

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

	public function getKelas($kode=false)
	{
		if ($kode == false) {
			$sql = "SELECT k.*, p.prodi_nama AS PRD
			FROM tb_kelas k 
			INNER JOIN tb_prodi p 
			ON k.kls_kd_prodi=p.prodi_kode
			WHERE k.kls_aktif='Y'";
		} else {
			$sql = "SELECT k.*, p.prodi_nama AS PRD
			FROM tb_kelas k 
			INNER JOIN tb_prodi p 
			ON k.kls_kd_prodi=p.prodi_kode
			WHERE k.kls_aktif='Y' AND p.prodi_kode='$kode'";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function getMatakuliah($kode)
	{
		if ($kode == false) {
			$sql = "SELECT * from tb_matakuliah WHERE mk_aktif='Y' ORDER BY mk_nama";
		} else {
			$sql = "SELECT * from tb_matakuliah WHERE mk_kd_prodi='$kode' AND mk_aktif='Y' ORDER BY mk_nama";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function getDosen($kode)
	{
		if ($kode == false) {
			$sql = "SELECT * from tb_dosen WHERE dosen_aktif='Y' ORDER BY dosen_nama";
		} else {
			$sql = "SELECT * from tb_dosen WHERE dosen_kd_prodi='$kode' AND dosen_aktif='Y' ORDER BY dosen_nama";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}
}
