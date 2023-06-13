<?php
include 'database/koneksi.php';
session_start();
if (isset($_GET['id'])) {
    $query = "SELECT * FROM tbl_mobil WHERE id_mobil = '$_GET[id]'";
    $hasil = mysqli_query($conn, $query);
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

function rupiah($angka)
{
    $format_rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $format_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Atkinson+Hyperlegible&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" />
    <link href="./node_modules/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
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
                while ($data = mysqli_fetch_array($login)) {
                    echo '<a class="nav-link dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="ml-1">' . "Hi, " . $data['nama_pelanggan'] . '
                    </a>';
                    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="edit_profile.php?email=' . $email . '">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="pesanan.php">Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?logout=true">Log out</a></li>
                        </ul>';
                }
                ;
            } else {
                echo '<button class="button" id="form-open">Login</button>';
            }
            ?>
        </div>
    </nav>

    <section class="car">
        <main class="content">
            <?php
            while ($data = mysqli_fetch_array($hasil)) { ?>
                <img class="mobil" src="images/<?= $data['gambar'] ?>" alt="">
                <div class="carsize">
                    <h4 class="nama-mobil">
                        <?= $data['nama_kendaraan'] ?>
                    </h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <?= $data['tahun'] ?>
                                </th>
                                <td>
                                    <?= rupiah($data['harga']) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-info mt-5" type="button" data-toggle="modal"
                            data-target="#pesanSekarang">Pesan Sekarang</button>
                    </div>
                </div>
            </main>
        </section>

        <section>
            <div class="modal fade" id="pesanSekarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-modal="true" style="margin-top:70px;display: none;align-item:center;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Silahkan Isi Pesananan Anda</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="uil uil-times form_close"></i>
                            </button>
                        </div>

                        <form action="" method="post" accept-charset="utf-8">
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="input-group has-validation">
                                        <input type="hidden" name="id_pelanggan" class="form-control" id="yourUsername"
                                            value="<?= $_SESSION['id_pelanggan'] ?>">
                                        <input type="hidden" name="id_mobil" class="form-control" id="yourUsername"
                                            value="<?= @$data['id_mobil'] ?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Tanggal Rental</label>
                                    <div class="input-group has-validation">
                                        <input type="date" name="tanggal_rental" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Tanggal Kembali</label>
                                    <div class="input-group has-validation">
                                        <input type="date" name="tanggal_kembali" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Harga Sewa/Hari</label>
                                    <div class="input-group has-validation">
                                        <input type="text" name="harga" class="form-control" value="<?= $data['harga'] ?>"
                                            readonly="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Sewa Berapa Hari</label>
                                    <div class="input-group has-validation">
                                        <input type="number" name="berapa_hari" class="form-control" required="">
                                        <input type="hidden" name="status_pembayaran" class="form-control" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info" name="pesan">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const pesanButton = document.querySelector(".btn-info");
            const modalElement = document.querySelector(pesanButton.getAttribute("data-target"));

            pesanButton.addEventListener("click", function () {
                modalElement.classList.add("show");
                modalElement.style.display = "block";
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            const closeButton = document.querySelector(".modal [data-dismiss='modal']");
            const modalElement = document.querySelector("#pesanSekarang");

            closeButton.addEventListener("click", function () {
                modalElement.classList.remove("show");
                modalElement.style.display = "none";
            });
        });
    </script>

</body>

</html>
<?php
include('database/koneksi.php');
var_dump($_POST['pesan']);
if (isset($_POST['pesan'])) {
    $id_pelanggan = $_SESSION['id_pelanggan'];
    $id_mobil = $_POST['id_mobil'];
    $tanggal_rental = $_POST['tanggal_rental'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $harga = $_POST['harga'];
    $berapa_hari = $_POST['berapa_hari'];
    $sub_total = $harga * $berapa_hari;
    $tanggal_pengembalian = date('Y-m-d', strtotime('+' . $_POST['berapa_hari'] . 'days', strtotime($_POST['tanggal_rental'])));

    $sql = "INSERT INTO transaksi (id_pelanggan, id_mobil, tanggal_rental, tanggal_kembali, harga, berapa_hari, sub_total, status_pembayaran, total_bayar, bukti_pembayaran, tanggal_pengembalian, status_pengembalian, status_rental) VALUES ($id_pelanggan, $id_mobil, '$tanggal_rental', '$tanggal_kembali', '$harga', '$berapa_hari', '$sub_total', 0, NULL, NULL, '$tanggal_pengembalian', NULL, NULL)";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil > 0) {
        echo "<script>
        alert ('Pesanan telah ditambah');
        document.location='pesanan.php?id='+$id_mobil;</script>";
    } else {
        echo "<script>
        aler ('Gagal');
        </script>";
    }
}
?>