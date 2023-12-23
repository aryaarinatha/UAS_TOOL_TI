<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="image/unud.png" sizes="32x32">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>UKM BADMINTON UNUD</title>
</head>
<body>
    <nav class="navbar navbar-primary bg-primary text-white">
        <span class="navbar-brand mb-0 h1">Unit Kegiatan Mahasiswa Badminton Universitas Udayana</span>
    </nav>
    <div class="container">
        <h4 class="mt-4 mb-4" ><center>DAFTAR ANGGOTA UKM BADMINTON UNUD</center></h4>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" class="form-inline mb-3">
            <div class="form-group">
                <label for="searchNIM" class="sr-only">Search by NIM:</label>
                <input type="text" class="form-control" id="searchNIM" name="nim" placeholder="Cari NIM">
            </div>
            <button type="submit" class="btn btn-primary mx-sm-2">Search</button>
        </form>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "koneksi.php";

                if (isset($_GET['id_peserta'])) {
                    $id_peserta=htmlspecialchars($_GET["id_peserta"]);
            
                    $sql="delete from peserta where id_peserta='$id_peserta' ";
                    $hasil=mysqli_query($kon,$sql);
            
                        if ($hasil) {
                            header("Location:index.php");
                        }else {
                            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                        }
                }

                if(isset($_GET['nim'])){
                    $searchNIM = htmlspecialchars($_GET['nim']);
                    if(empty($searchNIM)){
                        echo "<script>alert('Kolom Search Tidak Boleh Kosong!');</script>";
                        echo "<script>window.location.href='index.php';</script>";
                    } else if(!preg_match('/^[0-9]+$/', $searchNIM)){
                        echo "<script>alert('Format Input Pada Kolom Search Salah!');</script>";
                        echo "<script>window.location.href='index.php';</script>";
                    } else {
                        $sql = "SELECT * FROM peserta WHERE nim LIKE '$searchNIM'";
                        $hasil = mysqli_query($kon, $sql);
                        $no = 0;
                        if(mysqli_num_rows($hasil) > 0) {
                            while ($data = mysqli_fetch_array($hasil)) {
                                ?>
                                <tr>
                                    <td><?php echo $data["nim"];   ?></td>
                                    <td><?php echo $data["nama"]; ?></td>
                                    <td><?php echo $data["fakultas"];   ?></td>
                                    <td><?php echo $data["no_hp"];   ?></td>
                                    <td><?php echo $data["alamat"];   ?></td>
                                    <td>
                                        <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<script>alert('Tidak Ada Data Yang Sesuai Dengan Parameter!');</script>";
                            echo "<script>window.location.href='index.php';</script>";
                        }
                    }
                } else {
                    $sql = "SELECT * FROM peserta ORDER BY id_peserta ASC";
                    $hasil = mysqli_query($kon, $sql);
                    $no = 0;
                    while ($data = mysqli_fetch_array($hasil)) {
                        ?>
                        <tr>
                            <td><?php echo $data["nim"];   ?></td>
                            <td><?php echo $data["nama"]; ?></td>
                            <td><?php echo $data["fakultas"];   ?></td>
                            <td><?php echo $data["no_hp"];   ?></td>
                            <td><?php echo $data["alamat"];   ?></td>
                            <td>
                                <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <?php if(isset($_GET['nim']) && mysqli_num_rows($hasil) > 0): ?>
            <a href="index.php" class="btn btn-danger">Back</a>
        <?php endif; ?>
        
        <?php if (!(isset($_GET['nim']) && mysqli_num_rows($hasil) > 0)): ?>
            <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
        <?php endif; ?>
    </div>
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
        
        table {
            background-color: white;
        }
    </style>
</body>
</html>