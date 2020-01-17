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


class Login extends Koneksi {

	public function proses()
	{
		try {
			$user_name = htmlspecialchars(strip_tags($_POST['user_name']));
			$user_password = htmlspecialchars(strip_tags($_POST['user_password']));

			$query = "SELECT * FROM tb_user WHERE user_name = ? AND user_password = PASSWORD(?) AND user_aktif='Y' LIMIT 0,1";
			$stmt = $this->db->prepare($query);
			$stmt->bindParam(1, $user_name);
			$stmt->bindParam(2, $user_password);
			$stmt->execute();
			$num = $stmt->rowCount();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($num > 0) {
				Fungsi::setSession('user_login', TRUE);
				Fungsi::setSession('user_name', $row['user_name']);
				Fungsi::setSession('user_prodi', $row['user_kd_prodi']);

				$query_gr = "SELECT * FROM tb_usergroup WHERE group_id = ? LIMIT 0,1";
				$stmt_gr = $this->db->prepare($query_gr);
				$stmt_gr->bindParam(1, $row['user_group']);
				$stmt_gr->execute();
				$row_gr = $stmt_gr->fetch(PDO::FETCH_ASSOC);

				Fungsi::setSession('user_level', $row_gr['group_id']);
				Fungsi::setSession('user_group', $row_gr['group_nama']);

				header("location:" . URL);
			} else {
				sleep(3);
				Fungsi::setSession('feedback_error', 'Username dan Password<br>tidak ditemukan!');
				header("location:" . URL);
			}
		} catch (PDOException $exception) {
			die('ERROR: ' . $exception->getMessage());
		}
	}
}