<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$mhsw = new Mahasiswa();
$row = $mhsw->edit($id);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi(Fungsi::getSession('user_prodi'));

?>

<h3><i class="fas fa-list-alt"></i> Edit Mahasiswa</h3>

<form method="POST" action="<?php echo URL; ?>mahasiswa_proses">
	<input type="hidden" name="mhsw_id" value="<?php echo $row['mhsw_id'];?>">
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" value="<?php echo $row['mhsw_user'];?>" readonly>
	</div>
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="mhsw_kd_prodi" required="">
			<?php foreach ($universal_prodi as $row2) {
				$selected = $row['mhsw_kd_prodi'] == $row2['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row2['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>NIM</label>
		<input type="text" class="form-control" name="mhsw_nim" value="<?php echo $row['mhsw_nim'];?>" required="">
	</div>
	<div class="form-group">
		<label>NAMA</label>
		<input type="text" class="form-control" name="mhsw_nama" value="<?php echo $row['mhsw_nama'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['mhsw_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="mhsw_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>mahasiswa_tampil">BATAL</a>
</form>
