<?php
session_start();
include 'koneksi.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Politeknik Negeri Padang</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/logopnp.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="index.php" class="text-nowrap logo-img">
            <img src="assets/images/logos/pnpl.jpg" width="215" height="55" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MENU</span>
            </li>

          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="ms-auto align-items-center justify-content-end">
            <?php
            if (isset($_SESSION['login'])) {
              echo '
              <li class="sidebar-item dropdown">
                <a class="sidebar-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <span>
                    <i class="ti ti-books"></i>
                  </span>
                <span class="hide-menu">Books</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="index.php?page=booklist" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-book-2 fs-6"></i>
                      <p class="mb-0 fs-3">List Buku</p>
                    </a>
                    <a href="?page=input&aksi=kategori" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-category-2 fs-6"></i>
                      <p class="mb-0 fs-3">Kategori Buku</p>
                    </a>
                    <a href="?page=input&aksi=pengarang" class="d-flex align-items-center gap-2 dropdown-item">
                    <i class="ti ti-notebook fs-6"></i>
                    <p class="mb-0 fs-3">Pengarang Buku</p>
                  </a>
                  <a href="?page=input&aksi=penerbit" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-building-community fs-6"></i>
                  <p class="mb-0 fs-3">Penerbit Buku</p>
                </a>
                  </div>
                </div>
              </li>
              ';
            }else{
              echo'</ul>
              </div>
                
                <li class="sidebar-item">
                  <a class="sidebar-link" href="index.php?page=booklist" aria-expanded="false">
                    <span>
                      <i class="ti ti-books"></i>
                    </span>
                    <span class="hide-menu">Books</span>
                  </a>
                </li>';
            }
            
            ?>
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="?page=input&aksi=kategori" aria-expanded="false">
                <span>
                  <i class="ti ti-category"></i>
                </span>
                <span class="hide-menu">Input Kategori</span>
              </a>
            </li> -->

            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="?page=input&aksi=prodi" aria-expanded="false">
                <span>
                  <i class="ti ti-school"></i>
                </span>
                <span class="hide-menu">Input Prodi</span>
              </a>
            </li>

            <?php
            if (isset($_SESSION['login'])) {
              echo '<li class="sidebar-item">
              <a class="sidebar-link" href="index.php?page=membership" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>
                </span>
                <span class="hide-menu">Member</span>
              </a>
            </li>';
            }
            ?> -->
<?php
                   if (isset($_SESSION['login'])) {
                    echo '
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="ms-auto align-items-center justify-content-end">
              <li class="sidebar-item dropdown">
                <a class="sidebar-link " href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <span>
                    <i class="ti ti-user-circle"></i>
                  </span>
                <span class="hide-menu">Member</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                  <a href="index.php?page=membership" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-users fs-6"></i>
                      <p class="mb-0 fs-3">Membership</p>
                    </a>
                    <a href="?page=input&aksi=prodi" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-school fs-6"></i>
                      <p class="mb-0 fs-3">Program Studi</p>
                    </a>
                  </div>
                </div>
              </li>
            </ul>
          </div>';
        }?>

            <?php
            if (isset($_SESSION['login'])) {
              echo '<li class="sidebar-item">
              <a class="sidebar-link" href="index.php?page=loans" aria-expanded="false">
                <span>
                  <i class="ti ti-license"></i>
                </span>
                <span class="hide-menu">Loans</span>
              </a>
            </li>';
            } ?>

            <li class="sidebar-item">
              <a class="sidebar-link" href="index.php?page=information" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-triangle"></i>
                </span>
                <span class="hide-menu">Information</span>
              </a>
            </li>

            
            <!---<li class="sidebar-item">
              <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Form Membership</span>
              </a>
            </li>--->
            <?php
            if (!isset($_SESSION['login'])) {
              echo '<li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="visit.php" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Visit</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="login.php" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>';
            }
            ?>

          </ul>
          <!----<div class="unlimited-access hide-menu backgrounds position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <img src="assets/images/backgrounds/vbook.png" alt="" class="img-fluid">
            </div>
          </div>---->
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
              </a>
            </li>
          </ul>
          <!--Search-->
          <form class="form-outline" method="POST" action="proses_search.php">
            <input type="search" name="query" class="form-control" placeholder="Search" aria-label="Search">
          </form>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <?php
              if (isset($_SESSION['login'])) {
                $result = $db->query("SELECT * FROM user WHERE email = '$_SESSION[email]'");
                $row = $result->fetch_assoc();
                echo '<a class="btn btn-primary">' . $row['nama'] . '</a>';
                echo '<li class="nav-item dropdown">
                        <!-- Konten dropdown -->
                      </li>';
              } else {
                echo '<a class="btn btn-primary">Visitor</a>';
              }
              ?>

              <?php
              if (isset($_SESSION['login'])) {
                $result = $db->query("SELECT * FROM user WHERE email = '$_SESSION[email]'");
                $row = $result->fetch_assoc();
                echo '<li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/' . $row['photo']. '" alt="" width="35" height="35" class="rounded-circle">
                </a>';
              } else {
                echo '<li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>';
              }
              ?>

              <?php
              if (isset($_SESSION['login'])) {
                echo '<div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="?page=user&aksi=profile" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="?page=user&aksi=input" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user-plus fs-6"></i>
                      <p class="mb-0 fs-3">Add Admin</p>
                    </a>
                    

                    <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
          </div>';
              }
              ?>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <?php
      $p = isset($_GET['page']) ? $_GET['page'] : 'home'; //ternary 
      if ($p == 'home')
        include 'dashboard.php';
      if ($p == 'booklist')
        include 'booklist.php';
      if ($p == 'information')
        include 'information.php';
      if ($p == 'librarian')
        include 'librarian.php';
      if ($p == 'membership')
        include 'membership.php';
      if ($p == 'loans')
        include 'list_loans.php';
      if ($p == 'detail_loans')
        include 'loans.php';
      if ($p == 'input')
        include 'input.php';
      if ($p == 'user')
        include 'user.php';
      ?>
      <script src="assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="assets/js/sidebarmenu.js"></script>
      <script src="assets/js/app.min.js"></script>
      <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="assets/js/dashboard.js"></script>
      <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
      new DataTable('#example');
    </script>
</body>

</html>