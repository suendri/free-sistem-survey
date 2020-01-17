<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$ins = new Instrumen();
$row = $ins->edit($id);

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi(Fungsi::getSession('user_prodi'));

?>

<h3><i class="fas fa-list-alt"></i> Edit Instrumen</h3>

<form method="POST" action="<?php echo URL; ?>instrumen_proses">
	<input type="hidden" name="ins_id" value="<?php echo $row['ins_id'];?>">
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="ins_kd_prodi" required="">
			<?php foreach ($universal_prodi as $row2) {
				$selected = $row['ins_kd_prodi'] == $row2['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row2['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="ins_kode" value="<?php echo $row['ins_kode'];?>" required="">
	</div>
	<div class="form-group">
		<label>Pernyataan</label>
		<textarea class="form-control" name="ins_pernyataan" required=""><?php echo $row['ins_pernyataan'];?></textarea>
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['ins_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="ins_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>instrumen_tampil">BATAL</a>
</form>
