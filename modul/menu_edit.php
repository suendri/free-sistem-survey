<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$mn = new Menu();
$row = $mn->edit($id);

?>

<h3><i class="fas fa-list-alt"></i> Edit Menu</h3>

<form method="POST" action="<?php echo URL; ?>menu_proses">
	<input type="hidden" name="menu_id" value="<?php echo $row['menu_id'];?>">
	<div class="form-group">
		<label>Parent</label>
		<input type="text" class="form-control" name="menu_parent" value="<?php echo $row['menu_parent'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="menu_nama" value="<?php echo $row['menu_nama'];?>" required="">
	</div>
	<div class="form-group">
		<label>Link</label>
		<input type="text" class="form-control" name="menu_link" value="<?php echo $row['menu_link'];?>" required="">
	</div>
	<div class="form-group">
		<label>Privilage</label>
		<input type="text" class="form-control" name="menu_privilage" value="<?php echo $row['menu_privilage'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['menu_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="menu_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>menu_tampil">BATAL</a>
</form>
