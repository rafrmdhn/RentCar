<?php
    session_start();
    include "database/koneksi.php";
    if (!isset($_SESSION['email'])) {
        echo "<script>
            alert('Anda harus login terlebih dahulu!');
            document.location='login_admin.php'
            </script>";
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: login_admin.php");
        exit();
    }

    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $query = "SELECT * FROM tbl_user WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_array($result);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Rental Mobil Satria</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="./css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <!-- Navbar Brand-->
        <a class="navbar-brand" href="admin.php"><img src="images/logo.png" alt="" style="width:225px;height:40px;"></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Edit Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="login_admin.php?logout=true">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg></div>
                            User
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="edit_profile_admin.php">Edit Profile</a>
                                <a class="nav-link" href="ganti_password_admin.php">Ganti Password</a>
                                <a class="nav-link" href="data_user.php">All Data User</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                            </svg></div>
                            Master Mobil
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="type_mobil.php">Type Mobil</a>
                                <a class="nav-link collapsed" href="data_mobil.php">Data Produk</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                                <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                            </svg></div>
                            Transaksi
                        </a>
                        <a class="nav-link" href="bank.php">
                            <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z"/>
                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z"/>
                            </svg></div>
                            Bank
                        </a>
                        <a class="nav-link" href="pelanggan.php">
                            <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            </svg></div>
                            Pelanggan
                        </a>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?=$data['nama']?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
        <main>

        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Home / Pages / User / Edit Profile</li>
            </ol>
            <!-- End Page Title -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="images/<?=$data['photo_user']?>" width="150px" height="150px" style="border-radius: 50%;" class="img-fluid rounded-start" alt="...">
                                    <div class="card-footer my-1">
                                        <p><b><?=$data['nama']?></b></p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title" ><?=$data['email']?></h5>
                                        <?php if ($data['status_user'] == 1) { ?>
                                            <p class="card-text" >Status Anda : <span class="badge bg-primary">Aktif</span></p>
                                        <?php } else { ?>
                                            <p class="card-text" >Status Anda : <span class="badge bg-danger">Tidak Aktif</span></p>
                                        <?php } ?>
                                        <p class="card-text" >Level Anda : <span class="badge bg-primary">Admin</span></p>

                                        <div class="d-grid gap-2 mt-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                                Edit Profile
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="editProfileModalLabel">Edit User Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </button>
                        </div>

                        <div class="modal-body">
                            <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="fa-sharp fa-light fa-envelope"></i></span>
                                <input type="hidden" name="id_user" class="form-control" placeholder="id_user Anda" value="<?=$data['id_user']?>">
                                <input type="email" name="email" class="form-control" placeholder="Email Anda" value="<?=$data['email']?>">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="fa-sharp fa-light fa-user"></i></span>
                                <input type="text" name="nama_user" class="form-control" placeholder="Nama Anda" value="<?=$data['nama']?>" required="">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary text-white" id="basic-addon1"><i class="fa-sharp fa-light fa-file"></i></span>
                                <input type="file" name="photo_user" class="form-control" id="preview_gambar" placeholder="Pilih Foto Profile Anda">
                            </div>
                            <div class="col-md-4">
                                <img src="images/<?=$data['photo_user']?>" width="150px" height="150px" style="border-radius: 50%;" class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="edit">Edit</button>
                            </div>
                        </form>
                    </div>    
                    </div>
                </div>
            </div><!-- End Disabled Backdrop Modal-->

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; BeTe Corp 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
            crossorigin="anonymous"></script>
</body>
</html>
<?php
    if(isset($_POST['edit'])) {
        $id_user = $_POST['id_user'];
        $nama_user = $_POST['nama_user'];
        $email = $_POST['email'];
        $foto = $_FILES['photo_user']['name'];
        $tmp = $_FILES['photo_user']['tmp_name'];

        $query = "UPDATE tbl_user SET nama = '$nama_user', email = '$email', photo_user='$foto' WHERE id_user=$id_user";
        $result = mysqli_query($conn, $query);

        if($result) {
            echo "<script>
                    alert('Data berhasil diupdate.');
                    window.location.href = 'edit_profile_admin.php';
                </script>";
            exit;
        } else {
            echo "<script>
                    alert('Data gagal diupdate.');
                    window.location.href = 'edit_profile_admin.php';
                </script>";
            exit;
        }
    }
?>