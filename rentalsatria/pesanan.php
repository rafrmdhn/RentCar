<?php
    session_start();
    include "database/koneksi.php";
    if (isset($_GET['logout'])) {
            session_destroy();
            header("Location: index.php");
            exit();
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet" />
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
                    echo ' <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color: #000000;"ml-1"">' . "Hi, " . $data['nama_pelanggan'] . '</a>';
                    echo ' <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
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
    <!-- End Navbar -->
    
    <section>
    <br><br><br><br><br><br><br><br>
    <div class="card-header p-0 border-bottom-0 bjir">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" href="#custom-tabs-four-home">Pesanan Saya</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" href="#custom-tabs-four-profile">Diproses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" href="#custom-tabs-four-messages">Lunas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" href="#custom-tabs-four-settings">Selesai</a>
                                </li>
                            </ul>
    </div>
    <!-- Data Pesanan Order -->
    <div class="tab-pane fade show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
        <div class="table table-bordered table-responsive">    
            <table class="table table-bordered">
                <thead>
                    <tr class='text-center'>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Kendaraan</th>
                        <th>Tanggal Rental</th>
                        <th>Tanggal Kembali</th>
                        <th>Harga/Day</th>
                        <th>Berapa Hari</th>
                        <th>Sub Total</th>
                        <th>Status Pembayaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        include "database/koneksi.php";
                        $email = $_SESSION['email'];
                        $sql = "SELECT * ,transaksi.id_pelanggan, transaksi.id_mobil, 
                                tbl_pelanggan.nama_pelanggan, tbl_mobil.nama_kendaraan FROM 
                                transaksi INNER JOIN tbl_pelanggan ON transaksi.id_pelanggan = tbl_pelanggan.id_pelanggan 
                                INNER JOIN tbl_mobil ON transaksi.id_mobil = tbl_mobil.id_mobil 
                                WHERE status_pembayaran = 0 AND tbl_pelanggan.email_pelanggan = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_pelanggan'] . "</td>";
                            echo "<td>" . $row['nama_kendaraan'] . "</td>";
                            echo "<td>" . $row['tanggal_rental'] . "</td>";
                            echo "<td>" . $row['tanggal_kembali'] . "</td>";
                            echo "<td>" . rupiah($row['harga']) . "</td>";
                            echo "<td>" . $row['berapa_hari'] . "</td>";
                            echo "<td>" . rupiah($row['sub_total']) . "</td>";
                            if ($row['status_pembayaran'] == 0) {
                                echo "<td><span class='badge badge-danger'>Belum Bayar</span></td>";
                            }
                            echo "<td><a href='pembayaran.php?id=" . $row['id_transaksi'] . "' class='btn btn-primary'>Bayar</a></td>";
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Data Pesanan di Proses -->
    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
        <div class="table table-bordered table-responsive">    
            <table class="table table-bordered">
                <thead>
                    <tr class='text-center'>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Kendaraan</th>
                        <th>Tanggal Rental</th>
                        <th>Tanggal Kembali</th>
                        <th>Harga/Day</th>
                        <th>Berapa Hari</th>
                        <th>Sub Total</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        include "database/koneksi.php";
                        $email = $_SESSION['email'];
                        $sql = "SELECT * ,transaksi.id_pelanggan, transaksi.id_mobil, 
                                tbl_pelanggan.nama_pelanggan, tbl_mobil.nama_kendaraan FROM 
                                transaksi INNER JOIN tbl_pelanggan ON transaksi.id_pelanggan = tbl_pelanggan.id_pelanggan 
                                INNER JOIN tbl_mobil ON transaksi.id_mobil = tbl_mobil.id_mobil 
                                WHERE status_pembayaran = 1 AND tbl_pelanggan.email_pelanggan = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_pelanggan'] . "</td>";
                            echo "<td>" . $row['nama_kendaraan'] . "</td>";
                            echo "<td>" . $row['tanggal_rental'] . "</td>";
                            echo "<td>" . $row['tanggal_kembali'] . "</td>";
                            echo "<td>" . rupiah($row['harga']) . "</td>";
                            echo "<td>" . $row['berapa_hari'] . "</td>";
                            echo "<td>" . rupiah($row['sub_total']) . "</td>";
                            if ($row['status_pembayaran'] == 1) {
                                echo "<td><span class='badge badge-success'>Diproses</span></td>";
                            }
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Data Pesanan Lunas -->
    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
        <div class="table table-bordered table-responsive">    
            <table class="table table-bordered">
                <thead>
                    <tr class='text-center'>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Kendaraan</th>
                        <th>Tanggal Rental</th>
                        <th>Tanggal Kembali</th>
                        <th>Harga/Day</th>
                        <th>Berapa Hari</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        include "database/koneksi.php";
                        $email = $_SESSION['email'];
                        $sql = "SELECT * ,transaksi.id_pelanggan, transaksi.id_mobil, 
                                tbl_pelanggan.nama_pelanggan, tbl_mobil.nama_kendaraan FROM transaksi 
                                INNER JOIN tbl_pelanggan ON transaksi.id_pelanggan = tbl_pelanggan.id_pelanggan 
                                INNER JOIN tbl_mobil ON transaksi.id_mobil = tbl_mobil.id_mobil 
                                WHERE status_pembayaran = 2 AND tbl_pelanggan.email_pelanggan = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_pelanggan'] . "</td>";
                            echo "<td>" . $row['nama_kendaraan'] . "</td>";
                            echo "<td>" . $row['tanggal_rental'] . "</td>";
                            echo "<td>" . $row['tanggal_kembali'] . "</td>";
                            echo "<td>" . $row['berapa_hari'] . "</td>";
                            echo "<td>" . rupiah($row['sub_total']) . "</td>";
                            if ($row['status_pembayaran'] == 2) {
                                echo "<td><span class='badge badge-success'>Lunas</span></td>";
                            }
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Data Pesanan Selesai -->
    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
        <div class="table table-bordered table-responsive">    
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Kendaraan</th>
                        <th>Tanggal Rental</th>
                        <th>Tanggal Kembali</th>
                        <th>Tanggal Pengembalian Ke Rental</th>
                        <th>Status Pengembalian</th>
                        <th>Total Denda</th>
                        <th>Status Rental</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        include "database/koneksi.php";
                        $email = $_SESSION['email'];
                        $sql = "SELECT * ,transaksi.id_pelanggan, transaksi.id_mobil, 
                                tbl_pelanggan.nama_pelanggan, tbl_mobil.nama_kendaraan FROM transaksi 
                                INNER JOIN tbl_pelanggan ON transaksi.id_pelanggan = tbl_pelanggan.id_pelanggan 
                                INNER JOIN tbl_mobil ON transaksi.id_mobil = tbl_mobil.id_mobil 
                                WHERE status_pembayaran = 3  AND tbl_pelanggan.email_pelanggan = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_pelanggan'] . "</td>";
                            echo "<td>" . $row['nama_kendaraan'] . "</td>";
                            echo "<td>" . $row['tanggal_rental'] . "</td>";
                            echo "<td>" . $row['tanggal_kembali'] . "</td>";
                            echo "<td>" . $row['tanggal_pengembalian'] = date('Y-m-d', strtotime('+'.$row['berapa_hari'].'days', strtotime($row['tanggal_rental']))) . "</td>";
                            if ($row['tanggal_pengembalian']== $row['tanggal_kembali']){
                                $query_stat = "UPDATE transaksi SET status_pengembalian = 1 WHERE id_transaksi = '$row[id_transaksi]'";
                                $update = mysqli_query($conn, $query_stat);
                            }
                            if($row['status_pengembalian'] == 0){
                                echo "<td><span class='badge badge-danger'>Belum Kembali</span></td>";
                            } else {
                                echo "<td><span class='badge badge-success'>Sudah Kembali</span></td>";
                                echo "<td>" . rupiah($row['total_denda']) . "</td>";
                                echo "<td><span class='badge badge-success'>Selesai</span></td>";
                            }
                            
                            if ($row['status_rental'] == 0){
                                echo "<td><span class='badge badge-danger'>Belum Selesai</span></td>";
                            }
                            echo "</tr>";
                            $no++;
                        }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </section>
    <script>
    // Menangkap elemen tombol "Rafi"
    const formOpenButton = document.getElementById('dropdownMenuLink');

    // Menambahkan event listener untuk menghandle klik pada tombol
    formOpenButton.addEventListener('click', function() {
        // Toggle dropdown saat tombol diklik
        const dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.classList.toggle('show');
    });
    const tabs = document.querySelectorAll('.nav-link');
    const tabContents = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Menghapus kelas "active" dari semua tab dan konten tab
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });

            tabContents.forEach(content => {
                content.classList.remove('show');
            });

            // Menambahkan kelas "active" ke tab yang ditekan
            tab.classList.add('active');

            // Menemukan konten tab yang sesuai dengan tab yang ditekan
            const target = tab.getAttribute('href');
            const tabContent = document.querySelector(target);

            // Menambahkan kelas "show" ke konten tab yang sesuai
            tabContent.classList.add('show');
        });
    });
</script>
</body>
</html>