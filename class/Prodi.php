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


class Prodi extends Koneksi {

	public function tampil()
	{
		$sql = "SELECT * FROM tb_prodi";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function getFakultas()
	{
		$sql = "SELECT * FROM tb_fakultas WHERE fak_aktif='Y' ORDER BY fak_nama";

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
		$prodi_kd_fak = $_POST['prodi_kd_fak'];
		$prodi_kode = $_POST['prodi_kode'];
		$prodi_nama = $_POST['prodi_nama'];

		$sql = "INSERT INTO tb_prodi SET 
		prodi_kd_fak=:prodi_kd_fak,
		prodi_kode=:prodi_kode,
		prodi_nama=:prodi_nama";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':prodi_kd_fak', $prodi_kd_fak);
		$stmt->bindParam(':prodi_kode', $prodi_kode);
		$stmt->bindParam(':prodi_nama', $prodi_nama);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_prodi WHERE prodi_kode='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$prodi_id = $_POST['prodi_id'];
		$prodi_kd_fak = $_POST['prodi_kd_fak'];
		$prodi_kode = $_POST['prodi_kode'];
		$prodi_nama = $_POST['prodi_nama'];
		$prodi_aktif = $_POST['prodi_aktif'];
		$f = $prodi_aktif == 'Y' ? 'Y' : 'T';
		
		$sql = "UPDATE tb_prodi SET 
		prodi_kd_fak=:prodi_kd_fak,
		prodi_kode=:prodi_kode,
		prodi_nama=:prodi_nama,
		prodi_aktif=:prodi_aktif
		WHERE prodi_id=:prodi_id";

		$stmt = $this->db->prepare($sql);
		
		$stmt->bindParam(':prodi_kd_fak', $prodi_kd_fak);
		$stmt->bindParam(':prodi_kode', $prodi_kode);
		$stmt->bindParam(':prodi_nama', $prodi_nama);
		$stmt->bindParam(':prodi_aktif', $f);
		$stmt->bindParam(':prodi_id', $prodi_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
}
