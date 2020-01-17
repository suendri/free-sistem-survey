<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$group = new Group();
$row = $group->edit($id);

?>

<h3><i class="fas fa-list-alt"></i> Edit Group</h3>

<form method="POST" action="<?php echo URL; ?>group_proses">
	<input type="hidden" name="group_id" value="<?php echo $row['group_id'];?>">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="group_nama" value="<?php echo $row['group_nama'];?>" required="">
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>group_tampil">BATAL</a>
</form>
