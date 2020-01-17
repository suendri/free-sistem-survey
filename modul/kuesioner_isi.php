<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id_kue = Fungsi::decode($url[2]);
$kode_prodi = Fungsi::getSession('user_prodi');
$kue = new Kuesioner();

$rows = $kue->isi($kode_prodi);
$mkdosen = $kue->getMatakuliahDosen($id_kue);
$thn = $dashb->getTahunAktif();
$prd = $dashb->getProdiFakultas($kode_prodi);

?>

<h3><i class="fas fa-folder-open"></i> Kuesioner
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>">Halaman Utama</a>
</h3>

<blockquote>
	<div class="card bg-light">
		<div class="card-body">
			<div class="form-row">
				<div class="col">
					<label>Tahun Aktif :</label>
					<input type="text" class="form-control" value="<?php echo $thn['thn_kode'] . " - " . $thn['thn_nama']; ?>" placeholder="Nama" readonly>
				</div>
				<div class="col">
					<label>Fakultas :</label>
					<input type="text" class="form-control" value="<?php echo $prd['FAK']; ?>" placeholder="Fakultas" readonly>
				</div>
				<div class="col">
					<label>Program Studi :</label>
					<input type="text" class="form-control" value="<?php echo $prd['PRD']; ?>" placeholder="Prodi" readonly>
				</div>
			</div>
		</div>
	</div>
</blockquote>

<div class="card">
	<h5 class="card-header text-center">
		Matakuliah: <i><?php echo $mkdosen['MK']; ?></i><br> Dosen: <i><?php echo $mkdosen['DSN']; ?></i>
	</h5>
	<div class="card-body">
		<p>
			<h5 style="margin-top: -25px;">Petunjuk Pengisian</h5>
			<ol>
				<li>
					Isilah survey ini dengan memilih jawaban yang disediakan, dengan ketentuan nilai:
					<div>Sangat Baik=5;  Baik=4; Cukup=3; Kurang Baik=2 dan Tidak Baik=1.</div>
				</li>
				<li>
					Jawaban yang diberikan dijamin kerahasiaannya, dan tidak berpengaruh terhadap nilai mata kuliah anda. 
				</li>
				<li>Untuk penggunaan pada Smartphone/HP, gunakan mode Landscape agar tampilan lebih sempurna</li>
			</ol>
		</p>

		<?php if (!empty($mkdosen['MK'])) { ?>
			<form method="POST" action="<?php echo URL; ?>kuesioner_proses">

				<input type="hidden" name="hasil_user_mhsw" value="<?php echo Fungsi::getSession('user_name'); ?>">
				<input type="hidden" name="hasil_id_kue" value="<?php echo $id_kue; ?>">
				
				<div class="table-responsive">
					<table class="table table-sm table-bordered">
						<thead class="thead-light">
							<tr class="text-center">
								<th scope="col" rowspan="2">Kode</th>
								<th scope="col" rowspan="2">Pernyataan</th>
								<th colspan="5">Jawaban</th>
							</tr>
							<tr class="text-center">
								<th scope="col">Baik Sekali</th>
								<th scope="col">Baik</th>
								<th scope="col">Cukup</th>
								<th scope="col">Kurang Baik</th>
								<th scope="col">Tidak Baik</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rows as $row) { ?>
								<tr>
									<td scope="row"><?php echo $row['ins_kode']; ?></td>
									<td scope="row"><?php echo $row['ins_pernyataan']; ?></td>
									<?php for ($a=5;$a>=1;$a--) { ?>
										<td class="text-center" scope="row"><input type="radio" name="hasil_nilai[<?php echo $row['ins_id']; ?>]" value="<?php echo $a; ?>" required></td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<input type="submit" class="btn btn-success btn-lg btn-block" name="prchasil" value="KIRIM" onclick="return confirm('Apakah anda yakin mengirim data ini?');">
			</form>
		<?php } ?>
	</div>
</div>
