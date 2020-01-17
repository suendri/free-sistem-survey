<?php 

if(!defined('gosoftware')) { header("location:/"); }

$fak = new Fakultas();
$rows = $fak->tampil();
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Master Fakultas
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>fakultas_input">Tambah Fakultas</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<table class="table table-sm table-bordered" id="dtb">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Kode</th>
    <th scope="col">Nama</th>
    <th scope="col">Aktif</th>
    <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($rows as $row) { $no++;?>
    <tr>
      <td scope="row"><?php echo $no; ?></td>
      <td scope="row"><?php echo $row['fak_kode']; ?></td>
      <td scope="row"><?php echo $row['fak_nama']; ?></td>
      <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['fak_aktif']; ?>.png"></td>
      <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>fakultas_edit/kode/<?php echo $row['fak_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
</tbody>
</table>
