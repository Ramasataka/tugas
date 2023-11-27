<?php
include "database_con.php";

$kode_jurusan = $_POST['kode_jurusan'];
$nama_jurusan = mysqli_real_escape_string($conn, $_POST['nama_jurusan']);


$qry = "UPDATE tabel_jurusan SET 
        nama_jurusan = '$nama_jurusan'
        WHERE kode_jurusan = '$kode_jurusan'
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
            window.location = './jurusan.php';
        }
    });
</script>";

}else{
    echo "Data gagal di simpan";
}