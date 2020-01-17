<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$mk = new Matakuliah();
$row = $mk->edit($id);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi(Fungsi::getSession('user_prodi'));

?>

<h3><i class="fas fa-list-alt"></i> Edit Matakuliah</h3>

<form method="POST" action="<?php echo URL; ?>matakuliah_proses">
	<input type="hidden" name="mk_id" value="<?php echo $row['mk_id'];?>">
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="mk_kd_prodi" required="">
			<?php foreach ($universal_prodi as $row2) {
				$selected = $row['mk_kd_prodi'] == $row2['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row2['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kode mata Kuliah</label>
		<input type="text" class="form-control" name="mk_kode" value="<?php echo $row['mk_kode'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="mk_nama" value="<?php echo $row['mk_nama'];?>" required="">
	</div>
	<div class="form-group">
		<label>SKS</label>
		<input type="text" class="form-control" name="mk_sks" value="<?php echo $row['mk_sks'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['mk_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="mk_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>matakuliah_tampil">BATAL</a>
</form>
