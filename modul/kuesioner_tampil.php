<?php 

if(!defined('gosoftware')) { header("location:/"); }

$kue = new Kuesioner();
$rows = $kue->tampil(Fungsi::getSession('user_prodi'));
$thn = $dashb->getTahunAktif();
$prd = $dashb->getProdiFakultas(Fungsi::getSession('user_prodi'));
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Daftar Kuesioner
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>kuesioner_input">Tambah Kuesioner</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

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
          <input type="text" class="form-control" value="<?php echo $prd['FAK']; ?>" placeholder="Semua Fakultas" readonly>
        </div>
        <div class="col">
         <label>Program Studi :</label>
         <input type="text" class="form-control" value="<?php echo $prd['PRD']; ?>" placeholder="Semua Prodi" readonly>
       </div>
     </div>
   </div>
 </div>
</blockquote>

<table class="table table-sm table-bordered" id="dtb">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Prodi</th>
      <th scope="col">Kelas</th>
      <th scope="col">Matakuliah</th>
      <th scope="col">Dosen</th>
      <th scope="col">Aktif</th>
      <th scope="col">Aksi</th>
      <th scope="col">Hasil</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row) { $no++;?>
      <tr>
        <td scope="row"><?php echo $no; ?></td>
        <td scope="row"><?php echo $row['PRD']; ?></td>
        <td scope="row"><?php echo $row['KLS']; ?></td>
        <td scope="row"><?php echo $row['MK']; ?></td>
        <td scope="row"><?php echo $row['DSN']; ?></td>
        <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['kue_aktif']; ?>.png"></td>
        <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>kuesioner_edit/kode/<?php echo $row['kue_id']; ?>">Edit</a></td>
        <td scope="row"><a class="btn btn-success btn-sm" href="<?php echo URL; ?>kuesioner_hasil/kode/<?php echo $row['kue_id']; ?>">Tampilkan</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
