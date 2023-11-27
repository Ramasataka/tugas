<?php
    include 'database_con.php';

    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);

    $select_qry = "SELECT * FROM mahasiswa_kelas WHERE nim = '$nim' AND kelas_id = '$kelas'";
    $result = mysqli_query($conn, $select_qry);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Mahasiswa sudah mengikuti kelas ini',
        });
        </script>";
    } else {
        $qry = "INSERT INTO mahasiswa_kelas VALUES ('$nim', '$kelas')";
        $exec = mysqli_query($conn, $qry);

        if ($exec) {
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
        } else {
            echo "Data gagal disimpan";
        }
    }
?>
