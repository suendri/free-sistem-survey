<?php 

if(!defined('gosoftware')) { header("location:/"); }

$mk = new Matakuliah();
$rows = $mk->tampil(Fungsi::getSession('user_prodi'));
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Daftar Matakuliah
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>matakuliah_input">Tambah Matakuliah</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<table class="table table-sm table-bordered" id="dtb">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Prodi</th>
    <th scope="col">Kode</th>
    <th scope="col">Nama</th>
    <th scope="col">SKS</th>
    <th scope="col">Aktif</th>
    <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($rows as $row) { $no++;?>
    <tr>
      <td scope="row"><?php echo $no; ?></td>
      <td scope="row"><?php echo $row['PRD']; ?></td>
      <td scope="row"><?php echo $row['mk_kode']; ?></td>
      <td scope="row"><?php echo $row['mk_nama']; ?></td>
      <td scope="row"><?php echo $row['mk_sks']; ?></td>
      <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['mk_aktif']; ?>.png"></td>
      <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>matakuliah_edit/kode/<?php echo $row['mk_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
</tbody>
</table>
