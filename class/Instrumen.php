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


class Instrumen extends Koneksi {

	public function tampil($user_prodi=false)
	{
		if ($user_prodi==false) {
			$sql = "SELECT i.*, CONCAT(i.ins_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_instrumen i 
			INNER JOIN tb_prodi p 
			ON i.ins_kd_prodi=p.prodi_kode ORDER BY i.ins_kd_prodi, i.ins_kode";
		} else {
			$sql = "SELECT i.*, CONCAT(i.ins_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_instrumen i 
			INNER JOIN tb_prodi p 
			ON i.ins_kd_prodi=p.prodi_kode WHERE i.ins_kd_prodi='$user_prodi'
			ORDER BY i.ins_kd_prodi, i.ins_kode";
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
		$ins_kd_prodi = $_POST['ins_kd_prodi'];
		$ins_kode = $_POST['ins_kode'];
		$ins_pernyataan = $_POST['ins_pernyataan'];
		$ins_creator = Fungsi::getSession('user_name');

		$sql = "INSERT INTO tb_instrumen SET 
		ins_kd_prodi=:ins_kd_prodi,
		ins_kode=:ins_kode,
		ins_pernyataan=:ins_pernyataan,
		ins_creator=:ins_creator,
		ins_create_at=CURRENT_TIME()";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':ins_kd_prodi', $ins_kd_prodi);
		$stmt->bindParam(':ins_kode', $ins_kode);
		$stmt->bindParam(':ins_pernyataan', $ins_pernyataan);
		$stmt->bindParam(':ins_creator', $ins_creator);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_instrumen WHERE ins_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$ins_id = $_POST['ins_id'];
		$ins_kd_prodi = $_POST['ins_kd_prodi'];
		$ins_kode = $_POST['ins_kode'];
		$ins_pernyataan = $_POST['ins_pernyataan'];
		$ins_aktif = $_POST['ins_aktif'];

		$f = $ins_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_instrumen SET  
		ins_kd_prodi=:ins_kd_prodi,
		ins_kode=:ins_kode,
		ins_pernyataan=:ins_pernyataan,
		ins_aktif=:ins_aktif,
		ins_update_at=CURRENT_TIME()
		WHERE ins_id=:ins_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':ins_kd_prodi', $ins_kd_prodi);
		$stmt->bindParam(':ins_kode', $ins_kode);
		$stmt->bindParam(':ins_pernyataan', $ins_pernyataan);
		$stmt->bindParam(':ins_aktif', $f);
		$stmt->bindParam(':ins_id', $ins_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;

	}
}
