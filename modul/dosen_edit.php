<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$dosen = new Dosen();
$row = $dosen->edit($id);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi(Fungsi::getSession('user_prodi'));
?>

<h3><i class="fas fa-list-alt"></i> Edit Dosen</h3>

<form method="POST" action="<?php echo URL; ?>dosen_proses">
	<input type="hidden" name="dosen_id" value="<?php echo $row['dosen_id'];?>">
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="dosen_kd_prodi" required="">
			<?php foreach ($universal_prodi as $row2) {
				$selected = $row['dosen_kd_prodi'] == $row2['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row2['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>NIP</label>
		<input type="text" class="form-control" name="dosen_nip" value="<?php echo $row['dosen_nip'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="dosen_nama" value="<?php echo $row['dosen_nama'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['dosen_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="dosen_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>dosen_tampil">BATAL</a>
</form>
