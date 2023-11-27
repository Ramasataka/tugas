<?php
    $kelas = $_GET['kelas_id'];
    include "../backend/database_con.php";

    $qry = "SELECT * FROM kelas WHERE kelas_id = '$kelas'";
    $exec = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($exec);

    $title = "Edit kelas " . $data['kelas_id'];
    include "../head.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../index.php"); 
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
<br>
    <div class=" bg-white container border border-primary w-50">
        <h2 class="text-center mt-4">Data dari kelas<br> <?= htmlspecialchars($data['kelas_id']) ?></h2>
        <hr>
        <form action="" method="POST">
        <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" name="kelas" value="<?= $data['kelas_id'] ?>" readonly class="form-control">
            </div>

            <div class="mb-3">
                <label for="kode_jurusan" class="form-label">Jurusan</label>
                <select class="form-select" name="jurusan" aria-label="Disabled select example" disabled>
                    <?php
                    include '../backend/database_con.php';
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
                <label for="matkul" class="form-label">Mata Kuliah</label>
                <select class="form-select" name="matkul" aria-label="Disabled select example" disabled>
                    <?php
                    include '../backend/database_con.php';
                    $query = "SELECT * FROM `mata_kuliah`";
                    $result_matkul = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result_matkul)) {
                        $selected = ($row['matkul_id'] == $data['matkul_id']) ? 'selected' : '';
                        echo "<option value=\"{$row['matkul_id']}\" $selected>{$row['nama_matkul']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="dosen" class="form-label">Dosen</label>
                <select class="form-select" name="dosen" aria-label="Disabled select example" disabled>
                    <?php
                    include '../backend/database_con.php';
                    $query = "SELECT * FROM `dosen`";
                    $result_matkul = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result_matkul)) {
                        $selected = ($row['dosen_id'] == $data['dosen_id']) ? 'selected' : '';
                        echo "<option value=\"{$row['dosen_id']}\" $selected>{$row['nama_dosen']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="ruangan" class="form-label">Ruangan Kelas</label>
                <input type="text" name="ruangan" value="<?= $data['ruang_kelas'] ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <input type="text   " name="hari" value="<?= $data['hari_kelas'] ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="mulai" class="form-label">Muali Kelas</label>
                <input type="time" name="mulai" value="<?= $data['mulai_jam_kelas'] ?>" class="form-control">
            </div>

            <div class="mb-3">
                <label for="berakhir" class="form-label">Berakhir Kelas</label>
                <input type="time" name="akhir" value="<?= $data['akhir_jam_kelas'] ?>" class="form-control">
            </div>
            
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save
                </button>

                <a href="../tampilan_data.php" type="button" class="btn btn-secondary">Kembali</a>
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