<!DOCTYPE html>
<html>
<head>
    <title>Form Update Data Anggota</title>
    <link rel="icon" type="image/png" href="image/unud.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php

        include "koneksi.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    
        if (isset($_GET['id_peserta'])) {
            $id_peserta=input($_GET["id_peserta"]);

            $sql="select * from peserta where id_peserta=$id_peserta";
            $hasil=mysqli_query($kon,$sql);
            $data = mysqli_fetch_assoc($hasil);


        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id_peserta=htmlspecialchars($_POST["id_peserta"]);
            $nim=input($_POST["nim"]);
            $nama=input($_POST["nama"]);
            $fakultas=input($_POST["fakultas"]);
            $no_hp=input($_POST["no_hp"]);
            $alamat=input($_POST["alamat"]);

            $sql="update peserta set
                nim='$nim',
                nama='$nama',
                fakultas='$fakultas',
                no_hp='$no_hp',
                alamat='$alamat'
                where id_peserta=$id_peserta";

            $hasil=mysqli_query($kon,$sql);

            if ($hasil) {
                header("Location:index.php");
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

            }

        }

        $id_peserta = $_GET["id_peserta"];
        $sql = mysqli_query($kon,"SELECT * FROM peserta WHERE id_peserta='$id_peserta'");
        $data = mysqli_fetch_array($sql);

        ?>
        <h2 class="mt-4 mb-4">Update Data Anggota</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validateForm()">

            <input type="hidden" name="id_peserta" value="<?= $data['id_peserta'] ?>" id="">
            <div class="form-group">
                <label>NIM:</label>
                <input type="text" name="nim" value="<?= $data['nim'] ?>" id="nim" class="form-control" placeholder="Masukan NIM"/>
            </div>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" value="<?= $data['nama'] ?>" id="name" class="form-control" placeholder="Masukan Nama"/>
            </div>
            <div class="form-group">
                <label>Fakultas:</label>
                <input type="text" name="fakultas" value="<?= $data['fakultas'] ?>" id="fakultas" class="form-control" placeholder="Masukan Fakultas"/>
            </div>
            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>" id="no_hp" class="form-control" placeholder="Masukan No HP"/>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" id="alamat"><?= $data['alamat'] ?></textarea>
            </div>


            <button type="submit" name="submit" class="btn btn-primary">Submit</button>

            <a href="index.php" class="btn btn-danger">Back</a>
        </form>
    </div>
    <script src="validateForm.js"></script>
    <style>
            body {
                background-image: url('image/background.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                color: black;
                height: 100vh;
                margin: 0;
                display: flex;
                flex-direction: column;
            }
    </style>
</body>
</html>