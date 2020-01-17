<!doctype html>
<html lang="en">
<head>
  <title><?php echo JUDUL; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Informasi Kuesioner">
  <meta name="author" content="Suendri">

  <link rel="shortcut icon"href="<?php echo URL; ?>asset/images/favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo URL; ?>asset/css/style.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#dtb').DataTable();
    } );
  </script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="<?php echo URL; ?>">SIKUE</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

          <?php 

          foreach ($dashb->getMenu() as $menu) { 
            // Menampilkan Menu sesuai Privilage
            if (strpos($menu['menu_privilage'], Fungsi::getSession('user_level')) !== false) { ?>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL . $menu['menu_link']; ?>"><i class="fas fa-folder"></i> <?php echo $menu['menu_nama']; ?></a>
              </li>

            <?php } } ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URL; ?>logout"><i class="fas fa-lock"></i> Logout</a>
            </li>
          </ul>
        </div>
        
      </nav>
    </header>

    <main role="main" class="container">

      <?php 

      if (!isset($_GET['hal'])) {
        include "modul/main.php";
      } else {
        $url = explode('/', filter_var(rtrim($_GET['hal'], '/'), FILTER_SANITIZE_URL));

        if (file_exists("modul/" . $url[0] . ".php") AND ($dashb->getPrivilage($url[0]) == true)) {
          include "modul/" . $url[0] . ".php";
        } else {
          include "modul/error.php";
        }
      }

      ?>

    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted"> Sistem Informasi Kuesioner - SIKUE Beta3 &copy; 2018      
          - <a href="<?php echo URL; ?>sistem_about">About</a> 
          - <a href="<?php echo URL; ?>sistem_kredit">Credits</a>
        </span>
      </div>
    </footer>

  </body>
  </html>