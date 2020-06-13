<?php 
    if($user_id){ //protect ketika user sudah login, tidak bisa kembali ke halaman register
        header("location: ".BASE_URL);
    }
?>

<div id="container-user-access">
    <form action="<?php echo BASE_URL . "proses_login.php"; ?>" method="POST">

        <?php
        $notif = isset($_POST["notif"]) ? $_POST["notif"] : false;

        if ($notif == true) {
            echo "<div class='notif'> Sorry, please complete the login form </div>";
            //menampilkan notifikasi ada data yang belum lengkap
        }
        ?>

        <div class="element-form">
            <label>Email</label>
            <span><input type="text" name="email" /></span>
        </div>
        <div class="element-form">
            <label>Password</label>
            <span><input type="password" name="password" /></span>
        </div>
        <div class="element-form">
            <span><input type="submit" value="Login" /></span>
        </div>
    </form>
</div>