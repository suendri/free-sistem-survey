<?php 

if(!defined('gosoftware')) { header("location:/"); }

$kue = new Kuesioner();

$prodi = Fungsi::getSession('user_prodi');

$rows1 = $dashb->getTahunAktif();
$rows7 = $kue->getFakultas($prodi);
$rows3 = $kue->getKelas($prodi);
$rows4 = $kue->getMatakuliah($prodi);
$rows5 = $kue->getDosen($prodi);
$rows6 = $kue->getProdi($prodi);
?>

<h3><i class="fas fa-list-alt"></i> Tambah Kuesioner</h3>

<form method="POST" action="<?php echo URL; ?>kuesioner_proses">
	<input type="hidden" name="kue_kd_tahun" value="<?php echo $rows1['thn_kode']; ?>">
	<div class="form-group">
		<label>Tahun</label>
		<input type="text" class="form-control" value="<?php echo $rows1['thn_kode'] . " - " . $rows1['thn_nama']; ?>" placeholder="Tahun" readonly>
	</div>
	<div class="form-group">
		<label>Fakultas</label>
		<select class="form-control" name="kue_kd_fak" required="">
			<?php foreach ($rows7 as $row7) {?>
				<option value="<?php echo $row7['FA']; ?>"><?php echo $row7['FAK']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="kue_kd_prodi" required="">
			<?php foreach ($rows6 as $row6) {?>
				<option value="<?php echo $row6['prodi_kode']; ?>"><?php echo $row6['prodi_kode']; ?> - <?php echo $row6['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kelas</label>
		<select class="form-control" name="kue_kd_kls" required="">
			<?php foreach ($rows3 as $row3) {?>
				<option value="<?php echo $row3['kls_kode']; ?>"><?php echo $row3['kls_kode']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Matakuliah</label>
		<select class="form-control" name="kue_kd_mk" required="">
			<?php foreach ($rows4 as $row4) {?>
				<option value="<?php echo $row4['mk_kode']; ?>"><?php echo $row4['mk_kd_prodi']; ?> - <?php echo $row4['mk_nama']; ?> (<?php echo $row4['mk_kode']; ?>)</option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Dosen</label>
		<select class="form-control" name="kue_id_dosen" required="">
			<?php foreach ($rows5 as $row5) {?>
				<option value="<?php echo $row5['dosen_id']; ?>"><?php echo $row5['dosen_kd_prodi']; ?> - <?php echo $row5['dosen_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<input type="submit" class="btn btn-primary" name="prcinput" value="SIMPAN">
	<a class="btn btn-danger" href="<?php echo URL; ?>kuesioner_tampil">BATAL</a>
</form>
