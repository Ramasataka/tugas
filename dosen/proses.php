
<?php
    include './backend/database_con.php';

    $dosen_id = mysqli_real_escape_string($conn, $_POST['dosen_id']);
    $nama_dosen = mysqli_real_escape_string($conn, $_POST['nama_dosen']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $matkul_id = mysqli_real_escape_string($conn, $_POST['mata_kuliah']);


    $check_query = "SELECT * FROM dosen WHERE dosen_id = '$dosen_id'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Id doses Sudah Terbuat',
        });
        </script>";
    } else {
        $qry = "INSERT INTO dosen VALUES (
            '$dosen_id', '$nama_dosen', '$email', '$no_hp','$matkul_id'
        )";
        $exec = mysqli_query($conn, $qry);

        if ($exec) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data berhasil disimpan',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = './data_dosen.php';
                }
            });
            </script>";
        } else {
            echo "Data gagal disimpan";
        }
    }



?>