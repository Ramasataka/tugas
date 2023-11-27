<?php
include "../backend/database_con.php";

$dosen_id = $_POST['dosen_id'];
$nama_dosen = mysqli_real_escape_string($conn, $_POST['nama_dosen']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
$matkul = mysqli_real_escape_string($conn, $_POST['matkul']);



$qry = "UPDATE dosen SET 
        nama_dosen = '$nama_dosen',
        email = '$email',
        no_hp = '$no_hp',
        matkul_id = '$matkul'
        WHERE dosen_id = '$dosen_id'
        ";

$exec = mysqli_query($conn, $qry);

if($exec){
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Data berhasil diupdate',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = '../data_dosen.php';
        }
    });
</script>";

}else{
    echo "Data gagal di simpan";
}