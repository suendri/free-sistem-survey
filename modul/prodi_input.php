<?php 

if(!defined('gosoftware')) { header("location:/"); }

$prd = new Prodi();
$rows = $prd->getFakultas();

?>

<h3><i class="fas fa-list-alt"></i> Tambah Prodi</h3>

<form method="POST" action="<?php echo URL; ?>prodi_proses">
	<div class="form-group">
		<label>Fakultas</label>
		<select class="form-control" name="prodi_kd_fak" required="">
			<?php foreach ($rows as $row) {?>
				<option value="<?php echo $row['fak_kode']; ?>"><?php echo $row['fak_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="prodi_kode" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="prodi_nama" required="">
	</div>
	<input type="submit" class="btn btn-primary" name="prcinput" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>prodi_tampil">BATAL</a>
</form>
