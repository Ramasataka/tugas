<?php
include "../backend/database_con.php";

$kelas = $_POST['kelas'];
// $kode_jurusan = $_POST['jurusan'];
// $matkul_id = $_POST['matkul'];
// $dosen_id = $_POST['dosen'];
$ruang = mysqli_real_escape_string($conn, $_POST['ruangan']);
$hari = mysqli_real_escape_string($conn, $_POST['hari']);
$mulai = mysqli_real_escape_string($conn, $_POST['mulai']);
$akhir = mysqli_real_escape_string($conn, $_POST['akhir']);



$qry = "UPDATE kelas SET
        ruang_kelas = '$ruang',
        hari_kelas = '$hari',
        mulai_jam_kelas = '$mulai',
        akhir_jam_kelas = '$akhir'
        WHERE kelas_id = '$kelas'
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
            window.location = '../tampilan_data.php';
        }
    });
</script>";

}else{
    echo "Data gagal di simpan";
}