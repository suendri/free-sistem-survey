<?php 

if(!defined('gosoftware')) { header("location:/"); }

$prodi = Fungsi::getSession('user_prodi');
$user = new User();
$rows1 = $user->getGroup($prodi);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi($prodi);

?>

<h3><i class="fas fa-list-alt"></i> Tambah User</h3>

<form method="POST" action="<?php echo URL; ?>user_proses">
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" name="user_name" required="" autocomplete="off">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="user_password" required="" autocomplete="off">
	</div>
	<div class="form-group">
		<label>Group</label>
		<select class="form-control" name="user_group" required="">
			<?php foreach ($rows1 as $row1) {?>
				<option value="<?php echo $row1['group_id']; ?>"><?php echo $row1['group_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="user_kd_prodi" required="">
				<option value="">Pilih Prodi ...</option>
			<?php foreach ($universal_prodi as $row2) {?>
				<option value="<?php echo $row2['prodi_kode']; ?>"><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<input type="submit" class="btn btn-primary" name="prcinput" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>user_tampil">BATAL</a>
</form>
