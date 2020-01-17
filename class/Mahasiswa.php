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


class Mahasiswa extends Koneksi {

	public function tampil($user_prodi=false)
	{
		if ($user_prodi==false) {
			$sql = "SELECT m.*, CONCAT(m.mhsw_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_mhsw m 
			INNER JOIN tb_prodi p 
			ON m.mhsw_kd_prodi=p.prodi_kode ORDER BY m.mhsw_kd_prodi, m.mhsw_nim";
		} else {
			$sql = "SELECT m.*, CONCAT(m.mhsw_kd_prodi, '-', p.prodi_nama) AS PRD
			FROM tb_mhsw m 
			INNER JOIN tb_prodi p 
			ON m.mhsw_kd_prodi=p.prodi_kode WHERE m.mhsw_kd_prodi='$user_prodi'
			AND m.mhsw_nim NOT IN (SELECT km_user FROM tb_kelas_mhsw)
			ORDER BY m.mhsw_kd_prodi, m.mhsw_nim";
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
		$mhsw_kd_prodi = $_POST['mhsw_kd_prodi'];
		$mhsw_nim = $_POST['mhsw_nim'];
		$mhsw_nama = $_POST['mhsw_nama'];

		$sql = "INSERT INTO tb_mhsw SET
		mhsw_user=:mhsw_user,
		mhsw_kd_prodi=:mhsw_kd_prodi, 
		mhsw_nim=:mhsw_nim,
		mhsw_nama=UCASE(:mhsw_nama)";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':mhsw_user', $mhsw_nim);
		$stmt->bindParam(':mhsw_kd_prodi',$mhsw_kd_prodi);
		$stmt->bindParam(':mhsw_nim', $mhsw_nim);
		$stmt->bindParam(':mhsw_nama', $mhsw_nama);
		
		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;	
		
	}

	public function userAdd()
	{		
		$mhsw_kd_prodi = $_POST['mhsw_kd_prodi'];
		$mhsw_nim = $_POST['mhsw_nim'];
		$mhsw_group = 4;
		
		$sql = "INSERT INTO tb_user SET user_name=:user_name, 
		user_password=PASSWORD(:user_password), user_group=:user_group, 
		user_kd_prodi=:user_kd_prodi";
		
		$stmt = $this->db->prepare($sql);
		
		$stmt->bindParam(':user_name',$mhsw_nim);
		$stmt->bindParam(':user_password', $mhsw_nim);
		$stmt->bindParam(':user_group', $mhsw_group);
		$stmt->bindParam(':user_kd_prodi', $mhsw_kd_prodi);
		
		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'User baru ditambahkan');
		} else {
			Fungsi::setSession('feedback_negative', 'User baru gagal ditambahkan');
		}

		return false;

	}
	
	public function edit($id)
	{
		$sql = "SELECT * FROM tb_mhsw WHERE mhsw_id='$id'";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		//Menampilkan data berdasarkan id
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 

		return $row;
	}

	public function update()
	{
		$mhsw_id = $_POST['mhsw_id'];
		$mhsw_kd_prodi = $_POST['mhsw_kd_prodi'];
		$mhsw_nim = $_POST['mhsw_nim'];
		$mhsw_nama = $_POST['mhsw_nama'];
		$mhsw_aktif = $_POST['mhsw_aktif'];

		$f = $mhsw_aktif == 'Y' ? 'Y' : 'T';

		$sql = "UPDATE tb_mhsw SET 
		mhsw_kd_prodi=:mhsw_kd_prodi, 
		mhsw_nim=:mhsw_nim,
		mhsw_nama=UCASE(:mhsw_nama),
		mhsw_aktif=:mhsw_aktif WHERE mhsw_id=:mhsw_id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':mhsw_kd_prodi',$mhsw_kd_prodi);
		$stmt->bindParam(':mhsw_nim', $mhsw_nim);
		$stmt->bindParam(':mhsw_nama', $mhsw_nama);	
		$stmt->bindParam(':mhsw_aktif', $f);
		$stmt->bindParam(':mhsw_id', $mhsw_id);		

		if ($stmt->execute()) {
			Fungsi::setSession('feedback_positive', 'Data berhasil disimpan');
		} else {
			Fungsi::setSession('feedback_negative', 'Data gagal disimpan!');
		}

		return false;
	}
}
