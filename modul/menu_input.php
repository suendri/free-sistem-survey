<?php 

if(!defined('gosoftware')) { header("location:/"); }

?>

<h3><i class="fas fa-list-alt"></i> Tambah Menu</h3>

<form method="POST" action="<?php echo URL; ?>menu_proses">
	<div class="form-group">
		<label>Parent</label>
		<input type="text" class="form-control" name="menu_parent" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="menu_nama" required="">
	</div>
	<div class="form-group">
		<label>Link</label>
		<input type="text" class="form-control" name="menu_link" required="">
	</div>
	<div class="form-group">
		<label>Privilage</label>
		<input type="text" class="form-control" name="menu_privilage" required="">
	</div>
	<input type="submit" class="btn btn-primary" name="prcinput" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>menu_tampil">BATAL</a>
</form>
