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


class Kelas extends Koneksi {

	public function tampil($user_prodi=false)
	{
		if ($user_prodi==false) {
			$sql = "SELECT k.*, p.prodi_kd_fak AS FAK, CONCAT(p.prodi_kode, '-', p.prodi_nama) as PRD 
			FROM tb_kelas k
			INNER JOIN tb_prodi p
			ON k.kls_kd_prodi=p.prodi_kode ORDER BY p.prodi_kd_fak, k.kls_kode";
		} else {
			$sql = "SELECT k.*, p.prodi_kd_fak AS FAK, CONCAT(p.prodi_kode, '-', p.prodi_nama) as PRD 
			FROM tb_kelas k
			INNER JOIN tb_prodi p
			ON k.kls_kd_prodi=p.prodi_kode WHERE k.kls_kd_prodi='$user_prodi' ORDER BY p.prodi_kd_fak, k.kls_kode";
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
		$kls_kd_prodi = $_POST['kls_kd_prodi'];
		$kls_kode = $_POST['kls_kode'];
		$kls_nama = $_POST['kls_nama'];

		$sql = "INSERT INTO tb_kelas SET 
		kls_kd_prodi=:kls_kd_prodi,
		kls_kode=:kls_kode,
		kls_nama=:kls_nama";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':kls_kd_prodi', $kls_kd_prodi);
		$stmt->bindParam(':kls_kode', $kls_kode);
		$stmt->bindParam(':kls_nama', $kls_nama);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_kelas WHERE kls_kode='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$kls_id = $_POST['kls_id'];
		$kls_kd_prodi = $_POST['kls_kd_prodi'];
		$kls_kode = $_POST['kls_kode'];
		$kls_nama = $_POST['kls_nama'];
		$kls_aktif = $_POST['kls_aktif'];
		$f = $kls_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_kelas SET 
		kls_kd_prodi=:kls_kd_prodi,
		kls_kode=:kls_kode,
		kls_nama=:kls_nama,
		kls_aktif=:kls_aktif
		WHERE kls_id=:kls_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':kls_kd_prodi', $kls_kd_prodi);
		$stmt->bindParam(':kls_kode', $kls_kode);
		$stmt->bindParam(':kls_nama', $kls_nama);
		$stmt->bindParam(':kls_aktif', $f);
		$stmt->bindParam(':kls_id', $kls_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function klsMhsw($id)
	{
		
		$sql = "SELECT k.*, m.mhsw_nama as NM 
		FROM tb_kelas_mhsw k 
		INNER JOIN tb_mhsw m
		ON k.km_user=m.mhsw_nim WHERE k.km_kd_kelas='$id' ORDER BY m.mhsw_nama";		

		//$sql = "SELECT * FROM tb_kelas_mhsw WHERE km_kd_kelas='$id'";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function klsMhswInput()
	{
		
		$km_kd_tahun = $_POST['km_kd_tahun'];
		$km_kd_kelas = $_POST['km_kd_kelas'];
		$km_user = $_POST['km_user'];

		$sql = "INSERT INTO tb_kelas_mhsw SET 
		km_kd_tahun=:km_kd_tahun,
		km_kd_kelas=:km_kd_kelas,
		km_user=:km_user";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':km_kd_tahun', $km_kd_tahun);
		$stmt->bindParam(':km_kd_kelas', $km_kd_kelas);
		$stmt->bindParam(':km_user', $km_user);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function klsMhswHapus($id)
	{
		
		$sql = "DELETE FROM tb_kelas_mhsw WHERE km_id='$id'";		
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return false;
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
}
