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


class Matakuliah extends Koneksi {

	public function tampil($user_prodi=false)
	{
		if ($user_prodi==false) {
			$sql = "SELECT m.*, CONCAT(m.mk_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_matakuliah m 
			INNER JOIN tb_prodi p 
			ON m.mk_kd_prodi=p.prodi_kode ORDER BY p.prodi_kode, m.mk_nama";
		} else {
			$sql = "SELECT m.*, CONCAT(m.mk_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_matakuliah m 
			INNER JOIN tb_prodi p 
			ON m.mk_kd_prodi=p.prodi_kode WHERE m.mk_kd_prodi='$user_prodi'
			ORDER BY p.prodi_kode, m.mk_nama";
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
		$mk_kd_prodi = $_POST['mk_kd_prodi'];
		$mk_kode = $_POST['mk_kode'];
		$mk_nama = $_POST['mk_nama'];
		$mk_sks = $_POST['mk_sks'];

		$sql = "INSERT INTO tb_matakuliah SET 
		mk_kd_prodi=:mk_kd_prodi,
		mk_kode=:mk_kode,
		mk_nama=:mk_nama,
		mk_sks=:mk_sks";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':mk_kd_prodi', $mk_kd_prodi);
		$stmt->bindParam(':mk_kode', $mk_kode);
		$stmt->bindParam(':mk_nama', $mk_nama);
		$stmt->bindParam(':mk_sks', $mk_sks);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_matakuliah WHERE mk_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$mk_id = $_POST['mk_id'];
		$mk_kd_prodi = $_POST['mk_kd_prodi'];
		$mk_kode = $_POST['mk_kode'];
		$mk_nama = $_POST['mk_nama'];
		$mk_sks = $_POST['mk_sks'];
		$mk_aktif = $_POST['mk_aktif'];

		$f = $mk_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_matakuliah SET 
		mk_kd_prodi=:mk_kd_prodi,
		mk_kode=:mk_kode,
		mk_nama=:mk_nama,
		mk_sks=:mk_sks,
		mk_aktif=:mk_aktif WHERE mk_id=:mk_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':mk_kd_prodi', $mk_kd_prodi);
		$stmt->bindParam(':mk_kode', $mk_kode);
		$stmt->bindParam(':mk_nama', $mk_nama);
		$stmt->bindParam(':mk_sks', $mk_sks);
		$stmt->bindParam(':mk_aktif', $f);
		$stmt->bindParam(':mk_id', $mk_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
}

