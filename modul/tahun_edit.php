<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$thn = new Tahun();
$row = $thn->edit($id);

?>

<h3><i class="fas fa-list-alt"></i> Edit Tahun</h3>

<form method="POST" action="<?php echo URL; ?>tahun_proses">
	<input type="hidden" name="thn_id" value="<?php echo $row['thn_id'];?>">
	<div class="form-group">
		<label>Kode</label>
		<input type="text" class="form-control" name="thn_kode" value="<?php echo $row['thn_kode'];?>" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="thn_nama" value="<?php echo $row['thn_nama'];?>" required="">
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['thn_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="thn_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>tahun_tampil">BATAL</a>
</form>
