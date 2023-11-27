<?php
include "database_con.php";
if(isset($_POST['delete_button_set']))
{
    $del_id = $_POST['delete_id'];
    $kelas_id = $_POST['kelas_id'];

    $qry = "DELETE FROM mahasiswa_kelas WHERE nim = '$del_id' AND kelas_id = '$kelas_id'";
    $exec = mysqli_query($conn, $qry);

    
}