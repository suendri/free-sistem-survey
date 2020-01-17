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


class User extends Koneksi {

	public function tampil($kode=false)
	{
		if ($kode==false) {
			$sql = "SELECT u.*, g.group_nama AS GR 
			FROM tb_user u 
			INNER JOIN tb_usergroup g
			ON u.user_group=g.group_id";
		} else {
			$sql = "SELECT u.*, g.group_nama AS GR 
			FROM tb_user u 
			INNER JOIN tb_usergroup g
			ON u.user_group=g.group_id WHERE u.user_kd_prodi='$kode'";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$data = array();
		while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $rows;
		}

		return $data;
	}

	public function getGroup($kode=false)
	{
		if ($kode==false) {
			$sql = "SELECT * FROM tb_usergroup ORDER BY group_id";
		} else {
			$sql = "SELECT * FROM tb_usergroup WHERE group_id>2 ORDER BY group_id";
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

		$user_name= $_POST['user_name'];
		$user_password = $_POST['user_password'];
		$user_group = $_POST['user_group'];
		$user_kd_prodi = $_POST['user_kd_prodi'];

		$sql = "INSERT INTO tb_user SET user_name=:user_name, 
		user_password=PASSWORD(:user_password), user_group=:user_group, 
		user_kd_prodi=:user_kd_prodi";
		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(":user_name", $user_name);
		$stmt->bindParam(":user_password", $user_password);
		$stmt->bindParam(":user_group", $user_group);
		$stmt->bindParam(":user_kd_prodi", $user_kd_prodi);

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}

	public function edit($user_id)
	{
		$sql = "SELECT * FROM tb_user WHERE user_id='$user_id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;

	}

	public function update()
	{
		$user_id = $_POST['user_id'];
		$user_password = $_POST['user_password'];
		$user_group = $_POST['user_group'];
		$user_kd_prodi = $_POST['user_kd_prodi'];
		$user_aktif = $_POST['user_aktif'];

		$f = $user_aktif == 'Y' ? 'Y' : 'T';

		if (empty($user_password)) {
			$sql = "UPDATE tb_user SET user_group=:user_group,
			user_kd_prodi=:user_kd_prodi,
			user_aktif=:user_aktif WHERE user_id=:user_id";

			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(":user_id", $user_id);
			$stmt->bindParam(":user_group", $user_group);
			$stmt->bindParam(":user_kd_prodi", $user_kd_prodi);
			$stmt->bindParam(":user_aktif", $f);
		} else {
			$sql = "UPDATE tb_user SET user_password=PASSWORD(:user_password),
			user_group=:user_group, user_kd_prodi=:user_kd_prodi,
			user_aktif=:user_aktif WHERE user_id=:user_id";

			$stmt = $this->db->prepare($sql);

			$stmt->bindParam(":user_id", $user_id);
			$stmt->bindParam(":user_password", $user_password);
			$stmt->bindParam(":user_group", $user_group);
			$stmt->bindParam(":user_kd_prodi", $user_kd_prodi);
			$stmt->bindParam(":user_aktif", $f);
		}
		
		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
	
}