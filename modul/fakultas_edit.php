<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$fak = new Fakultas();
$row = $fak->edit($id);

?>

<h3><i class="fas fa-list-alt"></i> Edit Fakultas</h3>

<form method="POST" action="<?php echo URL; ?>fakultas_proses">
	<input type="hidden" name="fak_id" value="<?php echo $row['fak_id'];?>">
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="fak_kode" value="<?php echo $row['fak_kode'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="fak_nama" value="<?php echo $row['fak_nama'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['fak_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="fak_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>fakultas_tampil">BATAL</a>
</form>
