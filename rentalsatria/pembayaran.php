<?php 
    session_start();
    include 'database/koneksi.php';
    if (isset($_GET['id'])) {
        $id_transaksi = $_GET['id'];
        $sql = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    function rupiah($angka){
        $format_rupiah = "Rp. " . number_format($angka,2,',','.');
        return $format_rupiah;
    }

    $query_bank = "SELECT * FROM tbl_bank";
    $sqlb = mysqli_query($conn, $query_bank);
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
            <a href="index.php">Home</a>
            <a href="index.php#about">About</a>
            <a href="index.php#product">Product</a>
            <a href="index.php#contact">Contact</a>
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

    <br><br><br><br><br>
        <section class="bayar" id="bayar" data-aos="fade-down">
            <div class="content" data-aos="fade-down">
                <div class="container-fluid">
                    <style type="text/css">
                        .abu {
                            background-color: #e4e4e4;
                        }
                    </style>
                    <div class="row">
                        <div class="col-12 col-md-6 my-2">
                            <div class="card">
                                <div class="card-header" style="background-color: dodgerblue; color: white;">
                                    <h4>Transfer ke no Rekening Rental</h4>
                                </div>
                                <div class="card-body mb-5">
                                        <div class="accordion accordion-flush" id="faqlist1">
                                            <div class="accordion-item">
                                            <?php while($data_bank = mysqli_fetch_array($sqlb)) { ?>
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                                        Nama Bank : <span class="badge badge-secondary"><?=$data_bank['nama_bank']?></span>
                                                    </button>
                                                </h2>
                                                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                                    <div class="accordion-body">
                                                        <p>Nomor Rekening : <?=$data_bank['nomor_rekening']?></p>
                                                        <p>Nama Nasabah : <?=$data_bank['nama_nasabah']?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <hr style="color: dodgerblue;">
                                </div>
                            </div>
                        </div>
                        <div class=" col-12 col-md-6 my-2">
                            <div class="card">
                                <div class="card-header" style="background-color: dodgerblue; color: white;">
                                    <h4>Upload Bukti Pembayaran</h4>
                                </div>
                                <form action="" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                <input type="hidden" name="id_transaksi" value="<?=$row['id_transaksi']; ?>">
                                    <div class="form-group p-1">
                                        <label for="exampleInputEmail1">Sub-Total</label>
                                        <input type="text" class="form-control" readonly placeholder="<?=rupiah($row['sub_total'])?>">
                                    </div>
                                    <div class="form-group p-1">
                                        <label for="exampleInputEmail1">Total Yang Di Bayar</label>
                                        <input type="text" name="total_bayar" class="form-control" placeholder="Rp. 0,-" required>
                                    </div>
                                    <div class="form-group p-1">
                                        <label for="exampleInputEmail1">Atas Nama</label>
                                        <input type="text" name="atas_nama_pelanggan" class="form-control" placeholder="Atas Nama Pelanggan" required>
                                    </div>
                                    <div class="form-group p-1">
                                        <label for="exampleInputEmail1">Nama Bank</label>
                                        <input type="text" name="nama_bank_pelanggan" class="form-control" placeholder="Nama Bank Pelanggan" required>
                                    </div>
                                    <div class="form-group p-1">
                                        <label for="exampleInputEmail1">Nomor Rekening</label>
                                        <input type="text" name="nomor_rekening_pelanggan" class="form-control" placeholder="Nomor Rekening Pelanggan" required>
                                    </div>
                                    <div class="form-group p-1">
                                        <label for="exampleFormControlFile1">Upload Bukti Pembayaran</label><br>
                                        <input type="file" name="bukti_pembayaran" class="form-control-file">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-block" name="bayar_sewa">Bayar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</body>
</html>
<?php
    include "database/koneksi.php"; // Menghubungkan ke database (sesuaikan dengan path file koneksi.php)

    if (isset($_POST['bayar_sewa'])) {
        // Mendapatkan nilai-nilai dari formulir
        $id_transaksi = $_POST['id_transaksi'];
        $totalBayar = $_POST['total_bayar'];
        $atasNama = $_POST['atas_nama_pelanggan'];
        $namaBank = $_POST['nama_bank_pelanggan'];
        $nomorRekening = $_POST['nomor_rekening_pelanggan'];
        $uploadBukti = $_FILES['bukti_pembayaran']['name'];
        $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];
        move_uploaded_file ($file_tmp, "images/".$uploadBukti);
        
        // Query INSERT
        $sql = "UPDATE transaksi SET status_pembayaran = 1, total_bayar = '$totalBayar', 
                atas_nama_pelanggan = '$atasNama', nama_bank_pelanggan = '$namaBank', 
                nomor_rekening_pelanggan = '$nomorRekening', bukti_pembayaran = '$uploadBukti',
                status_pengembalian = 0, status_rental = 0
                WHERE id_transaksi = '$id_transaksi'";

        if (mysqli_query($conn, $sql)) {
            // Data berhasil disimpan
            echo "<script>
            alert ('Pesanan Telah Di Bayar.');
            document.location='pesanan.php';
            </script>";
        } else {
            // Terjadi kesalahan saat menyimpan data
            echo "Error: " . mysqli_error($conn);
        }
    }
?>