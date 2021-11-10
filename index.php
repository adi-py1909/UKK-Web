<?php

require('koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
  header('Location: login.php');
}

include('template/header.php');
include('template/navbar.php');
?>
<div class="container">
    <h4 class="header-text">Daftar Siswa</h4>
    <table class="table table-striped table-hover">
        <thead style="background-color: #7ed6df; color: white;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Nomer Hp</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($con, "SELECT * FROM siswa");
            while ($dt = mysqli_fetch_array($sql)) { ?>
                <tr>
                    <td><?= $no++?></td>
                    <td><?= $dt['nama']?></td>
                    <td><?= $dt['username']?></td>
                    <td><?= $dt['email']?></td>
                    <td><?= $dt['alamat']?></td>
                    <td><?= $dt['no_hp']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('template/footer.php')?>

<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">

    <title>Daftar User</title>
</head>

<body>
    <div class="vertical-center">
        <div class="container m-auto">
            <div class="card" style="border-radius: 20px;">
                <div class="img-cover-fit"></div>
                <div class="card-body">
                    <div style="display: flex;justify-content:space-between">
                        <div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>User Info</h4>
                                </div>
                                <div class="card-body">
                                    <div style="display: flex">
                                        <h6 style="color:#7ed6df">Username</h6>
                                        <h6 style="margin-left: 10px;"><?= $_SESSION['username']?></h6>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href = "logout.php" class="btn mb-3">Logout</a>
                        </div>
                    </div>
                    <h4 class="header-text">Daftar User Wisata Pantai</h4>
                    <table class="table table-striped table-hover">
                        <thead style="background-color: #7ed6df; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Nomer Hp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $no = 1;
                            // $sql = mysqli_query($con, "SELECT * FROM tbl_user");
                            // while ($dt = mysqli_fetch_array($sql)) { ?>
                            //     <tr>
                            //         <td><?= $no++?></td>
                            //         <td><?= $dt['nama']?></td>
                            //         <td><?= $dt['username']?></td>
                            //         <td><?= $dt['email']?></td>
                            //         <td><?= $dt['alamat']?></td>
                            //         <td><?= $dt['no_hp']?></td>
                            //     </tr>
                            // <?php// } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

</html> -->