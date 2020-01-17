<?php 

if(!defined('gosoftware')) { header("location:/"); }

$kue = new Kuesioner();
$thn = $dashb->getTahunAktif();
$kelas = $dashb->getKuesioner(Fungsi::getSession('user_prodi'), Fungsi::getSession('user_name'));

// Memanggil List Prodi Fakultas Universal
$universal_prodi = $dashb->getProdiFakultas(Fungsi::getSession('user_prodi'));

?>

<h3><i class="fas fa-desktop"></i> Dashboard</h3>

<blockquote>
  <div class="card bg-light">
    <div class="card-body">
      <div class="form-row">
        <div class="col">
          <label>Tahun Aktif :</label>
          <input type="text" class="form-control" value="<?php echo $thn['thn_kode'] . " - " . $thn['thn_nama']; ?>" placeholder="Nama" readonly>
        </div>
        <div class="col">
          <label>Fakultas :</label>
          <input type="text" class="form-control" value="<?php echo $universal_prodi['FAK']; ?>" placeholder="Semua Fakultas" readonly>
        </div>
        <div class="col">
         <label>Program Studi :</label>
         <input type="text" class="form-control" value="<?php echo $universal_prodi['PRD']; ?>" placeholder="Semua Prodi" readonly>
       </div>
     </div>
   </div>
 </div>
</blockquote>

<div class="card">
  <h5 class="card-header">
    Selamat Datang <?php echo Fungsi::getSession('user_group'); ?>, <i><b><?php echo Fungsi::getSession('user_name'); ?></b></i>
    <!--<div class="float-right">
    </div> -->
  </h5>
  <div class="card-body">
    <h5 class="card-title">Berpartisipasi Aktif!</h5>
    <p>Besar harapan kami agar anda ikut berpartisipasi aktif mengisi Kuesioner yang tersedia
      untuk menjamin Mutu Perkuliahan dan Pengawasan Internal Universitas Islam Negeri Sumatera Utara Medan,
    demi mewujudkan UINSU JUARA.</p>
    
    <p><b>Untuk penggunaan pada Smartphone/HP, gunakan mode Landscape agar tampilan lebih sempurna</b></p>

    <?php foreach ($kelas as $kls) { ?>

      <div class="card">
        <h5 class="card-header">
          Kelas : <?php echo $kls['KLS']; ?>
        </h5>
        <div class="card-body">

          <div class="table-responsive">
           <table class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Matakuliah</th>
                <th scope="col">Dosen</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php 

              $rows = $dashb->getKuesionerKelas($kls['KLS']);
              $no = 0; 
              foreach ($rows as $row) { 
                $no++;
                $ada = $kue->cekHasil(Fungsi::getSession('user_name'), $row['kue_id']);
                ?>
                <tr>
                  <td scope="row"><?php echo $no; ?></td>
                  <td scope="row"><?php echo $row['MK']; ?></td>
                  <td scope="row"><?php echo $row['DSN']; ?></td>
                  <td scope="row" class="text-right">
                    <?php if ($ada > 1) { ?>
                      <button class="btn btn-default btn-sm">Terimakasih</button>
                    <?php } else { ?>
                      <a class="btn btn-success btn-sm" href="<?php echo URL; ?>kuesioner_isi/kode/<?php echo Fungsi::encode($row['kue_id']); ?>">
                       <i class="fas fa-check-square"></i> Isi Kuesioner
                     </a>
                   <?php } ?>
                 </td>
               </tr>
             <?php } ?>
           </tbody>
         </table>
       </div>
     </div>
   </div>
   <p></p>
 <?php } ?>

</div>
</div>