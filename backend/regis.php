
<?php

$nim = mysqli_real_escape_string($conn, $_POST['nim']);
$nama_mhs = mysqli_real_escape_string($conn, $_POST['nama']);
$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
$email = mysqli_real_escape_string($conn, $_POST['email']);



include 'database_con.php';

$check_query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Nim Sudah Terbuat',
    });
    </script>";
    }else{
        $qry = "INSERT INTO mahasiswa VALUES (
            '$nim', '$nama_mhs', '$jurusan', '$gender', '$alamat', '$no_hp', '$email'
        )";

        $exec = mysqli_query($conn, $qry);

        if($exec){
                echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Data berhasil disimpan',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = './mahasiswa.php';
                    }
                });
            </script>";
        }else{
            echo "Data gagal di simpan";
        }
    }

?>