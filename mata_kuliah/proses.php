
<?php
    include './backend/database_con.php';

    $matkul_id = mysqli_real_escape_string($conn, $_POST['matkul_id']);
    $nama_matkul = mysqli_real_escape_string($conn, $_POST['nama_matkul']);
    $sks = mysqli_real_escape_string($conn, $_POST['sks']);
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);


    $check_query = "SELECT * FROM mata_kuliah WHERE matkul_id = '$matkul_id'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Id matkul Sudah Terbuat',
        });
        </script>";
    } else {
        $qry = "INSERT INTO mata_kuliah VALUES (
            '$matkul_id', '$nama_matkul', '$sks', '$jurusan'
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
                    window.location = './input_matkul.php';
                }
            });
            </script>";
        } else {
            echo "Data gagal disimpan";
        }
    }



?>
