<?php
$title = 'Input Kelas';
 include "../head.php";
 session_start();
 if(!isset($_SESSION['username'])){
    header("location:../index.php"); 
}
?>

<style>
#shadow{

    box-shadow: 10px 10px 5px 12px black;
}

</style>

<body class="bg-dark bg-opacity-75">

<div id="shadow" class="container mt-5 border border-dark w-50 bg-white shadow-lg p-3 mb-5 bg-body rounded">
    <?php
    include '../backend/database_con.php';

    if (!isset($_POST['submitJurusan']) && !isset($_POST['submitMatkul']) && !isset($_POST['submitDosen'])) {
        $query = "SELECT * FROM `tabel_jurusan`";
        $result_jurusan = mysqli_query($conn, $query);
        ?>
        <form method="post" class="needs-validation" novalidate>
            <h2 class = "text-center">Step 1: <br>Pilih Jurusan</h2>
            <hr>
            <div class="form-group">
                <select class="form-select" id="validationCustom03" name="jurusan" required>
                    <option value="" hidden="hidden">Pilih Jurusan</option>
                    <?php while ($data = mysqli_fetch_assoc($result_jurusan)) { ?>
                        <option value="<?php echo $data['kode_jurusan']; ?>"><?php echo $data['nama_jurusan']; ?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Please select a valid Jurusan.</div>
                <hr>
                <div class="d-flex justify-content-center">
            <button type="submit" name="submitJurusan" class="btn btn-primary">Next</button>
            <a href="../tampilan_data.php" class="btn btn-secondary ms-1">Kembali</a>
            </div>
        </form>
    <?php } ?>

    <?php
    if (isset($_POST['submitJurusan']) && !isset($_POST['submitMatkul']) && !isset($_POST['submitDosen'])) {
        $selectedJurusan = $_POST['jurusan'];
        $query_matkul = "SELECT * FROM `mata_kuliah` WHERE kode_jurusan = '$selectedJurusan'";
        $result_matkul = mysqli_query($conn, $query_matkul);
        ?>
        <form method="post" class="needs-validation" novalidate>
            <h2 class="text-center">Step 2: <br> Select Matkul</h2>
            <hr>
            <div class="form-group">
                <select class="form-select" id="validationCustom03" name="matkul" required>
                    <option value="" hidden="hidden">Pilih Matkul</option>
                    <?php while ($data = mysqli_fetch_assoc($result_matkul)) { ?>
                        <option value="<?php echo $data['matkul_id']; ?>"><?php echo $data['nama_matkul']; ?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Please select a valid Matkul.</div>
            </div>
            <hr>
            <div class="d-flex justify-content-center mb-2">
                <input type="hidden" name="selectedJurusan" value="<?php echo $selectedJurusan; ?>">
                <button type="submit" name="submitMatkul" class="btn btn-primary">Next</button>
                <a href="../tampilan_data.php" class="btn btn-secondary ms-1">Kembali</a>
            </div>

        </form>
    <?php } ?>

    <?php
    if (isset($_POST['submitMatkul']) && !isset($_POST['submitDosen'])) {
        $selectedMatkul = $_POST['matkul'];
        $query = "SELECT * FROM `dosen` WHERE matkul_id = '$selectedMatkul'";
        $result_dosen = mysqli_query($conn, $query);
        ?>
        <form method="post" class="needs-validation" novalidate>
            <h2 class="text-center">Step 3: <br> Select Dosen</h2>
            <hr>
            <div class="form-group">
                <select class="form-select" id="validationCustom03" name="dosen" required>
                    <option value="" hidden="hidden">Pilih Dosen</option>
                    <?php while ($data = mysqli_fetch_assoc($result_dosen)) { ?>
                        <option value="<?php echo $data['dosen_id']; ?>"><?php echo $data['nama_dosen']; ?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Please select a valid Dosen.</div>
            </div>
            <br>
            <div class="mb-3">
                <label for="kelas_id" class="form-label">Kelas ID</label>
                <input type="text" name="kelas_id" class="form-control" id="validationCustom07"  required>
                <div class="invalid-feedback">Inputkan Ruangan Yang valid</div>
            </div>

            <div class="mb-3">
                <label for="ruang" class="form-label">Ruangan Kelas</label>
                <input type="text" name="ruang" class="form-control" id="validationCustom07"  required>
                <div class="invalid-feedback">Inputkan Ruangan Yang valid</div>
            </div>

             <div class="mb-3">
                <label for="" class="form-label">Hari</label>
                <input type="text" name="hari" class="form-control" id="validationCustom07"  required >
                <div class="invalid-feedback">Inputkan Hari</div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Mulai Kelas</label>
                <input type="time" name="jam_awal" class="form-control" id="validationCustom07"  required>
                <div class="invalid-feedback">Inputkan jam Yang valid</div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Jam berakhir kelas</label>
                <input type="time" name="jam_akhir" class="form-control" id="validationCustom07"  required>
                <div class="invalid-feedback">Inputkan jam Yang valid</div>
            </div>

            <hr>
            <div class="d-flex justify-content-center mb-2">
                <input type="hidden" name="selectedJurusan" value="<?php echo $_POST['selectedJurusan']; ?>">
                <input type="hidden" name="selectedMatkul" value="<?php echo $selectedMatkul; ?>">
                <button type="submit" name="submitDosen" class="btn btn-primary">Simpan</button>
                <a href="../tampilan_data.php" class="btn btn-secondary ms-1">Kembali</a>
            </div>
        </form>
    <?php } ?>

    <?php
    if (isset($_POST['submitDosen'])) {
        include 'proses.php';
    }?>
</div>



</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>



