<?php
 include '../backend/database_con.php';
    $matkul_id = $_GET['matkul_id'];

    $query = "SELECT mata_kuliah.*, tabel_jurusan.* FROM mata_kuliah
                INNER JOIN tabel_jurusan ON mata_kuliah.kode_jurusan = tabel_jurusan.kode_jurusan WHERE matkul_id = '$matkul_id'";
    $result = mysqli_query($conn,$query);
    $data_matkul = mysqli_fetch_assoc($result);


    $title = "Edit Mata Kuliah " . $data_matkul['nama_matkul'];
    include "../head.php";
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
<div class="bg-white container border border-primary w-50d">
        <h2 class="text-center mt-4">Edit Data dari mata Kuliah <br> <?= htmlspecialchars($data_matkul['nama_matkul']) ?></h2>
        
        <hr>
        <form action="#" method="POST">
        <div class="mb-3">
                <label for="matkul_id" class="form-label">Matkul ID</label>
                <input type="text" name="matkul_id" value="<?= $data_matkul['matkul_id'] ?>" readonly class="form-control" id="matkul_id">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matkul" value="<?= $data_matkul['nama_matkul']?>" class="form-control" id="nama_matkul">
            </div>

            <div class="mb-3">
                <label for="sks" class="form-label">SKS</label><br>
                <input type="number"  name="sks" class="form-control" value="<?= $data_matkul['sks']?>" id="validationCustom03" required>
            </div>
            
            <div class="mb-3">

                <label for="kode_jurusan" class="form-label">Jurusan</label>
                <select class="form-select" id="validationCustom03" name="jurusan" required>
                    <?php
                        $query = "SELECT * FROM tabel_jurusan";
                        $result_jurusan = mysqli_query($conn, $query);
                    ?>
                    <option  value="<?= $data_matkul['kode_jurusan']?>" selected> <?= $data_matkul['nama_jurusan']; ?> </option>
                    <?php while ($data = mysqli_fetch_assoc($result_jurusan)) { ?>
                    <option value="<?php echo $data['kode_jurusan']; ?>"> <?php echo $data['nama_jurusan'];?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save
                </button>

                <a href="../input_matkul.php" type="button" class="btn btn-secondary">Kembali</a>
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

    
</body>
<?php
if (isset($_POST['simpan_edit_data'])){
    include 'update.php';
}
?>
</html>