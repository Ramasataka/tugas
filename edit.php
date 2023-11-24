    <?php
    $nim = $_GET['nim'];
    include "backend/database_con.php";

    $qry = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $exec = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($exec);

    $title = "Edit Mahasiswa Mahasiswa " . $data['nama_mhs'];
    include "head.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:index.php"); 
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
    <div class=" bg-white container border border-primary w-50">
        <h2 class="text-center mt-4">Edit Data dari mahasiswa <br> <?= htmlspecialchars($data['nama_mhs']) ?></h2>
     
       
        <hr>
        <form action="" method="POST">
        <div class="mb-3">
                <label for="nim" class="form-label">Nim</label>
                <input type="number" name="nim" value="<?= $data['nim'] ?>" readonly class="form-control" id="nim">
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" name="nama" value="<?= $data['nama_mhs']?>" class="form-control" id="nama">
            </div>
            
            <div class="mb-3">
                <label for="kode_jurusan" class="form-label">Jurusan</label>
                <select class="form-select" name="jurusan">
                    <?php
                    include 'database_con.php';
                    $query = "SELECT * FROM `tabel_jurusan`";
                    $result_jurusan = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result_jurusan)) {
                        $selected = ($row['kode_jurusan'] == $data['kode_jurusan']) ? 'selected' : '';
                        echo "<option value=\"{$row['kode_jurusan']}\" $selected>{$row['nama_jurusan']}</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="gender">Gender</label><br>
                <?php
                            if($data['gender'] == 1) {
                        ?>
                            <input type="radio" name="gender" value="1" checked> laki-laki
                            <input type="radio" name="gender" value="2"> Perempuan
                        <?php } else { ?>
                            <input type="radio" name="gender" value="1"> laki-laki
                            <input type="radio" name="gender" value="2" checked> Perempuan
                        <?php } ?>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="form-control" id="alamat">
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No Hp</label>
                <input type="number" name="no_hp" value="<?= $data['no_hp'] ?>" class="form-control" id="no_hp">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control" id="email">
            </div>
            
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save
                </button>
            
                    <a href="mahasiswa.php" type="button" class="btn btn-secondary">Kembali</a>
                
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
    include 'backend/update.php';
}
?>
</html>