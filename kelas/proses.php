
<?php

$selectedDosen = $_POST['dosen'];
$selectedJurusan = $_POST['selectedJurusan'];
$selectedMatkul = $_POST['selectedMatkul'];
$kelas_id = mysqli_real_escape_string($conn, $_POST['kelas_id']);
$ruangan = mysqli_real_escape_string($conn, $_POST['ruang']);
$hari = mysqli_real_escape_string($conn, $_POST['hari']);
$jam_awal = mysqli_real_escape_string($conn, $_POST['jam_awal']);
$jam_akhir = mysqli_real_escape_string($conn, $_POST['jam_akhir']);


include '../backend/database_con.php';

$check_query = "SELECT * FROM `kelas` WHERE kelas_id = '$kelas_id'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0){
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Kelas Sudah Terbuat',
        
    }).then(() => {
        window.location = '../tampilan_data.php';
    });
    </script>";
    }else{
        $qry = "INSERT INTO kelas VALUES (
            '$kelas_id', '$selectedJurusan', '$selectedMatkul','$selectedDosen', '$ruangan', '$hari', '$jam_awal', '$jam_akhir'
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
                        window.location = '../tampilan_data.php';
                    }
                });
            </script>";
        }else{
            echo "Data gagal di simpan";
        }
    }

?>