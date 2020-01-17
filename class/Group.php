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


class Group extends Koneksi {

	public function tampil()
	{
		$sql = "SELECT * FROM tb_usergroup";
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

		$group_nama= $_POST['group_nama'];

		$sql = "INSERT INTO tb_usergroup SET 
		group_nama=:group_nama";
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(":group_nama", $group_nama);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_usergroup WHERE group_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;

	}

	public function update()
	{
		$group_id = $_POST['group_id'];
		$group_nama= $_POST['group_nama'];

		$sql = "UPDATE tb_usergroup SET 
		group_nama=:group_nama
		WHERE group_id=:group_id";
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(":group_nama", $group_nama);
		$stmt->bindParam(":group_id", $group_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
	
}