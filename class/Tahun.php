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


class Tahun extends Koneksi {

	public function tampil()
	{
		$sql = "SELECT * FROM tb_tahun";
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

		$thn_kode = $_POST['thn_kode'];
		$thn_nama = $_POST['thn_nama'];

		$sql = "INSERT INTO tb_tahun SET 
		thn_kode=:thn_kode, thn_nama=:thn_nama";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':thn_kode', $thn_kode);
		$stmt->bindParam(':thn_nama', $thn_nama);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_tahun WHERE thn_kode='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$thn_id = $_POST['thn_id'];
		$thn_kode = $_POST['thn_kode'];
		$thn_nama = $_POST['thn_nama'];
		$thn_aktif = $_POST['thn_aktif'];

		$f = $thn_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_tahun SET 
		thn_kode=:thn_kode, thn_nama=:thn_nama,
		thn_aktif=:thn_aktif WHERE thn_id=:thn_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':thn_kode', $thn_kode);
		$stmt->bindParam(':thn_nama', $thn_nama);
		$stmt->bindParam(':thn_aktif', $f);
		$stmt->bindParam(':thn_id', $thn_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
}
