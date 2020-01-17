<?php 

if(!defined('gosoftware')) { header("location:/"); }

$mhsw = new Mahasiswa();
$rows = $mhsw->tampil(Fungsi::getSession('user_prodi'));
$no = 0;

?>
<h3><i class="fas fa-folder-open"></i> Daftar Mahasiswa
	<a class="btn btn-primary btn-sm float-right" href="<?php echo URL; ?>mahasiswa_input">Tambah Mahasiswa</a>
</h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

<div class="alert alert-info" role="alert">
	Mahasiswa yang telah di-export ke menu <b>Kelas</b>, tidak ditampilkan
	dalam daftar ini. Kosma berbeda kelas bisa menambahkan mahasiswa
	yang sama ke kelas lain hanya dengan menambahkan NIM-nya saja ke dalam
	menu <b>Kelas</b>, jika mahasiswa tersebut melakukan pengambilan ke 
	semester atas atau ke semester bawah.
</div>

<table class="table table-sm table-bordered" id="dtb">
<thead>
  <tr>
    <th scope="col">No</th>
    <th scope="col">Prodi</th>
    <th scope="col">NIM</th>
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
      <td scope="row"><?php echo $row['mhsw_nim']; ?></td>
      <td scope="row"><?php echo $row['mhsw_nama']; ?></td>
      <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['mhsw_aktif']; ?>.png"></td>
      <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>mahasiswa_edit/kode/<?php echo $row['mhsw_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
</tbody>
</table>
