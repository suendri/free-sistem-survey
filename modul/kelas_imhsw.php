<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$km = new Kelas();
$rows1 = $dashb->getTahunAktif();

?>

<h3><i class="fas fa-list-alt"></i> Tambah Peserta Kelas</h3>

<div class="alert alert-info" role="alert">
	Data mahasiswa di-import dari menu <b>Mahasiswa</b>
	Pastikan data tersebut telah anda masukkan dan terdaftar 
	sebelum menggunakan Menu ini
</div>

<form method="POST" action="<?php echo URL; ?>kelas_proses">
	<input type="hidden" name="kode" value="<?php echo $id; ?>">
	<input type="hidden" name="km_kd_kelas" value="<?php echo $id; ?>">
	<input type="hidden" name="km_kd_tahun" value="<?php echo $rows1['thn_kode']; ?>">
	<div class="form-group">
		<label>Tahun</label>
		<input type="text" class="form-control" value="<?php echo $rows1['thn_kode'] . " - " . $rows1['thn_nama']; ?>" placeholder="Nama" readonly>
	</div>
	<div class="form-group">
		<label>Kelas</label>
		<input type="text" class="form-control" value="<?php echo $id; ?>" placeholder="Kelas" readonly>
	</div>
	<div class="form-group">
		<label>NIM</label>
		<input type="text" class="form-control" name="km_user" required="">
	</div>
	<input type="submit" class="btn btn-primary" name="prcimhsw" value="DAFTARKAN PESERTA">
	<a class="btn btn-danger" href="<?php echo URL; ?>kelas_mhsw/kode/<?php echo $id; ?>">BATAL</a>
</form>
