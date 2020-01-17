<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$prodi = Fungsi::getSession('user_prodi');

$kue = new Kuesioner();
$rows = $kue->tampilHasil($id);
$detail = $kue->detailHasil($id);

?>

<h3><i class="fas fa-folder-open"></i> Hasil Kuesioner
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>kuesioner_tampil">Kembali</a>
</h3>

<blockquote>
  <div class="card bg-light">
    <div class="card-body">
      <div class="form-row">
        <div class="col">
          <label>Kelas :</label>
          <input type="text" class="form-control" value="<?php echo $detail['KLS']; ?>" placeholder="Nama" readonly>
        </div>
        <div class="col">
          <label>Matakuliah :</label>
          <input type="text" class="form-control" value="<?php echo $detail['MK']; ?>" placeholder="Semua Fakultas" readonly>
        </div>
        <div class="col">
         <label>Dosen :</label>
         <input type="text" class="form-control" value="<?php echo $detail['DSN']; ?>" placeholder="Semua Prodi" readonly>
       </div>
     </div>
   </div>
 </div>
</blockquote>

<table class="table table-sm table-bordered">
	<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Kode</th>
			<th scope="col">Pernyataan</th>
			<th scope="col">Responden</th>
			<th scope="col">Nilai</th>
			<th scope="col">Rata-rata</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=0; 
		$total = 0;
		foreach ($rows as $row) { 
			$no++;    		
			?>
			<tr>
				<td scope="row"><?php echo $no; ?></td>
				<td scope="row"><?php echo $row['KD']; ?></td>
				<td scope="row"><?php echo $row['IP']; ?></td>
				<td scope="row"><?php echo $row['JM']; ?></td>
				<td scope="row"><?php echo $row['NL']; ?></td>
				<td scope="row"><?php echo $rt = $row['NL'] / $row['JM']; ?></td>
			</tr>
			<?php $total = $total + $row['NL']; } ?>
		</tbody>
	</table>

	<p>Total Nilai Keseluruhan : <?php echo $total; ?></p>