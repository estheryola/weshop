<?php 
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    $level = "customer";
    $status = "on";
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    //menghilangkan password dari url
    unset($_POST["password"]);
    unset($_POST["re_password"]);
    $dataForm = http_build_query($_POST); //ambil data yang sudah diinput dan dimasukkan ke url
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'"); //cek validasi email yang diinput dan database

    if(empty($nama_lengkap) || empty($email) || empty($phone) || empty($alamat) || empty($password)){ //cek kelengkapan pengisian data
        header("location: ".BASE_URL."index.php?page=register&notif=require&$dataForm"); //data yg diisi belum lengkap ke url
    }
    else if($password != $re_password){ //cek input password dan repassword
        header("location: ".BASE_URL."index.php?page=register&notif=password&$dataForm"); //password yg diisi tidak sama
    }
    else if(mysqli_num_rows($query) == 1){ //cek validasi email
        header("location: ".BASE_URL."index.php?page=register&notif=email&$dataForm"); //email yg diisi sudah terdaftar di database
    }
    else{
    $password = md5($password);
    mysqli_query($koneksi, "INSERT INTO user (level, nama, email, alamat, phone, password, status)
                VALUES ('$level', '$nama_lengkap', '$email', '$alamat', '$phone', '$password', '$status')");
    header("location: ".BASE_URL."index.php?page=login"); 
    }
?>