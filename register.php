<?php
require('koneksi.php');
session_start();
 
$error = '';
$validate = '';
if( isset($_POST['submit']) ){
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];
        $repass = $_POST['repassword'];
        // $username = stripslashes($_POST['username']);
        // $username = mysqli_real_escape_string($con, $username);
        // $nama     = stripslashes($_POST['nama']);
        // $nama     = mysqli_real_escape_string($con, $nama);
        // $email    = stripslashes($_POST['email']);
        // $email    = mysqli_real_escape_string($con, $email);
        // $alamat    = stripslashes($_POST['alamat']);
        // $alamat    = mysqli_real_escape_string($con, $alamat);
        // $no_hp    = stripslashes($_POST['no_hp']);
        // $no_hp    = mysqli_real_escape_string($con, $no_hp);
        // $password = stripslashes($_POST['password']);
        // $password = mysqli_real_escape_string($con, $password);
        // $repass   = stripslashes($_POST['repassword']);
        // $repass   = mysqli_real_escape_string($con, $repass);
        if(!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($alamat)) && !empty(trim($no_hp)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
            if($password == $repass){
                if( cek_nama($nama,$con) == 0 ){
                    $pass  = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO siswa(nama, username, password, email, alamat, no_hp) VALUES ('$nama','$username','$pass','$email', '$alamat', '$no_hp')";
                    $result   = mysqli_query($con, $query);
                    if ($result) {
                        $_SESSION['username'] = $username;
        
                        echo "
                            <script> 
                            alert('Registrasi Berhasil dilakukan!!');
                            document.location.href = 'index.php';
                            </script>
                            ";

                    } else {
                        $error =  'Register User Gagal !!';
                    }
                }else{
                        $error =  'Username sudah terdaftar !!';
                }
            }else{
                $validate = 'Password tidak sama !!';
            }
             
        }else {
            $error =  'Data tidak boleh kosong !!';
            
        }
    } 
    function cek_nama($username,$con){
        $nama = mysqli_real_escape_string($con, $username);
        $query = "SELECT * FROM siswa WHERE username = '$nama'";
        if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
    }
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>Register</title>
</head>

<body>
    <div class="vertical-center">
            <div class="card">
                <div class="text-center intro"> <img src="https://i.imgur.com/uNiv4bD.png" width="160"> <span class="d-block account">Registrasi terlebih dahulu</span> <span class="contact"> jika sudah Klik<a href="login.php" class="mail"> Login </a> dan <br> anda baru bisa login</span> </div>
                <?php if($error != ''){ ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                        <?= $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="mt-4">
                    <form action="register.php" method="post">
                        <div class="mb-2 form-group">
                            <input type="text" class="form-control" name = "nama" id=""
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-2 form-group">
                            <input type="text" class="form-control" name = "username" id=""
                                placeholder="Username">
                        </div>
                        <div class="mb-2 form-group">
                            <input type="email" class="form-control" name = "email" id=""
                                placeholder="Email">
                        </div>
                        <div class="mb-2 form-group">
                            <input type="number" class="form-control" name = "no_hp" id=""
                                placeholder="Nomer Hp">
                        </div>
                        <div class="mb-2 form-group">
                            <input type="password" class="form-control" name = "password" id=""
                                placeholder="Password">
                        </div>
                        <div class="mb-3 form-group">
                            <input type="text" class="form-control" name = "alamat" id=""
                                placeholder="alamat">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
                            <?php if($validate != '') {?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php }?>
                        </div>
                        </div>
                        <div class="mt-2"> 
                            <input type="submit" name = "submit" value="Register" class = "btn btn-primary btn-block"> 
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

</html>