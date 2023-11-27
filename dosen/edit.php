<?php
    $title = "Edit dosen";
    include "../head.php";

    
    $dosen_id = $_GET['dosen_id'];
    include "../backend/database_con.php";

    $qry = "SELECT * FROM dosen WHERE dosen_id = '$dosen_id'";
    $exec = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($exec);
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../index.php"); 
    }
?>

<style>
        .no-data-cell {
        text-align: center;
    }
    #shadow{
    
        box-shadow: 10px 10px 5px 12px black;
    }
    </style>
    

<body class="d-flex flex-column min-vh-100 bg-dark bg-opacity-75">
<br>
<div class="bg-white container border border-primary w-50">
        <h2 class="text-center mt-4">Data dari Dosen <br> <?= htmlspecialchars($data['nama_dosen']) ?></h2>

        <hr>
        <form action="" method="POST">
        <div class="mb-3">
                <label for="dosen" class="form-label">ID</label>
                <input type="text" name="dosen_id" value="<?= $data['dosen_id'] ?>" readonly class="form-control" id="dosen">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dosen</label>
                <input type="text" name="nama_dosen" value="<?= $data['nama_dosen']?>" class="form-control" id="nama">
            </div>
            
            
            <div class="mb-3">
                <label for="gender">Email</label><br>
                <input type="text" name="email" value="<?= $data['email'] ?>" class="form-control" id="alamat">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">No HP</label>
                <input type="number" name="no_hp" value="<?= $data['no_hp'] ?>" class="form-control" id="alamat">
            </div>
            
            <div class="mb-3">
                <label for="matkul_id" class="form-label">Mata Kuliah</label>
                <select class="form-select" name="matkul">
                    <?php
                    $query = "SELECT * FROM `mata_kuliah`";
                    $result_matkul = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result_matkul)) {
                        $selected = ($row['matkul_id'] == $data['matkul_id']) ? 'selected' : '';
                        echo "<option value=\"{$row['matkul_id']}\" $selected>{$row['nama_matkul']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save
                </button>

                <a href="../data_dosen.php" type="button" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body text-center">
            <h3>Are you sure to save this data ?</h3>
            <button type="submit" name="simpan_edit_data" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>

    </form>

    <?php
    if (isset($_POST['simpan_edit_data'])){
    include 'update.php';
}
?>

