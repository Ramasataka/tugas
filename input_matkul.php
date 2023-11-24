<?php
    $title = "Mata Kuliah";
    include "head.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:index.php"); 
    }
?>
<style>
    td {
        color: white !important;
    
    }   
</style>
<body class="d-flex flex-column min-vh-100 bg-dark">
    <?php
        include 'navbar.php';
    ?>

<div class="container-fluid p-3" id="head">
    <!-- <i class="fa-solid fa-sun float-end me-2 float-end" id="toggleDark"></i> -->
    <h2 class="text-center text-white">Data Mata Kuliah</h2>
</div>

    <!-- Modal -->
    <div class="modal fade" id="matkulModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Tambahkan Data Mata Kuliah Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="mt" class="form-label">Matkul Id</label>
                <input type="number"  name="matkul_id" class="form-control" id="validationCustom01" required>
                    <div class="invalid-feedback">
                        Please enter a valid number (numeric characters only).
                    </div>
            </div>

            <div class="mb-3">
                <label for="n_mk" class="form-label">Nama matakuliah</label><br>
                <input type="text" name="nama_matkul" class="form-control" id="nama" id="validationCustom02" required pattern="[A-Z a-z ]+">
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
            </div>
            
            <div class="mb-3">
                <label for="sks" class="form-label">sks</label><br>
                <input type="number"  name="sks" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
            </div>

            <div class="mb-3">

                <label for="kode_jurusan" class="form-label">Jurusan</label>
                <select class="form-select" id="validationCustom03" name="jurusan" required>
                    <?php
                        include 'backend/database_con.php';
                        $query = "SELECT * FROM tabel_jurusan";
                        $result_jurusan = mysqli_query($conn, $query);
                    ?>
                    <option value="" hidden="hidden">Pilih Jurusan</option>
                    <?php while ($data = mysqli_fetch_assoc($result_jurusan)) { ?>
                    <option value="<?php echo $data['kode_jurusan']; ?>"> <?php echo $data['nama_jurusan'];?> </option>
                    <?php } ?>
                </select>
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" name="simpan_data" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </form>
        </div>
    </div>
    </div>
    </div>


    <br>
     <!-- Button trigger modal -->
     <div class="container text-center">
        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#matkulModal">
            Tambahkan Data Mata Kuliah
        </button>
    </div>

    <br>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead class="table-info">
                <tr>
                    <th>No</th>
                    <th>Matkul ID</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Jurusan</th>
                    <th class="col-2">Act</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
                include 'backend/database_con.php';
                $query_view = "SELECT mata_kuliah.*, tabel_jurusan.nama_jurusan FROM mata_kuliah
                                JOIN tabel_jurusan ON mata_kuliah.kode_jurusan = tabel_jurusan.kode_jurusan";
                $result_view = mysqli_query($conn, $query_view);
                
                
                $i = 1;
                if(mysqli_num_rows($result_view) == 0){
                    echo '<tr><td class="no-data-cell" colspan="5">There are no data</td></tr>';
                } else 
                while ($data_matkul = mysqli_fetch_assoc($result_view)) {
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data_matkul['matkul_id']) ?></td>
                <td><?= htmlspecialchars($data_matkul['nama_matkul']) ?></td>
                <td><?= htmlspecialchars($data_matkul['sks']) ?></td>
                <td><?= htmlspecialchars($data_matkul['nama_jurusan']) ?></td>
                <td>
                <a href="mata_kuliah/edit_matkul.php?matkul_id=<?= $data_matkul['matkul_id'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                <input type="hidden" class="value_delete_id" value="<?= $data_matkul['matkul_id'] ?>">
                <input type="hidden" class="value_nama_matkul" value="<?= $data_matkul['nama_matkul'] ?>">
                <a href="javascript:void(0)" class="delete_btn"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                </td>
            </tr>
            <?php
            $i++;
            } ?>    
            </tbody>
        </table>
    </div>

    <?php 
        include "footer.php";
    ?>

</body>
<script>
    $(document).ready(function () {

        $('.delete_btn').click(function (e) { 
            e.preventDefault();
            
            var deleteValue = $(this).closest("tr").find('.value_delete_id').val();
            var namaMatkul = $(this).closest("tr").find('.value_nama_matkul').val();
            // console.log(deleteValue);

            Swal.fire({
            title: 'Apa anda yakin ingin menghapus mata kuliah ini ini?',
            text: namaMatkul,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: "POST",
                url: "mata_kuliah/delete.php",
                data: {
                    "delete_button_set": 1,
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

    
(() => {
  'use strict'

  // Fetch all the forms 
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
<?php
if (isset($_POST['simpan_data'])){
    include 'mata_kuliah/proses.php';
}
?>
</html>


