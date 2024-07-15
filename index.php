<?php

include "config.php";
session_start();

// $_SESSION['idk'] = true;
// $_SESSION['namek'] = true;
// $_SESSION['mailk'] = true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Kodam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    body, html {
        height: 100%;
    }
    .card{
        width: 800px;
        border: none;
        border-radius: 15px;
    }
    .adiv{
        background: #04CB28;
        border-radius: 15px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        font-size: 22px;
        height: 50px;
    }
    .chat{
        border: none;
        background: #E2FFE8;
        font-size: 18px;
        border-radius: 20px;
    }
    .chat2{
        border: none;
        background: yellow;
        font-size: 18px;
        border-radius: 20px;
    }
    .bg-white{
        border: 1px solid #E7E7E9;
        font-size: 18px;
        border-radius: 20px;
    }
    .myvideo img{
        border-radius: 20px
    }
    .dot{
        font-weight: bold;
    }
    .form-control{
        border-radius: 12px;
        border: 1px solid #F0F0F0;
        font-size: 18px;
    }
    .form-control:focus{
        box-shadow: none;
        }
    .form-control::placeholder{
        font-size: 18px;
        color: #C4C4C4;
    }
</style>
<body>
    <?php
    
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if (isset($_SESSION['idk'])) {
            if ($status == 'login') {
                echo "<script>Swal.fire({
                    title: '<strong>Yeyy</strong>',
                    text: 'Anda berhasil login',
                    icon: 'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.replace('index.php');
                    }
                  });</script>";
            }
        } else {
            if ($status == 'logout') {
                echo "<script>Swal.fire({
                    title: '<strong>Yeyy</strong>',
                    text: 'Anda berhasil logout',
                    icon: 'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.replace('index.php');
                    }
                  });</script>";
            }
        }
    }

    ?>
    <div class="container mt-5">
        <div class="d-flex justify-content-center align-items-start" style="height: 100%; margin-top: 100px;">
            <div class="card shadow-lg" style="width: 50rem;">
                <div class="card-body">
                    <h2 class="card-title">Check Kodam</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="nama" id="name" placeholder="Enter your name">
                        </div>
                        <button type="submit" name="submit" class="btn btn-lg btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        
        if (isset($_POST['submit'])) {
            $nama = htmlspecialchars(htmlentities($_POST['nama']));
            $json_file = 'kodam.json';
            $json_data = file_get_contents($json_file);
            $data = json_decode($json_data, true);
            shuffle($data['kodam']);
            $first_kodam = $data['kodam'][0];
            if ($_POST['nama'] !== "") {
                if ($first_kodam['nama'] == 'kosong') {
                    echo "<script>Swal.fire({
                        title: '<strong>".$nama."</strong>',
                        html: '<h6>Kodam Kamu : ".$first_kodam['nama']."<br>Kekuatan : ".$first_kodam['kekuatan']."</h6>',
                        icon: 'error'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.replace('index.php');
                        }
                      });</script>";
                } else {
                    echo "<script>Swal.fire({
                        title: '<strong>".$nama."</strong>',
                        html: '<h6>Kodam Kamu : ".$first_kodam['nama']."<br>Kekuatan : ".$first_kodam['kekuatan']."</h6>',
                        icon: 'success'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.replace('index.php');
                        }
                      });</script>";
                }
            } else {
                echo "<script>Swal.fire({
                    title: '<strong>ERROR!</strong>',
                    text: 'Nama Tidak Boleh Kosong',
                    icon: 'error'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.replace('index.php');
                    }
                  });</script>";
            }
        }

        ?>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="card mt-5 shadow-lg">
            <div class="d-flex flex-row justify-content-between p-3 adiv text-white">
                <i class="fas fa-chevron-left"></i>
                    <span class="pb-3">Live Komen Wak</span><?php if (isset($_SESSION['idk'])) { echo '<a style="color: red; text-decoration: none;" href="logout.php"><b>Logout</b></a>';} else { echo '';}?>
                <i class="fas fa-times"></i>
            </div>
            <div class="d-flex flex-row p-3">
                <center><div class="chat2 ml-2 p-3"><b>😊Lix?</b><br>Wellcome guys, this web hanya untuk gabut ajg.<br><i><b>Copyright © Made With ❤️ And Bootstrap 5</b></i></div></center>
            </div>
            <?php
            
            $allComment = $db->query("SELECT * FROM chat ORDER BY id_cht");

            while ($komen = $allComment->fetch_assoc()) {
            
                if (isset($_SESSION['idk'])) {
                    if ($komen['email_cht'] === $_SESSION['emailk']) {
                    ?>  
                        <div class="d-flex flex-row p-3">
                            <div class="<?php if($komen['email_cht'] === $_SESSION['emailk']) { echo 'chat ml-2 p-3'; } else { echo 'bg-white mr-2 p-3'; } ?>"><?php if($komen['email_cht'] === $_SESSION['emailk']) { echo ''; } else { echo '<span class="text-muted">'; } ?><b><?=$komen['nama_cht']?></b><br><?=$komen['isi_cht']?></span></div>
                            <img src="https://img.icons8.com/color/48/000000/circled-user-<?=$komen['gender_cht']?>-skin-type-7.png" width="30" height="30">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="d-flex flex-row p-3">
                            <img src="https://img.icons8.com/color/48/000000/circled-user-<?=$komen['gender_cht']?>-skin-type-7.png" width="30" height="30">
                            <div class="<?php if($komen['email_cht'] === $_SESSION['emailk']) { echo 'chat ml-2 p-3'; } else { echo 'bg-white mr-2 p-3'; } ?>"><?php if($komen['email_cht'] === $_SESSION['emailk']) { echo ''; } else { echo '<span class="text-muted">'; } ?><b><?=$komen['nama_cht']?></b><br><?=$komen['isi_cht']?></span></div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="d-flex flex-row p-3">
                        <img src="https://img.icons8.com/color/48/000000/circled-user-<?=$komen['gender_cht']?>-skin-type-7.png" width="30" height="30">
                        <div class="bg-white mr-2 p-3"><span class="text-muted"><b><?=$komen['nama_cht']?></b><br><?=$komen['isi_cht']?></span></div>
                    </div>
                    <?php
                }
                    

                
            }

            ?>

            <!-- <div class="d-flex flex-row p-3">
                <img src="https://img.icons8.com/color/48/000000/circled-user-male-skin-type-7.png" width="30" height="30">
                <div class="bg-white mr-2 p-3"><span class="text-muted"><b>Jhon</b><br>Hello and thankyou for visiting birdlynind.</span></div>
            </div>

            <div class="d-flex flex-row p-3">
                <div class="chat ml-2 p-3"><b>Jhon</b><br>Hello and thankyou for visiting birdlymind. Please click the video above</div>
                <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-7.png" width="30" height="30">
            </div> -->

            
            <div class="form-group px-3">
                <form method="post">
                    <div class="input-group">
                        <textarea class="form-control" name="isi" rows="5" placeholder="Type your message"></textarea>
                        <button type="submit" name="kmn" class="btn btn-outline-secondary btn-success" style="color: white"><h6>Submit >></h6></button>
                    </div>
                </form><br>
                <?php
                
                if (isset($_POST['kmn'])) {
                    if (isset($_SESSION['idk'])) {
                        $komentar = htmlspecialchars(htmlentities(mysqli_real_escape_string($db, $_POST['isi'])));
                        $ququery = $db->query("INSERT INTO chat(nama_cht,email_cht,isi_cht,gender_cht) VALUES('".$_SESSION["namek"]."','".$_SESSION["emailk"]."','".$komentar."','".$_SESSION["genderk"]."')");
                        if (!$ququery) {
                            echo "<script>Swal.fire({
                                title: '<strong>Opss...</strong>',
                                text: 'Komentar tidak terkirim',
                                icon: 'error'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                  window.location.replace('index.php');
                                }
                              });</script>";
                        }
                        echo "<script>window.location.href = window.location.href;</script>";
                        exit;
                    } else {
                        echo "<script>Swal.fire({
                            title: '<strong>Opss...</strong>',
                            text: 'Anda harus login terlebih dahulu',
                            icon: 'error',
                            footer: '<a href=login.php>Silahkan login disini</a>'
                        }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.replace('index.php');
                            }
                          });</script>";
                    }
                }

                ?>
            </div>
        </div>
    </div>
    <div style="height: 10%; margin-top: 50px;"></div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>