<?php
include "database_con.php";

$nim = $_POST['nim'];
$nama_mhs = mysqli_real_escape_string($conn, $_POST['nama']);
$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
$email = mysqli_real_escape_string($conn, $_POST['email']);


$qry = "UPDATE mahasiswa SET 
        nama_mhs = '$nama_mhs',
        kode_jurusan = '$jurusan',
        gender = '$gender',
        alamat = '$alamat',
        no_hp = '$no_hp',
        email = '$email'
        WHERE nim = '$nim'
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
            window.location = './mahasiwa.php';
        }
    });
</script>";

}else{
    echo "Data gagal di simpan";
}