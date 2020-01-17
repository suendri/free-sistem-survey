<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$prodi = new Prodi();
$row = $prodi->edit($id);
$prd = $prodi->getFakultas();

?>

<h3><i class="fas fa-list-alt"></i> Edit Prodi</h3>

<form method="POST" action="<?php echo URL; ?>prodi_proses">
	<input type="hidden" name="prodi_id" value="<?php echo $row['prodi_id'];?>">
	<div class="form-group">
		<label>Fakultas</label>
		<select class="form-control" name="prodi_kd_fak" required="">
			<?php foreach ($prd as $row1) {
				$selected = $row['prodi_kd_fak'] == $row1['fak_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row1['fak_kode']; ?>"<?php echo $selected; ?>><?php echo $row1['fak_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="prodi_kode" value="<?php echo $row['prodi_kode'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="prodi_nama" value="<?php echo $row['prodi_nama'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['prodi_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="prodi_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>prodi_tampil">BATAL</a>
</form>
