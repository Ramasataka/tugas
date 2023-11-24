<?php
    $nim = $_GET['nim'];
    include "backend/database_con.php";

    $qry = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $exec = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($exec);

    $title = "Kelasi Dari mahasiswa " . $data['nim'];
    include "head.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:index.php"); 
    }
    ?>
<style>
    *{
        color : white;
    }
        .no-data-cell {
        text-align: center;
    }

    </style>
<body class="d-flex flex-column min-vh-100 bg-dark bg-opacity-25">

    <br>
    <div class="container border border-dark bg-dark bg-opacity-50 w-50">
        <br>
        <h3 class="text-center">Pilih Kelas</h3>
        <hr>
        <form action="#" method="POST">
        <div class="mb-3">
                <label for="nim" class="form-label">Nim</label>
                <input type="number" name="nim" value="<?= $data['nim'] ?>" readonly class="form-control" id="kode_jurusan">
            </div>

            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select" id="validationCustom03" name="kelas" required>
                <?php
                include 'backend/database_con.php';
                $kode_jurusan = $data['kode_jurusan'];
                $query = "SELECT * FROM `kelas` as k JOIN mata_kuliah as mk ON k.matkul_id = mk.matkul_id WHERE k.kode_jurusan = '$kode_jurusan'";
                $result_matkul = mysqli_query($conn, $query);
                ?>
                            <option value="" hidden="hidden">Pilih kelas</option>
                            <?php while ($datas = mysqli_fetch_assoc($result_matkul)) { ?>
                            <option class="text-dark" value="<?php echo $datas['kelas_id']; ?>"><?php echo $datas['kelas_id']; ?> | <?php echo $datas['nama_matkul']; ?></option>
                            <?php } ?>
                </select>
                <div class="invalid-feedback">Please select a valid Jurusan.</div>
            </div>
            
            <div class="mb-3 text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Save
                </button>
                
                <a href="mahasiswa.php" type="button" class="btn btn-light">Kembali</i></a>
            
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
    <div class="modal-content ">
        <div class="modal-body text-center ">
            <h3 class="text-dark">Are you sure to save this data ?</h3>
            <button type="submit" name="simpanData" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>



            </form>
</div>
</div>
<br>
<div class="container d-flex justify-content-center">
        <table class="table table-striped table-bordered w-50 text-center">
            <thead class="table-dark">
                <tr>
                    <th class="col-1">NO</th>
                    <th class="col-4">Kelas Yang Diikuti</th>
                    <th class="col-2">Act</th>
                </tr>
            </thead>
            <tbody>
                <br>
            <?php
            // reading the database 
                include 'backend/database_con.php';
                $nim = $data['nim'];
                $query = "SELECT
                        mahasiswa_kelas.nim,
                        mahasiswa.nama_mhs,
                        mahasiswa_kelas.kelas_id,
                        mata_kuliah.nama_matkul
                        FROM
                            mahasiswa_kelas
                        JOIN
                            mahasiswa ON mahasiswa_kelas.nim = mahasiswa.nim
                        JOIN
                            kelas ON mahasiswa_kelas.kelas_id = kelas.kelas_id
                        JOIN
                            mata_kuliah ON kelas.matkul_id = mata_kuliah.matkul_id
                        WHERE mahasiswa_kelas.nim = $nim;";
                
            
                $exec = mysqli_query($conn, $query);

                $i = 1;
                if(mysqli_num_rows($exec) == 0){
                    echo '<tr><td class="no-data-cell" colspan="9">Mahasiswa Ini Belum menginput Data</td></tr>';
                } else 
                    while($data = mysqli_fetch_assoc($exec)){
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data['kelas_id']) ?> | <?= htmlspecialchars($data['nama_matkul']) ?></td>
                <td>
                <input type="hidden" class="value_delete_id" value="<?= $data['nim'] ?>">
                <input type="hidden" class="value_kelas" value="<?= $data['kelas_id'] ?>">
                <a href="javascript:void(0)" class="delete_btn"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                </td>
            </tr>
            <?php
            $i++;
            } ?>    
            </tbody>
        </table>
    </div>
<br>
    
</body>
<?php
if (isset($_POST['simpanData'])){
    include 'backend/input_kelas.php';
}
?>
</html>

<script>
          $(document).ready(function () {

$('.delete_btn').click(function (e) { 
    e.preventDefault();
    
    var deleteValue = $(this).closest("tr").find('.value_delete_id').val();
    var namaKelas = $(this).closest("tr").find('.value_kelas').val();
    // console.log(deleteValue);

    Swal.fire({
    title: 'Apa anda yakin ingin membatalkan Kelas untuk mahasiswa ini?',
    text: namaKelas,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Batalkan'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
        type: "POST",
        url: "backend/delete_mahasiswa_kelas.php",
        data: {
            "delete_button_set": 1,
            "kelas_id" : namaKelas,
            "delete_id": deleteValue
        },
        success: function (response) {
            Swal.fire({
                title: "Data Delete Berhasil Dihapus!",
                icon: "success",
            }).then((result) => {
                location.reload();
            });
        }
});

    }
    })
});
});

</script>