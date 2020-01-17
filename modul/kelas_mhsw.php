<?php 

if(!defined('gosoftware')) { header("location:/"); }

$id = $url[2];
$kls = new Kelas();
$rows = $kls->klsMhsw($id);
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Peserta Kelas : <?php echo $id; ?>
<div class="float-right">
 <a class="btn btn-primary btn-sm" href="<?php echo URL; ?>kelas_imhsw/kode/<?php echo $id; ?>">Tambah Peserta</a>
 <a class="btn btn-danger btn-sm" href="<?php echo URL; ?>kelas_tampil">
  <i class="fas fa-bars"></i> Kelas</a>
</div>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<table class="table table-sm table-bordered" id="dtb">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIM</th>
      <th scope="col">Nama</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row) { $no++;?>
      <tr>
        <td scope="row"><?php echo $no; ?></td>
        <td scope="row"><?php echo $row['km_user']; ?></td>
        <td scope="row"><?php echo $row['NM']; ?></td>
        <td scope="row"><a class="btn btn-danger btn-sm" href="<?php echo URL; ?>kelas_hmhsw/kode/<?php echo $id; ?>/<?php echo $row['km_id']; ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">Hapus</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>