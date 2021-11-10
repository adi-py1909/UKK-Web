<?php 

require('../koneksi.php');
session_start();



if( !isset($_SESSION['username']) ){
  $_SESSION['msg'] = 'Anda di wajibkan Login';
  header('Location: login.php');
}

if(isset($_POST['delete'])){
    $id_buku = $_POST['id_buku'];
    $query = "DELETE FROM `buku` WHERE id_buku = '".$id_buku."'";

    $sql = mysqli_query($con, $query); 
    if($sql){
        echo "<script> 
                alert('Data berhasil Di delete!');
                document.location.href = '../buku.php';
            </script>
        ";
    }else{
    echo "<script> 
                alert('Gagal didelete dalam database!');
                document.location.href = '../buku.php';
            </script>
        ";
    }
}
?>