<?php
    $title = "Data dosen";
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
    .well {
    background: none;
    height: 320px;
    }

    /* .container {
        position: relative;
    } */

    


   .table-scroll tr {
       width: 100%;
       table-layout: fixed;
       
   }

   .table-scroll thead > tr > th {
       border: none;
   }

   .table-scroll {
 scrollbar-width: thin;
 scrollbar-color: transparent transparent;
 overflow-y: scroll;
 height: 500px;
}

/* custom scrollbar styles */
.table-scroll::-webkit-scrollbar {
  width: 12px;
}

.table-scroll::-webkit-scrollbar-thumb {
  background: transparent; 
  border-radius: 6px; 
}

.table-scroll::-webkit-scrollbar-track {
  background: transparent;
}
</style>

<body class="d-flex flex-column min-vh-100 bg-dark">
    <?php
        include 'navbar.php';
    ?>

<div class="container-fluid p-3" id="head">
    <h2 class="text-center text-white">Data Dosen</h2>
</div>

<!-- Modal -->
<div class="modal fade" id="matkulModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Tambahkan Data Dosen Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="mt" class="form-label">Dosen Id</label>
                <input type="number"  name="dosen_id" class="form-control" id="validationCustom01" required>
                    <div class="invalid-feedback">
                        Please enter a valid number (numeric characters only).
                    </div>
            </div>

            <div class="mb-3">
                <label for="n_mk" class="form-label">Nama Dosen</label><br>
                <input type="text" name="nama_dosen" class="form-control" id="nama" id="validationCustom02" required pattern="[A-Z a-z ]+">
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label><br>
                <input type="email"  name="email" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
            </div>

            <div class="mb-3">
                <label for="no" class="form-label">NO HP</label><br>
                <input type="number"  name="no_hp" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
            </div>

            <div class="mb-3">

                <label for="matkul" class="form-label">Mata Kuliah</label>
                <select class="form-select" id="validationCustom03" name="mata_kuliah" required>
                    <?php
                        include 'backend/database_con.php';
                        $query_matkul = "SELECT * FROM mata_kuliah";
                        $result_matkul = mysqli_query($conn, $query_matkul);
                    ?>
                    <option value="" hidden="hidden">Pilih Jurusan</option>
                    <?php while ($data_matkul = mysqli_fetch_assoc($result_matkul)) { ?>
                    <option value="<?php echo $data_matkul['matkul_id']; ?>"> <?php echo $data_matkul['nama_matkul'];?> </option>
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
            Tambahkan Data Dosen
        </button>
    </div>
    <br>


<div class="container table-scroll">
        <table class="table table-striped table-bordered">
            <thead class="table-info">
                <tr>
                    <th>NO</th>
                    <th>Dosen ID</th>
                    <th>Nama Dosen</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Mata Kuliah</th>
                    <th class="col-2">Act</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // reading the database 
                include 'backend/database_con.php';
                $query = "SELECT * FROM `dosen` as d join mata_kuliah as mk on d.matkul_id = mk.matkul_id";
                $exec = mysqli_query($conn, $query);

                $i = 1;
                if(mysqli_num_rows($exec) == 0){
                    echo '<tr><td class="no-data-cell text-center" colspan="7">There are no data</td></tr>';
                } else 
                    while($data = mysqli_fetch_assoc($exec)){
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data['dosen_id']) ?></td>
                <td><?= htmlspecialchars($data['nama_dosen']) ?></td>
                <td><?= htmlspecialchars($data['email']) ?></td>
                <td><?= htmlspecialchars($data['no_hp']) ?></td>
                <td><?= htmlspecialchars($data['nama_matkul']) ?></td>
                
                <td>
                <a href="dosen/edit.php?dosen_id=<?= $data['dosen_id'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                <input type="hidden" class="value_delete_id" value="<?= $data['dosen_id'] ?>">
                <input type="hidden" class="value_nama_dosen" value="<?= $data['nama_dosen'] ?>">
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
            var namadosen = $(this).closest("tr").find('.value_nama_dosen').val();
            // console.log(deleteValue);

            Swal.fire({
            title: 'Apa anda yakin ingin menghapus data dosen ini?',
            text: namadosen,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                type: "POST",
                url: "dosen/delete.php",
                data: {
                    "delete_button_set": 1,
                    "delete_id": deleteValue
                },
                success: function (response) {
                    Swal.fire({
                        title: "Data Dosen Berhasil Dihapus!",
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
    include 'dosen/proses.php';
}
?>
</html>








