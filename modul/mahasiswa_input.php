<?php 

if(!defined('gosoftware')) { header("location:/"); }

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdi(Fungsi::getSession('user_prodi'));

?>

<h3><i class="fas fa-list-alt"></i> Tambah Mahasiswa</h3>

<form method="POST" action="<?php echo URL; ?>mahasiswa_proses">
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="mhsw_kd_prodi" required="">
			<?php foreach ($universal_prodi as $row2) {?>
				<option value="<?php echo $row2['prodi_kode']; ?>"><?php echo $row2['prodi_kode']; ?> - <?php echo $row2['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>NIM</label>
		<input type="text" class="form-control" name="mhsw_nim" required="">
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="mhsw_nama" required="">
	</div>
	<input type="submit" class="btn btn-primary" name="prcinput" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>mahasiswa_tampil">BATAL</a>
</form>
