<?php
    session_start();
    include 'database/koneksi.php';
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

            // Cek kecocokan data pengguna di database
        $sql = "SELECT * FROM tbl_pelanggan WHERE email_pelanggan = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($result);

        if (mysqli_num_rows($result) > 0) {

            // Login berhasil, lakukan tindakan sesuai kebutuhan
            $_SESSION['email'] = $email;
            $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
            $_SESSION['status'] = true; // Simpan nama pengguna dalam sesi
            echo "<script>
                alert('Login berhasil!')
                window.location.href = 'index.php';
            </script>";
            exit();
        } else {
            // Login gagal, tampilkan pesan kesalahan
            echo "<script>
            alert('Login gagal!')
            document.location='index.php'
            </script>";
        }
    }

    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    $query = "SELECT * FROM tbl_mobil";
    $hasil = mysqli_query($conn, $query);

    function rupiah($angka){
        $format_rupiah = "Rp. " . number_format($angka,2,',','.');
        return $format_rupiah;
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="kontoller" href="script.js">
    <title>Rental Mobil Satria</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#" class="navbar-logo"><img src="images/logo.png" alt=""></a>

        <div class="navbar-n">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#product">Product</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="dropdown mr-3">
        <?php
            session_start();
            include "database/koneksi.php";
            if ($_SESSION['status']) {
                $email = $_SESSION['email'];
                $query = "SELECT * FROM tbl_pelanggan WHERE email_pelanggan = '$email' LIMIT 1";
                $login = mysqli_query($conn, $query);
                while($data = mysqli_fetch_array($login)){
                    echo '<a class="nav-link dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="ml-1">' . "Hi, " . $data['nama_pelanggan'] . '
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

    <!-- Home -->
    <section class="hero" id="home">
        <main class="content">
            <span class="welcome">Selamat Datang di</span>
            <span class="title">Rental Mobil Satria</span>
        </main>
    </section>

    <!-- Product -->
    <section class="product-container" id="product">
        <div class="location">
            <span class="location-text">Lokasi anda sekarang?</span>
            <div class="location-input">
                <input type="text" class="form-control w-25" placeholder="Masukkan lokasi anda">
                <button class="btn btn-primary">Cari</button>
        </div>
        <div class="pilihan">
            <span class="pilihan-text">Pilihan Mobil</span>
        </div>
        <?php
            while ($data = mysqli_fetch_array($hasil)) {?>
        <div class="card" style="width: 25rem; margin-top: 160px;margin-left:80px;" onclick="goToNextPage(<?=$data['id_mobil']?>)">
            <img src="images/<?=$data['gambar']?>" class="card-img-top" alt="">
            <div class="card-body">
                <h5 class="card-title"><?=$data['nama_kendaraan']?></h5>
                <p>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <p class="card-text"><b><?=rupiah($data['harga'])?></b></p>
                </p>
            </div>
        </div>
        <?php } ?>
    </section>

    <!-- About -->
    <section class="about" id="about">
        <div class="about-bg">
            <div class="background"></div>
            <span class="titler">Satria Rent Car</span>
            <span class="desc">Layanan aplikasi ini dibuat karena kebutuhan konsumen di berbagai
            daerah akan keperluan kendaraan untuk berpergian terutama masa libur,
            dimana banyak orang membutuhkan alat transportasi dalam waktu dekat
            dan tempo penggunaan yang singkat</span>
        </div>
        <a class="order" name="order" href="#product">Order Now</a>
    </section>  

    <!-- FaQ -->
    <section class="faq">
        <span class="faq-head">Mengapa Satria Rent Car?</span>
        <div class="v940_2566">
          <div class="v940_2567">
            <div class="v940_2568"></div>
            <div class="v940_2569">
              <div class="v940_2570"></div>
              <span class="v940_2571">Terpercaya</span
              ><span class="v940_2572"
                >Tidak perlu diragukan menggunakan layanan kami, karena lebih
                dari 10.000 user telah menggunakan Rental Mobil Satria</span
              >
            </div>
          </div>
          <div class="v940_2573">
            <div class="v940_2574"></div>
            <div class="v940_2575">
              <div class="v940_2576"></div>
              <span class="v940_2577">Pelayanan Cepat</span
              ><span class="v940_2578"
                >Pengiriman ke lokasi konsumen dengan cepat dan admin yang siap
                siaga menangani pelayanan</span
              >
            </div>
          </div>
          <div class="v940_2579">
            <div class="v940_2580"></div>
            <div class="v940_2581">
              <div class="v940_2582"></div>
              <span class="v940_2583">Mudah & Terbaik</span
              ><span class="v940_2584"
                >Banyak user telah memberikan banyak respon positif karena
                mudahnya menggunakan layanan ini</span
              >
            </div>
          </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="contact" id="contact">
        <div class="contact-bg">
            <div class="tentang">
                <a class="tentang-kontak" href="">Kontak Media</a>
                <a class="tentang-kami" href="">Tentang Kami</a>
                <a class="tentang-order" href="">Order</a>
                <p class="tentang-title">Satria Rent Car</p>
            </div>
        </div>
        <div class="sosial">
            <p class="sosial-teks">Ikuti Kami</p>
            <div class="instagram">
                <p class="teks">Instagram</p>
                <img src="images/Instagram.png" alt="">
            </div>
            <div class="whatsapp">
                <p class="teks">WhatsApp</p>
                <img src="images/WhatsApp.png" alt="">
            </div>
            <div class="facebook">
                <p class="teks"><a href="">Facebook</a></p>
                <img src="images/Facebook.png" alt="">
            </div>
            <div class="twitter">
                <p class="teks">Twitter</p>
                <img src="images/Twitter.png" alt="">
            </div>
        </div>
        <div class="metode">
            <div class="pembayaran">
                <p>Metode Pembayaran</p>
            </div>
            <div class="pengiriman">    
                <p>Metode Pengiriman</p>
                <div class="jnt"></div>
                <div class="sicepat"></div>
            </div>
        </div>
        <p>Copyright © BeTe Corp All Right Reserved</p>
    </section>

    
    <script src="script.js">
    function goToNextPage(id_mobil) {
        window.location.href = "detail_mobil.php?id=" + id_mobil;
    }
    </script>

</body>
</html>
<?php
    include 'database/koneksi.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password != $confirmPassword) {
                echo  "<script>
                alert('Password tidak sama!');
                document.location='index.php';
                </script>";
                header("Location:index.php");
                exit();
            }

            $sql = "INSERT INTO tbl_pelanggan(id_pelanggan, nama_pelanggan, email_pelanggan, password, gambar_pelanggan, nik_ktp, upload_ktp, no_sim, upload_sim) VALUES (NULL, NULL,'$email','$password', NULL, NULL, NULL,NULL,NULL)";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                alert('Pendaftaran berhasil!')
                document.location='index.php';
                </script>";
            } else {
                echo "<script>
                alert('Pendaftaran gagal!')
                document.location='index.php';
                </script>";
            }
        }
    header("location:index.php");
?>