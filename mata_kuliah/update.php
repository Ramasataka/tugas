<?php
include "../backend/database_con.php";

$matkul_id = $_POST['matkul_id'];
$nama_matkul = mysqli_real_escape_string($conn, $_POST['nama_matkul']);
$jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);
$sks = mysqli_real_escape_string($conn, $_POST['sks']);


$qry = "UPDATE mata_kuliah SET 
        nama_matkul = '$nama_matkul',
        sks = '$sks',
        kode_jurusan = '$jurusan'
        WHERE matkul_id = '$matkul_id'";
        
        $exec = mysqli_query($conn, $qry);

if($exec){
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Data berhasil diupdate',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = '../input_matkul.php';
        }
    });
</script>";

}else{
    echo "Data gagal di simpan";
}