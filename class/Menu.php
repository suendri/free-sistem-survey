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


class Menu extends Koneksi {

	public function tampil()
	{
		$sql = "SELECT * FROM tb_usermenu";
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

		$menu_parent= $_POST['menu_parent'];
		$menu_nama = $_POST['menu_nama'];
		$menu_link = $_POST['menu_link'];
		$menu_privilage = $_POST['menu_privilage'];

		$sql = "INSERT INTO tb_usermenu SET 
				menu_parent=:menu_parent, 
				menu_nama=:menu_nama, 
				menu_link=:menu_link,
				menu_privilage=:menu_privilage";
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(":menu_parent", $menu_parent);
		$stmt->bindParam(":menu_nama", $menu_nama);
		$stmt->bindParam(":menu_link", $menu_link);
		$stmt->bindParam(":menu_privilage", $menu_privilage);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function edit($id)
	{
		$sql = "SELECT * FROM tb_usermenu WHERE menu_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

        return $row;

	}

	public function update()
	{
		$menu_id= $_POST['menu_id'];
		$menu_parent= $_POST['menu_parent'];
		$menu_nama = $_POST['menu_nama'];
		$menu_link = $_POST['menu_link'];
		$menu_privilage = $_POST['menu_privilage'];
		$menu_aktif = $_POST['menu_aktif'];

		$f = $menu_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_usermenu SET 
				menu_parent=:menu_parent, 
				menu_nama=:menu_nama, 
				menu_link=:menu_link,
				menu_privilage=:menu_privilage,
				menu_aktif=:menu_aktif WHERE menu_id=:menu_id";
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(":menu_parent", $menu_parent);
		$stmt->bindParam(":menu_nama", $menu_nama);
		$stmt->bindParam(":menu_link", $menu_link);
		$stmt->bindParam(":menu_privilage", $menu_privilage);
		$stmt->bindParam(":menu_aktif", $f);
		$stmt->bindParam(":menu_id", $menu_id);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
	
}