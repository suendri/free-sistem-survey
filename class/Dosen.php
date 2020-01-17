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


class Dosen extends Koneksi {

	public function tampil($user_prodi=false)
	{
		if ($user_prodi==false) {
			$sql = "SELECT d.*, CONCAT(d.dosen_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_dosen d 
			INNER JOIN tb_prodi p 
			ON d.dosen_kd_prodi=p.prodi_kode ORDER BY d.dosen_kd_prodi, d.dosen_nama";
		} else {
			$sql = "SELECT d.*, CONCAT(d.dosen_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_dosen d 
			INNER JOIN tb_prodi p 
			ON d.dosen_kd_prodi=p.prodi_kode WHERE d.dosen_kd_prodi='$user_prodi'
			ORDER BY d.dosen_kd_prodi, d.dosen_nama";
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
		$dosen_kd_prodi = $_POST['dosen_kd_prodi'];
		$dosen_nip = $_POST['dosen_nip'];
		$dosen_nama = $_POST['dosen_nama'];

		$sql = "INSERT INTO tb_dosen SET 
		dosen_kd_prodi=:dosen_kd_prodi,
		dosen_nip=:dosen_nip,
		dosen_nama=:dosen_nama";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':dosen_kd_prodi', $dosen_kd_prodi);
		$stmt->bindParam(':dosen_nip', $dosen_nip);
		$stmt->bindParam(':dosen_nama', $dosen_nama);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_dosen WHERE dosen_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$dosen_id = $_POST['dosen_id'];
		$dosen_kd_prodi = $_POST['dosen_kd_prodi'];
		$dosen_nip = $_POST['dosen_nip'];
		$dosen_nama = $_POST['dosen_nama'];
		$dosen_aktif = $_POST['dosen_aktif'];

		$f = $dosen_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_dosen SET  
		dosen_kd_prodi=:dosen_kd_prodi,
		dosen_nip=:dosen_nip,
		dosen_nama=:dosen_nama,
		dosen_aktif=:dosen_aktif
		WHERE dosen_id=:dosen_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':dosen_kd_prodi', $dosen_kd_prodi);
		$stmt->bindParam(':dosen_nip', $dosen_nip);
		$stmt->bindParam(':dosen_nama', $dosen_nama);
		$stmt->bindParam(':dosen_aktif', $f);
		$stmt->bindParam(':dosen_id', $dosen_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
}
