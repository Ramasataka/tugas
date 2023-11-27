<?php
include "../backend/database_con.php";
if(isset($_POST['delete_button_set']))
{
    $del_id = $_POST['delete_id'];

    $qry = "DELETE FROM kelas WHERE kelas_id = '$del_id'";
    $exec = mysqli_query($conn, $qry);

    
}