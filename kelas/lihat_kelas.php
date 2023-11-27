<?php
    $kelas_id = $_GET['kelasid'];
    include "../backend/database_con.php";

    $qry = "SELECT * FROM kelas JOIN mata_kuliah ON kelas.matkul_id = mata_kuliah.matkul_id
    WHERE kelas.kelas_id = '$kelas_id';";

    $exec = mysqli_query($conn, $qry);
    $data = mysqli_fetch_assoc($exec);

    $title = "Data dari Kelas " . $data['kelas_id'];
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
<body class="d-flex flex-column min-vh-100 bg-dark bg-opacity-25">
<div class="container-fluid text-center bg-dark bg-opacity-75 p-3  text-white" id="head">
        <button type="button" class="btn btn-light float-start">
            <a class="p-1"href="../tampilan_data.php"><i class="fs-4 fa-solid fa-arrow-left"></i></a>
        </button>
        <h2>Data dari kelas <br> <?= htmlspecialchars($data['kelas_id']) ?> | <?= $data['nama_matkul'] ?></h2>
    </div>
    <br>
<br>
<div class="container d-flex justify-content-center">
        <table class="table table-striped table-bordered w-75 text-center">
            <thead class="table-dark">
                <tr>
                    <th class="col-1">NO</th>
                    <th class="col-2">NIM</th>
                    <th class="col-4">Mahasiswa yang mengikuti kelas ini</th>
                </tr>
            </thead>
            <tbody>
                <br>
            <?php
            // reading the database 
                include '../backend/database_con.php';
            
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
                            WHERE mahasiswa_kelas.kelas_id = '$kelas_id';";
                
            
                $exec = mysqli_query($conn, $query);

                $i = 1;
                if(mysqli_num_rows($exec) == 0){
                    echo '<tr><td class="no-data-cell" colspan="9">Belum Ada Mahasiswa Terdaftar</td></tr>';
                } else 
                    while($data = mysqli_fetch_assoc($exec)){
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($data['nim']) ?></td>
                <td><?= htmlspecialchars($data['nama_mhs']) ?></td>
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