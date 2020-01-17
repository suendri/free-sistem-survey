<?php 

if(!defined('gosoftware')) { header("location:/"); }

$menu = new Menu();
$rows = $menu->tampil();
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Master Menu
	<div class="float-right">
   <a class="btn btn-primary btn-sm" href="<?php echo URL; ?>menu_input">Tambah Menu</a>
   <a class="btn btn-success btn-sm" href="<?php echo URL; ?>user_tampil">
    <i class="fas fa-user"></i> User</a>
    <a class="btn btn-success btn-sm" href="<?php echo URL; ?>group_tampil">
     <i class="fas fa-user-friends"></i> Group</a>
   </div>
 </h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

 <table class="table table-sm table-bordered" id="dtb">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Parent</th>
      <th scope="col">Nama</th>
      <th scope="col">Link</th>
      <th scope="col">Privilage</th>
      <th scope="col">Aktif</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row) { $no++;?>
      <tr>
        <td scope="row"><?php echo $no; ?></td>
        <td scope="row"><?php echo $row['menu_parent']; ?></td>
        <td scope="row"><?php echo $row['menu_nama']; ?></td>
        <td scope="row"><?php echo $row['menu_link']; ?></td>
        <td scope="row"><?php echo $row['menu_privilage']; ?></td>
        <td scope="row"><img src="<?php echo URL; ?>asset/images/<?php echo $row['menu_aktif']; ?>.png"></td>
        <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>menu_edit/kode/<?php echo $row['menu_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>