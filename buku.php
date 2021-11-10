<?php

require('koneksi.php');
session_start();

if( !isset($_SESSION['username']) ){
    $_SESSION['msg'] = 'Anda di wajibkan Login';
    header('Location: login.php');
}

if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
}

include('template/header.php');
include('template/navbar.php');
?>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

    html,
    body {
        -moz-box-sizing: border-box;
            box-sizing: border-box;
        height: 100%;
        width: 100%; 
        background: #FFFFFF;
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
    }
    
    .wrapper {
        display: table;
        height: 100%;
        width: 100%;
    }

    .container-fostrap {
        display: table-cell;
        padding: 1em;
        text-align: center;
        vertical-align: middle;
    }
    .fostrap-logo {
        width: 100px;
        margin-bottom:15px
    }
    h1.heading {
        color: #fff;
        font-size: 1.15em;
        font-weight: 900;
        margin: 0 0 0.5em;
        color: #505050;
    }
    @media (min-width: 450px) {
        h1.heading {
            font-size: 3.55em;
    }
    }
    @media (min-width: 760px) {
        h1.heading {
            font-size: 3.05em;
        }
    }
    @media (min-width: 900px) {
        h1.heading {
            font-size: 3.25em;
            margin: 0 0 0.3em;
        }
    } 
    .card {
        display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); 
        transition: box-shadow .25s; 
    }
    .card:hover {
        box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    }
    .img-card {
        width: 100%;
        height:200px;
        border-top-left-radius:2px;
        border-top-right-radius:2px;
        display:block;
        overflow: hidden;
    }
    .img-card img{
        width: 100%;
        height: 200px;
        object-fit:cover; 
        transition: all .25s ease;
    } 
    .card-content {
        padding:15px;
        text-align:left;
    }
    .card-title {
        margin-top:0px;
        font-weight: 700;
        font-size: 1.65em;
        color: #1E90FF;
    }
    .card-title a {
        color: #000;
        text-decoration: none !important;
    }
    .card-read-more {
        border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
        text-decoration: none !important;
        padding:10px;
        font-weight:600;
        text-transform: uppercase;
    }
</style>
<div class="container">
    <center><h1 class="heading mt-2 mb-2">Data Buku</h1></center>
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Tambah Data
            </button>
        </div>
        <div class="col-md-6 text-right">
            <form action="buku.php" method="get">
                <label>Pencarian :</label>
                <input type="text" name="cari">
                <input type="submit" value="Cari">
            </form>
        </div>
    </div>
    <div class="row pt-4">
        <?php 
        if(isset($_GET['cari'])){
            $cari = $_GET['cari'];
            $query = "SELECT * FROM buku where judul like '%".$cari."%'";				
        }else{
            $query = "SELECT * FROM buku";		
        }

        $sql = mysqli_query($con, $query);
        while ($buku = mysqli_fetch_array($sql)) {
        
        ?>
            <div class="col-md-3 col-sm-3">
                <div class="card">
                    <a class="img-card" href="http://www.fostrap.com/2016/03/bootstrap-3-carousel-fade-effect.html">
                    <img
                    src="gambar/<?= $buku['gambar']?>"
                    class="card-img-top" width = "50%"
                    alt="..." />
                    </a>
                    <div class="card-content">
                        <h4 class="card-title">
                            <?= $buku['judul']?>
                        </h4>
                        <p class="">
                           Pengarang : <?= $buku['pengarang']?>, penerbit : <?= $buku['penerbit']?>
                        </p>
                    </div>
                    <div class="card-read-more">
                        <div class="row">
                            <div class="col-md-6 text-center mt-2 mb-2">
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update<?= $buku['id_buku']?>">
                                    Update Data
                                </button>
                                <div class="modal text-left" id="update<?= $buku['id_buku']?>">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Data</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="action/update_buku.php" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">    
                                                    <input type="hidden" name = "id_buku" class = "form-control" value = "<?= $buku['id_buku']?>">
                                                    <div class="form-group">
                                                        <label for="">Judul</label>
                                                        <input type="text" name="judul" class ="form-control" value = <?= $buku['judul']?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Pengarang</label>
                                                        <input type="text" name="pengarang" class ="form-control" value = <?= $buku['pengarang']?>>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Penerbit</label>
                                                        <input type="text" name="penerbit" class ="form-control" value = <?= $buku['penerbit']?>>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <input type="submit" name = "update" class = "btn btn-primary" value = "$_COOKIE">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center  mt-2 mb-2">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?= $buku['id_buku']?>">
                                    delete Data
                                </button>
                                <div class="modal" id="delete<?= $buku['id_buku']?>">
                                    <div class="modal-dialog modal-dialog-scrollable modal-sm">
                                        <div class="modal-content">

                                            <form action="action/delete_buku.php" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">    
                                                    <input type="hidden" name = "id_buku" class = "form-control" value = "<?= $buku['id_buku']?>">
                                                    <h5>Delete data?</h5>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <input type="submit" name = "delete" class = "btn btn-primary" value = "Hapus">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
    </div>
</div>

<!-- Button to Open the Modal -->


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Buku</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="action/add_buku.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">    
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" name="judul" class ="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Pengarang</label>
                <input type="text" name="pengarang" class ="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Penerbit</label>
                <input type="text" name="penerbit" class ="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Gambar</label>
                <input type="file" name="gambar" class ="form-control" required>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <input type="submit" name = "add" class = "btn btn-primary" value = "Save">
        </div>
      </form>
    </div>
  </div>
</div>





<?php include('template/footer.php')?>
