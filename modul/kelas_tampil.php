<?php 

if(!defined('gosoftware')) { header("location:/"); }

$kls = new Kelas();
$rows = $kls->tampil(Fungsi::getSession('user_prodi'));
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Master Kelas
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>kelas_input">Tambah Kelas</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<table class="table table-sm table-bordered" id="dtb">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Fakultas</th>
    <th scope="col">Prodi</th>
    <th scope="col">Kode</th>
    <th scope="col">Nama</th>
    <th scope="col">Aktif</th>
    <th scope="col">Mahasiswa</th>
    <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($rows as $row) { $no++;?>
    <tr>
      <td scope="row"><?php echo $no; ?></td>
      <td scope="row"><?php echo $row['FAK']; ?></td>
      <td scope="row"><?php echo $row['PRD']; ?></td>
      <td scope="row"><?php echo $row['kls_kode']; ?></td>
      <td scope="row"><?php echo $row['kls_nama']; ?></td>
      <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['kls_aktif']; ?>.png"></td>
      <td scope="row"><a class="btn btn-warning btn-sm" href="<?php echo URL; ?>kelas_mhsw/kode/<?php echo $row['kls_kode']; ?>">Lihat</a></td>
      <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>kelas_edit/kode/<?php echo $row['kls_kode']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
</tbody>
</table>
