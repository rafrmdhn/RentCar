<?php
    session_start();
    include 'database/koneksi.php';
    $vnama = '';
    $vemail = '';
    $vgambar = '';
    $vnik = '';
    $vsim = '';

    if (!isset($_SESSION['email'])) {
        echo "<script>
            alert('Anda harus login terlebih dahulu!');
            document.location='index.php'
            </script>";
    }
    $email = $_SESSION['email'];

    if (($_SESSION['status'])) {

        // Cek kecocokan data pengguna di database
        $view = "SELECT * FROM tbl_pelanggan WHERE email_pelanggan = '$email'";
        $tampil = mysqli_query($conn, $view);
        $data = mysqli_fetch_array($tampil);

            if ($data) {
                $vnama = $data['nama_pelanggan'];
                $vemail = $data['email_pelanggan'];
                $vgambar = $data['gambar_pelanggan'];
                $vnik = $data['nik_ktp'];
                $vsim = $data['no_sim'];
            } else {
                echo "<script>
					alert('Data tidak ditemukan!');
					document.location='index.php';
				</script>";
			    exit;
            }    
        }else {
		echo "<script>
				alert('ID tidak ditemukan!');
				document.location='index.php';
			</script>";
		exit;
	}

    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" />
    <link href="./node_modules/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Rental Mobil Satria</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-logo"><img src="images/logo.png" alt=""></a>

        <div class="navbar-n">
            <a href="index.php#home">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#product">Product</a>
            <a href="index.php#contact">Contact</a>
        </div>

        <div class="dropdown">
        <?php
            session_start();
            include "database/koneksi.php";
            if ($_SESSION['status']) {
                $email = $_SESSION['email'];
                $query = "SELECT * FROM tbl_pelanggan WHERE email_pelanggan = '$email' LIMIT 1";
                $login = mysqli_query($conn, $query);
                while($data = mysqli_fetch_array($login)){
                    echo '<a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="ml-1">' . "Hi, " . $data['nama_pelanggan'] . '
                    </a>';
                    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="edit_profile.php?email=' . $email . '">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="pesanan.php">Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?logout=true">Log out</a></li>
                        </ul>';
                };
            } else {
                echo '<button class="button" id="form-open">Login</button>';
            }
        ?>         
        </div>
    </nav>

    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
          <form action="#" method="POST">
            <h2>Login</h2>

            <div class="input_box">
              <input type="email" placeholder="Enter your email" name="email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" placeholder="Enter your password" password="password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="#" class="forgot_pw">Forgot password?</a>
            </div>

            <button class="button" name="login">Login Now</button>

            <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
          </form>
        </div>

        <!-- Signup From -->
        <div class="form signup_form">
            <form action="#" method="POST">
                <h2>Signup</h2>

                <div class="input_box">
                <input type="email" name="email" placeholder="Enter your email" required />
                <i class="uil uil-envelope-alt email"></i>
                </div>
                <div class="input_box">
                <input type="password" name="password" placeholder="Create password" required />
                <i class="uil uil-lock password"></i>
                <i class="uil uil-eye-slash pw_hide"></i>
                </div>
                <div class="input_box">
                <input type="password" name="confirm_password" placeholder="Confirm password" required />
                <i class="uil uil-lock password"></i>
                <i class="uil uil-eye-slash pw_hide"></i>
                </div>

                <button class="button" type="submit">Signup Now</button>

                <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
            </form>
            </div>
      </div>
    </section>

    <br><br><br>
    <div class="container" data-aos="fade-down">
            <div class="row mt-5">
                <div class="col-12 col-sm-6">
                    <form action="edit_profile.php" method="POST">
                        <div class="card">
                            <div class="text-center">
                                <img class="card-img-top" src="images/<?=$vgambar?>" style="border-radius: 50%; width: 150px; height: 150px;">
                            </div>
                            <div class="card-body">
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Nama Pelanggan :</div>
                                        </div>
                                        <input type="text" name="nama_pelanggan" value="<?=@$vnama?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Email Pelanggan :</div>
                                        </div>
                                        <input type="text" class="form-control" value="<?=@$vemail?>" id="inlineFormInputGroup" name="email">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <input type="file" name="gambar_pelanggan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">NIK KTP :</div>
                                        </div>
                                        <input type="text" name="nik_ktp" class="form-control" value="<?=@$vnik?>" required>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Upload KTP</i></div>
                                        </div>
                                        <input type="file" name="upload_ktp" class="form-control">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">NO SIM A:</div>
                                        </div>
                                        <input type="text" name="no_sim" class="form-control" id="inlineFormInputGroup" value="<?=@$vsim?>" required>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Upload SIM</div>
                                        </div>
                                        <input type="file" name="upload_sim" class="form-control">
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-block mb-2" name="simpan_perubahan">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
<?php
    include 'database/koneksi.php';
    
    if (isset($_POST['simpan_perubahan'])) {
        $nama = $_POST['nama_pelanggan'];
        $email = $_POST['email'];
        $gambar = $_POST['gambar_pelanggan'];
        $nik = $_POST['nik_ktp'];
        $uploadktp = $_POST['upload_ktp'];
        $sim = $_POST['no_sim'];
        $uploadsim = $_POST['upload_sim'];

        $update = "UPDATE tbl_pelanggan SET
                nama_pelanggan = '$nama',
                email_pelanggan = '$email',
                gambar_pelanggan = '$gambar',
                nik_ktp = '$nik',
                upload_ktp = '$uploadktp',   
                no_sim= '$sim',
                upload_sim = '$uploadsim'
                WHERE email_pelanggan = '$email'";
        $result = mysqli_query($conn, $update);

        if ($result) {
            echo "<script>
                alert('Data berhasil diupdate!');
                document.location='index.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Data gagal diupdate!');
            </script>";
        }
    }
?>