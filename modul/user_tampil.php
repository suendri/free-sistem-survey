<?php 

if(!defined('gosoftware')) { header("location:/"); }

$user = new User();
$rows = $user->tampil(Fungsi::getSession('user_prodi'));
$no = 0;

?>
<h3><i class="fas fa-folder-open"></i> Master User
  <div class="float-right">
   <a class="btn btn-primary btn-sm" href="<?php echo URL; ?>user_input">Tambah User</a>
   <a class="btn btn-success btn-sm" href="<?php echo URL; ?>group_tampil">
    <i class="fas fa-user-friends"></i> Group</a>
    <a class="btn btn-success btn-sm" href="<?php echo URL; ?>menu_tampil">
     <i class="fas fa-bars"></i> Menu</a>
   </div>
 </h3>

 <?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

 <table class="table table-sm table-bordered" id="dtb">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Username</th>
      <th scope="col">Group</th>
      <th scope="col">Prodi</th>
      <th scope="col">Aktif</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row) { $no++;?>
      <tr>
        <td scope="row"><?php echo $no; ?></td>
        <td scope="row"><?php echo $row['user_name']; ?></td>
        <td scope="row"><?php echo $row['GR']; ?></td>
        <td scope="row"><?php echo $row['user_kd_prodi']; ?></td>
        <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['user_aktif']; ?>.png"></td>
        <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>user_edit/kode/<?php echo $row['user_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
