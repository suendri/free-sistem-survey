<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$prodi = Fungsi::getSession('user_prodi');
$user = new User();
$row = $user->edit($id);
$rows1 = $user->getGroup($prodi);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi($prodi);

?>

<h3>Edit User</h3>

<form method="POST" action="<?php echo URL; ?>user_proses">
	<input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>">
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" value="<?php echo $row['user_name'];?>" readonly>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>
	<div class="form-group">
		<label>Group</label>
		<select class="form-control" name="user_group" required="">
			<?php foreach ($rows1 as $row1) {
				$selected = $row['user_group'] == $row1['group_id'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row1['group_id']; ?>"<?php echo $selected; ?>><?php echo $row1['group_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="user_kd_prodi" required="">
			<option value="">:: Semua Prodi</option>
			<?php foreach ($universal_prodi as $row2) {
				$selected = $row['user_kd_prodi'] == $row2['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row2['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['user_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="user_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>user_tampil">BATAL</a>
</form>
