<?php
    $title = "Data Mahasiswa";
    include "head.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:index.php"); 
    }
?>
    <style type="text/css">
    td {
        color: white !important;
    
    }
     


        .no-data-cell {
        text-align: center;
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
        include 'navbar.php'
    ?>


    <div class="container-fluid  p-3 " id="head">   
    <!-- <i class="fa-solid fa-sun float-end me-2 float-end" id="toggleDark"></i> -->
    <h2 class="text-center text-white">Data Mahasiswa</h2>
</div>



    <!-- Modal -->
    <div class="modal fade" id="registrasionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Tambahkan Data Mahasiswa Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="#" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nim" class="form-label">Nim</label>
                <input type="number" name="nim" class="form-control" id="validationCustom01" required pattern="[0-9]{9}">
                <div class="invalid-feedback">
                    Please enter a valid 9-digit NIM (numeric characters only).
                </div>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" name="nama" class="form-control" id="nama" id="validationCustom02" required>
                    <div class="invalid-feedback">
                        Please enter a valid name
                    </div>
            </div>
            
            <div class="mb-3">
                <label for="kode_jurusan" class="form-label">Jurusan</label>
                <select class="form-select" id="validationCustom03" name="jurusan" required>
                <?php
                include 'backend/database_con.php';
                $query = "SELECT * FROM `tabel_jurusan`";
                $result_jurusan = mysqli_query($conn, $query);
                ?>
                            <option value="" hidden="hidden">Pilih Jurusan</option>
                            <?php while ($data = mysqli_fetch_assoc($result_jurusan)) { ?>
                            <option value="<?php echo $data['kode_jurusan']; ?>"><?php echo $data['nama_jurusan']; ?></option>
                            <?php } ?>
                </select>
                <div class="invalid-feedback">Please select a valid Jurusan.</div>
            </div>
            
            <div class="mb-3">
                <label class="pb-1">Gender</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="validationCustom04" value="1" required>
                    <label class="form-check-label" for="maleRadio">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="validationCustom05" value="2" required>
                    <label class="form-check-label" for="femaleRadio">Perempuan</label>
                </div>
                <div class="invalid-feedback">Please select a gender.</div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="validationCustom06" required>
                <div class="invalid-feedback">Please select a valid Alamat.</div>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No Hp</label>
                <input type="number" name="no_hp" class="form-control" id="validationCustom07"  required pattern="[0-9]{16}">
                <div class="invalid-feedback">Please select a valid Nomer Handphone.</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="validationCustom08" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>
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
            Tambahkan Mahasiswa Baru
        </button>
    </div>
    <br>
    <div class="col-xs-8 col-xs-offset-2 well">
    <div class="container table-scroll">
        <table class="table table-bordered">
            <thead class="table-info">
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th class="col-3">Nama Mahasiswa</th>
                    <th>Jurusan</th>
                    <th class="col-2">Gender</th>
                    <th>Alamat</th>
                    <th class="col-2">No HP</th>
                    <th>Email</th>  
                    <th>Kelas</th>
                    <th class="col-2">Act</th>
                </tr>
            </thead>
            <tbody >
            <?php
            // reading the database
                include 'backend/database_con.php';
                $query = "SELECT * FROM `mahasiswa` AS m JOIN tabel_jurusan as j ON m.kode_jurusan = j.kode_jurusan";
                $exec = mysqli_query($conn, $query);

                $i = 1;
                if(mysqli_num_rows($exec) == 0){
                    echo '<tr><td class="no-data-cell" colspan="9">There are no data</td></tr>';
                } else 
                    while($data = mysqli_fetch_assoc($exec)){
            ?>
            <tr class="text-white">
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data['nim']) ?></td>
                <td ><?= htmlspecialchars($data['nama_mhs']) ?></td>
                <td><?= $data['nama_jurusan'] ?></td>
                <td><?= $data['gender'] == 1 ? "Laki-Laki" : "Perempuan" ?></td>
                <td><?= htmlspecialchars($data['alamat']) ?></td>
                <td><?= htmlspecialchars($data['no_hp']) ?></td>
                <td><?= htmlspecialchars($data['email']) ?></td>
                <td class="text-center"><a class="btn btn-secondary btn-outline-primary text-white" href="formKelas.php?nim=<?= $data['nim'] ?>"><i class="fa-solid fa-chalkboard"></i></a></td>
                <td>
                <a href="edit.php?nim=<?= $data['nim'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                <input type="hidden" class="value_delete_id" value="<?= $data['nim'] ?>">
                <input type="hidden" class="value_nama_mhs" value="<?= $data['nama_mhs'] ?>">
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
        </div>

</body>

<script>
    $(document).ready(function () {

        $('.delete_btn').click(function (e) { 
            e.preventDefault();
            
            var deleteValue = $(this).closest("tr").find('.value_delete_id').val();
            var namaMhs = $(this).closest("tr").find('.value_nama_mhs').val();
            // console.log(deleteValue);

            Swal.fire({
            title: 'Apa anda yakin ingin menghapus data mahasiswa ini?',
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
                url: "backend/delete.php",
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
    include 'backend/regis.php';
}
?>
<!-- <script src="script.js"></script> -->
</html>