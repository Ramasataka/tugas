<?php
include "database_con.php";
if(isset($_POST['delete_button_set']))
{
    $del_id = $_POST['delete_id'];

    $qry = "DELETE FROM tabel_jurusan WHERE kode_jurusan = '$del_id'";
    $exec = mysqli_query($conn, $qry);

    
}