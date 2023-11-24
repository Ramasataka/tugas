<?php
    $kode_jurusan = $_GET['kode_jurusan'];
    include "backend/database_con.php";

    $qry = "SELECT * FROM tabel_jurusan WHERE kode_jurusan = '$kode_jurusan'";
    $exec = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($exec);

    $title = "Edit Jurusan " . $data['nama_jurusan'];
    include "head.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:index.php"); 
    }
    ?>
    <style>
        .no-data-cell {
        text-align: center;

        #shadow{
    
        box-shadow: 10px 10px 5px 12px black;
    }
    }
    </style>
<body class="d-flex flex-column min-vh-100 bg-dark bg-opacity-75">
<div class="bg-white container border border-primary w-50 mt-5">

        <h2 class="text-center mt-4">Data dari jurusan <br> <?= htmlspecialchars($data['nama_jurusan']) ?></h2>

        <hr>
        <form action="#" method="POST">
        <div class="mb-3">
                <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                <input type="number" name="kode_jurusan" value="<?= $data['kode_jurusan'] ?>" readonly class="form-control" id="kode_jurusan">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" value="<?= $data['nama_jurusan']?>" class="form-control" id="nama_jurusan">
            </div>
            
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save
                </button>
                <a href="jurusan.php" type="button" class="btn btn-secondary">Kembali</a>
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
</div>



            </form>
</div>
</div>
<br>
<?php 
        // include "footer.php";
    ?>
    
</body>
<?php
if (isset($_POST['simpan_edit_data'])){
    include 'backend/update_jurusan.php';
}
?>
</html>