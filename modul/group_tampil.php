<?php 

if(!defined('gosoftware')) { header("location:/"); }

$group = new Group();
$rows = $group->tampil();
$no = 0;

?>

<h3><i class="fas fa-folder-open"></i> Master Group
 <div class="float-right">
   <a class="btn btn-primary btn-sm" href="<?php echo URL; ?>group_input">Tambah Group</a>
   <a class="btn btn-success btn-sm" href="<?php echo URL; ?>user_tampil">
    <i class="fas fa-user"></i> User</a>
    <a class="btn btn-success btn-sm" href="<?php echo URL; ?>menu_tampil">
     <i class="fas fa-bars"></i> Menu</a>
   </div>
 </h3>

<?php echo Fungsi::feedback(); Fungsi::feedbackDestroy();?>

 <table class="table table-sm table-bordered" id="dtb">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rows as $row) { $no++;?>
      <tr>
        <td scope="row"><?php echo $no; ?></td>
        <td scope="row"><?php echo $row['group_nama']; ?></td>
        <td scope="row"><a class="btn btn-info btn-sm" href="<?php echo URL; ?>group_edit/kode/<?php echo $row['group_id']; ?>">Edit</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>