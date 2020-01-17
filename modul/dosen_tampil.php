<?php 

if(!defined('gosoftware')) { header("location:/"); }

$dsn = new Dosen();
$rows = $dsn->tampil(Fungsi::getSession('user_prodi'));
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Daftar Dosen
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>dosen_input">Tambah Dosen</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<table class="table table-sm table-bordered" id="dtb">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Prodi</th>
    <th scope="col">NIP</th>
    <th scope="col">Nama</th>
    <th scope="col">Aktif</th>
    <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($rows as $row) { $no++;?>
    <tr>
      <td scope="row"><?php echo $no; ?></td>
      <td scope="row"><?php echo $row['PRD']; ?></td>
      <td scope="row"><?php echo $row['dosen_nip']; ?></td>
      <td scope="row"><?php echo $row['dosen_nama']; ?></td>
      <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['dosen_aktif']; ?>.png"></td>
      <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>dosen_edit/kode/<?php echo $row['dosen_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
</tbody>
</table>
