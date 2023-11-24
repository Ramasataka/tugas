<?php
    $title = "Data Jurusan";
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
        include 'navbar.php'
    ?>

    <div class="container-fluid p-3" id="head">
    <!-- <i class="fa-solid fa-sun float-end me-2 float-end" id="toggleDark"></i> -->
    <h2 class="text-center text-white">Data Jurusan</h2>
</div>

    <!-- Modal -->
    <div class="modal fade" id="registrasionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Tambahkan Data Jurusan Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nim" class="form-label">Kode Jurusan</label>
                <input type="number" name="kode_jurusan" class="form-control" id="validationCustom01" required>
                <div class="invalid-feedback">
                    Please enter a valid number (numeric characters only).
                </div>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" class="form-control" id="nama" id="validationCustom02" required pattern="[A-Z a-z ]+">
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
        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#registrasionModal">
            Tambahkan Data Jurusan
        </button>
    </div>

    <br>
    <div class="container">
        <table class="table table-striped table-bordered text-white">
            <thead class="table-info">
                <tr>
                    <th>NO</th>
                    <th>Kode Jurusan</th>
                    <th>Nama Jurusan</th>
                    <th class="col-2">Act</th>
                </tr>
            </thead>
            <tbody class="text-white">
            <?php
            //reading the database
                include 'backend/database_con.php';
                $query = "SELECT * FROM `tabel_jurusan`";
                $exec = mysqli_query($conn, $query);

                $i = 1;
                if(mysqli_num_rows($exec) == 0){
                    echo '<tr><td class="no-data-cell" colspan="5">There are no data</td></tr>';
                } else 
                    while($data = mysqli_fetch_assoc($exec)){
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data['kode_jurusan']) ?></td>
                <td><?= htmlspecialchars($data['nama_jurusan']) ?></td>
                <td>
                <a href="edit_jurusan.php?kode_jurusan=<?= $data['kode_jurusan'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                <input type="hidden" class="value_delete_id" value="<?= $data['kode_jurusan'] ?>">
                <input type="hidden" class="value_nama_mhs" value="<?= $data['nama_jurusan'] ?>">
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  

</body  >
<script>
    $(document).ready(function () {

        $('.delete_btn').click(function (e) { 
            e.preventDefault();
            
            var deleteValue = $(this).closest("tr").find('.value_delete_id').val();
            var namaMhs = $(this).closest("tr").find('.value_nama_mhs').val();
            // console.log(deleteValue);

            Swal.fire({
            title: 'Apa anda yakin ingin menghapus data jurusan ini?',
            text: namaMhs,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: "POST",
                url: "backend/delete_jurusan.php",
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
    include 'backend/proses_jurusan.php';
}
?>
</html>