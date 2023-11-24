<?php
    $title = "Data Kelas";
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
<body class="d-flex flex-column min-vh-100 text-bg-dark " style="height:100vh">

<?php
    include 'navbar.php'
?>


<div class="container-fluid  p-3 " id="head">   
<!-- <i class="fa-solid fa-sun float-end me-2 float-end" id="toggleDark"></i> -->
<h2 class="text-center">Data Kelas</h2>
</div>

<div class="container text-center">
   
            <a href="kelas/input.php" class="btn btn-primary w-100">Tambahkan Kelas Baru</a>
      
    </div>
<br>
<div class="container">
        <table class="table table-striped table-bordered">
            <thead class="table-info">
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Jurusan</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Jumlah Mahasiswa</th>
                    <th>Ruangan</th>
                    <th>Hari</th>
                    <th>Mulai</th>
                    <th>Berakhir</th>
                    <th class="col-2">Act</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // reading the database
                include 'backend/database_con.php';
                $query = "SELECT * FROM kelas AS k JOIN dosen AS d ON k.dosen_id = d.dosen_id JOIN mata_kuliah AS mk ON k.matkul_id = mk.matkul_id JOIN tabel_jurusan AS j ON k.kode_jurusan = j.kode_jurusan;";
                $exec = mysqli_query($conn, $query);

                
                function banyakSiswa($jmlh){
                    include 'backend/database_con.php';
                    $jmlhQry = "SELECT COUNT(*) AS jumlah_mahasiswa FROM mahasiswa_kelas WHERE kelas_id = '$jmlh';";
                    $ekses = mysqli_query($conn, $jmlhQry);
                    $datas = mysqli_fetch_assoc($ekses);
                    return $datas['jumlah_mahasiswa'];
                }
                
                $i = 1;
                if(mysqli_num_rows($exec) == 0){
                    echo '<tr><td class="no-data-cell text-center" colspan="12">There are no data</td></tr>';
                } else 
                    while($data = mysqli_fetch_assoc($exec)){
                        
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data['kelas_id']) ?></td>
                <td><?= htmlspecialchars($data['nama_jurusan']) ?></td>
                <td><?= htmlspecialchars($data['nama_matkul']) ?></td>
                <td><?= htmlspecialchars($data['nama_dosen']) ?></td>
                <td class="text-center "><a class="btn btn-secondary btn-outline-primary text-white w-50" style="" href="kelas/lihat_kelas.php?kelasid=<?= $data['kelas_id'] ?>"><?= banyakSiswa($data['kelas_id']) ?></a></td>
                <td><?= htmlspecialchars($data['ruang_kelas']) ?></td>
                <td><?= htmlspecialchars($data['hari_kelas']) ?></td>
                <td><?= htmlspecialchars($data['mulai_jam_kelas']) ?></td>
                <td><?= htmlspecialchars($data['akhir_jam_kelas']) ?></td>
                
                <td>
                <a href="kelas/edit_kelas.php?kelas_id=<?= $data['kelas_id'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                <input type="hidden" class="value_delete_id" value="<?= $data['kelas_id'] ?>">
                <input type="hidden" class="value_nama_kelas" value="<?= $data['kelas_id'] ?>">
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
include "footer.php"
?>
</body>
    <script>
    $(document).ready(function () {

        $('.delete_btn').click(function (e) { 
            e.preventDefault();
            
            var deleteValue = $(this).closest("tr").find('.value_delete_id').val();
            var namaKelas = $(this).closest("tr").find('.value_nama_dosen').val();
            // console.log(deleteValue);

            Swal.fire({
            title: 'Apa anda yakin ingin menghapus data kelas ini?',
            text: namaKelas,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
            }).then((result) => { 
            if (result.isConfirmed) {
                $.ajax({
                type: "POST",
                url: "kelas/delete_kelas.php",
                data: {
                    "delete_button_set": 1,
                    "delete_id": deleteValue
                },
                success: function (response) {
                    Swal.fire({
                        title: "Data kelas Berhasil Dihapus!",
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
