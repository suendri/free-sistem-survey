<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$kls = new Kelas();
$row = $kls->edit($id);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi(Fungsi::getSession('user_prodi'));

?>

<h3><i class="fas fa-list-alt"></i> Edit Kelas</h3>

<form method="POST" action="<?php echo URL; ?>kelas_proses">
	<input type="hidden" name="kls_id" value="<?php echo $row['kls_id'];?>">
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="kls_kd_prodi" required="">
			<?php foreach ($universal_prodi as $row2) {
				$selected = $row['kls_kd_prodi'] == $row2['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row2['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="kls_kode" value="<?php echo $row['kls_kode'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="kls_nama" value="<?php echo $row['kls_nama'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['kls_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="kls_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>kelas_tampil">BATAL</a>
</form>
