<?php 

if(!defined('gosoftware')) { header("location:/"); }

?>

<h3><i class="fas fa-list-alt"></i> Tambah Fakultas</h3>

<form method="POST" action="<?php echo URL; ?>fakultas_proses">
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="fak_kode" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="fak_nama" required="">
	</div>
	<input type="submit" class="btn btn-primary" name="prcinput" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>fakultas_tampil">BATAL</a>
</form>
