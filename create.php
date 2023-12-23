<!DOCTYPE html>
<html>
<head>
    <title>Form Penambahan Data Anggota Baru</title>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nim = input($_POST["nim"]);
            $nama = input($_POST["nama"]);
            $fakultas = input($_POST["fakultas"]);
            $no_hp = input($_POST["no_hp"]);
            $alamat = input($_POST["alamat"]);

            $sql = "insert into peserta (nim, nama, fakultas, no_hp, alamat) values ('$nim', '$nama', '$fakultas', '$no_hp', '$alamat')";

            $hasil = mysqli_query($kon, $sql);

            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>

        <h2 class="mt-4 mb-4">Input Data Anggota Baru</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label>NIM:</label>
                <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukan NIM"/>
            </div>
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" id="name" class="form-control" placeholder="Masukan Nama" />
            </div>
            <div class="form-group">
                <label>Fakultas:</label>
                <input type="text" name="fakultas" id="fakultas" class="form-control" placeholder="Masukan Fakultas"/>
            </div>
            <div class="form-group">
                <label>No HP:</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Masukan No HP"/>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" class="form-control" autocomplete id="alamat" rows="5"placeholder="Masukan Alamat"></textarea>
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