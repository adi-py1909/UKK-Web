<?php
require('koneksi.php');
session_start();
 
$error = '';
$validate = '';
if( isset($_SESSION['username']) ) header('Location: index.php');
if( isset($_POST['submit']) ){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(!empty(trim($username)) && !empty(trim($password))){
 
            $query      = "SELECT * FROM siswa WHERE username = '$username'";
            $result     = mysqli_query($con, $query);
            $rows       = mysqli_num_rows($result);
            if ($rows != 0) {
                $hash   = mysqli_fetch_assoc($result)['password'];
                if(password_verify($password, $hash)){
                    $_SESSION['username'] = $username;
                    echo "
                    <script> 
                        alert('Login Berhasil!!');
                        document.location.href = 'index.php';
                        </script>
                    ";
                }
            } else {
                $error =  'Username dan password Salah !!';
            }
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
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

    <title>Login</title>
</head>

<body>
    <div class="vertical-center">
        <div class="card">
            <div class="text-center intro"> <img src="https://i.imgur.com/uNiv4bD.png" width="160"> <span class="d-block account">Sudah Memiliki Akun?</span> <span class="contact">Kalo belum Klik<a href="register.php" class="mail"> Register </a> dan <br> anda baru bisa login</span> </div>
            <?php if(isset($_SESSION['msg'])){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                    Anda Belumm Login !!!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if($error != ''){ ?>
                <div class="alert alert-danger alert-dismissible" role="alert" id="liveAlert">
                    <?= $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <div class="mt-4 text-center">
                <h4>Log In.</h4> <span>Login ketika sudah memiliki akun</span>
                <form action="login.php" method="post">
                    <div class="mt-3 inputbox"> 
                        <input type="text" class="form-control" name="username" placeholder="Username"> <i class="fa fa-user"></i> 
                    </div>
                    <div class="inputbox"> 
                        <input type="password" class="form-control" name="password" placeholder="Password"> <i class="fa fa-lock"></i> 
                    </div>
            </div>
                <div class="mt-2"> 
                    <input type="submit" name = "submit" class = "btn btn-primary btn-block" value = "Log In"></input>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
</body>

</html>