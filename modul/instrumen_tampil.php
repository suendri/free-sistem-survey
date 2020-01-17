<?php 

if(!defined('gosoftware')) { header("location:/"); }

$ins = new Instrumen();
$rows = $ins->tampil(Fungsi::getSession('user_prodi'));
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Daftar Instrumen
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>instrumen_input">Tambah Instrumen</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<table class="table table-sm table-bordered" id="dtb">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Prodi</th>
	<th scope="col">Kode</th>
    <th scope="col">Pernyataan</th>
    <th scope="col">Aktif</th>
    <th scope="col">Aksi</th>
    </tr>
</thead>
<tbody>
  <?php foreach ($rows as $row) { $no++;?>
    <tr>
      <td scope="row"><?php echo $no; ?></td>
      <td scope="row"><?php echo $row['PRD']; ?></td>
	  <td scope="row"><?php echo $row['ins_kode']; ?></td>
      <td scope="row"><?php echo $row['ins_pernyataan']; ?></td>
      <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['ins_aktif']; ?>.png"></td>
      <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>instrumen_edit/kode/<?php echo $row['ins_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
</tbody>
</table>
