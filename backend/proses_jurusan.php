
<?php
    include 'database_con.php';

    $kode_jurusan = mysqli_real_escape_string($conn, $_POST['kode_jurusan']);
    $nama_jurusan = mysqli_real_escape_string($conn, $_POST['nama_jurusan']);


    $check_query = "SELECT * FROM tabel_jurusan WHERE kode_jurusan = '$kode_jurusan'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Kode Jurusan Sudah Terbuat',
        });
        </script>";
    } else {
        $qry = "INSERT INTO tabel_jurusan VALUES ('$kode_jurusan', '$nama_jurusan')";
        $exec = mysqli_query($conn, $qry);

        if ($exec) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data berhasil disimpan',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = './jurusan.php';
                }
            });
            </script>";
        } else {
            echo "Data gagal disimpan";
        }
    }



?>