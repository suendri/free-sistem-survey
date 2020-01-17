<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$prodi = Fungsi::getSession('user_prodi');

$kue = new Kuesioner();
$row = $kue->edit($id);

$rows1 = $dashb->getTahunAktif();
$rows7 = $kue->getFakultas($prodi);
$rows3 = $kue->getKelas($prodi);
$rows4 = $kue->getMatakuliah($prodi);
$rows5 = $kue->getDosen($prodi);
$rows6 = $kue->getProdi($prodi);
?>

<h3><i class="fas fa-list-alt"></i> Tambah Kuesioner</h3>

<form method="POST" action="<?php echo URL; ?>kuesioner_proses">
	<input type="hidden" name="kue_id" value="<?php echo $row['kue_id']; ?>">
	<div class="form-group">
		<label>Tahun</label>
		<input type="text" class="form-control" value="<?php echo $row['kue_kd_tahun']; ?>" placeholder="Tahun" readonly>
	</div>
	<div class="form-group">
		<label>Fakultas</label>
		<select class="form-control" name="kue_kd_fak" required="">
			<?php foreach ($rows7 as $row7) {
				$selected = $row['kue_kd_fak'] == $row7['FA'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row7['FA']; ?>"<?php echo $selected; ?>><?php echo $row7['FA']; ?> - <?php echo $row7['FAK']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Prodi</label>
		<select class="form-control" name="kue_kd_prodi" required="">
			<?php foreach ($rows6 as $row6) {
				$selected = $row['kue_kd_prodi'] == $row6['prodi_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row6['prodi_kode']; ?>"<?php echo $selected; ?>><?php echo $row6['prodi_kode']; ?> - <?php echo $row6['prodi_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Kelas</label>
		<select class="form-control" name="kue_kd_kls" required="">
			<?php foreach ($rows3 as $row3) {
				$selected = $row['kue_kd_kls'] == $row3['kls_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row3['kls_kode']; ?>"<?php echo $selected; ?>><?php echo $row3['kls_kode']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Matakuliah</label>
		<select class="form-control" name="kue_kd_mk" required="">
			<?php foreach ($rows4 as $row4) {
				$selected = $row['kue_kd_mk'] == $row4['mk_kode'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row4['mk_kode']; ?>"<?php echo $selected; ?>><?php echo $row4['mk_kode']; ?> - <?php echo $row4['mk_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group">
		<label>Dosen</label>
		<select class="form-control" name="kue_id_dosen" required="">
			<?php foreach ($rows5 as $row5) {
				$selected = $row['kue_id_dosen'] == $row5['dosen_id'] ? ' selected' : NULL;
				?>
				<option value="<?php echo $row5['dosen_id']; ?>"<?php echo $selected; ?>><?php echo $row5['dosen_nama']; ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group form-check">
		<?php $checked = $row['kue_aktif'] == 'Y' ? ' checked' : NULL; ?>
		<input type="checkbox" class="form-check-input" name="kue_aktif" value="Y" <?php echo $checked; ?>>
		<label class="form-check-label">Aktif</label>
	</div>
	<input type="submit" class="btn btn-primary" name="prcupdate" value="UPDATE">
	<a class="btn btn-danger" href="<?php echo URL; ?>kuesioner_tampil">BATAL</a>
</form>
