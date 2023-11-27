<?php
include "../backend/database_con.php";
if(isset($_POST['delete_button_set']))
{
    $del_id = $_POST['delete_id'];

    $qry = "DELETE FROM dosen WHERE dosen_id = '$del_id'";
    $exec = mysqli_query($conn, $qry);

    
}