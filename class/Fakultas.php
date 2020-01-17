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


class Fakultas extends Koneksi {

	public function tampil()
	{
		$sql = "SELECT * FROM tb_fakultas";
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

		$fak_kode = $_POST['fak_kode'];
		$fak_nama = $_POST['fak_nama'];

		$sql = "INSERT INTO tb_fakultas set 
		fak_kode=:fak_kode,fak_nama=:fak_nama";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':fak_kode', $fak_kode);
		$stmt->bindParam(':fak_nama', $fak_nama);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_fakultas WHERE fak_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$fak_id = $_POST['fak_id'];
		$fak_kode = $_POST['fak_kode'];
		$fak_nama = $_POST['fak_nama'];
		$fak_aktif = $_POST['fak_aktif'];
		$f = $fak_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_fakultas set fak_kode=:fak_kode,fak_nama=:fak_nama,fak_aktif=:fak_aktif WHERE fak_id=:fak_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':fak_kode', $fak_kode);
		$stmt->bindParam(':fak_nama', $fak_nama);
		$stmt->bindParam(':fak_aktif', $f);
		$stmt->bindParam(':fak_id', $fak_id);
		
		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
} 
