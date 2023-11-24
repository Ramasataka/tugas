<!DOCTYPE html>

<?php 
  include 'backend/database_con.php';
session_start();
if(!isset($_SESSION['username'])){
  header("location:index.php"); 
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard WIR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style type="text/css">
    #mainbody {
        height: 100%;
        box-shadow: 0 4px 8px 0 black, 0 6px 20px 0 black;
    }
    table {
        border-radius: 9px;
        
    }

    td{
      color : white;
    }

    
    .colll{
      width: 50px !important;
    }

    .well {
    background: none;
    height: 320px;
    }

    /* .container {
        position: relative;
    } */

    
    
    .table-scroll {
       
        overflow-y: scroll;
        height: 250px;
        overflow-x: hidden;
    }

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
  height: 420px;
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
<body>

    

    <main class="d-flex d-flex flex-row text-bg-dark";>



        <!-- sidebar -->
        <div id="mainbody" class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark " style="width: 280px; height: 100vh;">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
              <svg class="bi pe-none me-2" width="40" height="32"></svg>
              <span class="fs-4">Side Menu</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                  <svg class="bi pe-none me-2" width="16" height="16"></svg>
                  Home
                </a>
              </li>
              <li>
                <a href="mahasiswa.php" class="nav-link text-white">
                  <svg class="bi pe-none me-2" width="16" height="16"></svg>
                  Mahasiswa
                </a>
              </li>
              <li>
                <a href="jurusan.php" class="nav-link text-white">
                  <svg class="bi pe-none me-2" width="16" height="16"></svg>
                  Jurusan
                </a>
              </li>
              <li>
                <a href="data_dosen.php" class="nav-link text-white">
                  <svg class="bi pe-none me-2" width="16" height="16"></svg>
                  Dosen
                </a>
              </li>
              <li>
                <a href="input_matkul.php" class="nav-link text-white">
                  <svg class="bi pe-none me-2" width="16" height="16"></svg>
                  Mata Kuliah
                </a>
              </li>
              <li>
                <a href="tampilan_data.php" class="nav-link text-white">
                  <svg class="bi pe-none me-2" width="16" height="16"></svg>
                  Kelas
                </a>
              </li>
            </ul>
            
            
            <hr class="mt-4">
            <div class="dropdown">
              
              <ul class="d-flex justify-content-center list-unstyled d-flex ">
                <li class="ms-3 fs-5"><a class="text-decoration-none link-secondary text-body-secondary fa-brands fa-x-twitter" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
                <li class="ms-3 fs-5"><a class="text-decoration-none link-secondary text-body-secondary fa-brands fa-instagram" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
                <li class="ms-3 fs-5"><a class="text-decoration-none link-secondary text-body-secondary fa-brands fa-facebook" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
              </ul>
            </div>
          </div>
          <!-- sidebar -->


        <!-- tabel mahasiswa -->

  

          <div class="container">
            <h1 class="m-3">DASHBOARD</h1>
            <form action="system/logoutSystem.php" method="post">
              <input type="submit" name="keluar" value="KELUAR WIR">
          </form>

          <h1> SELAMAT DATANG KEMBALI <?=$_SESSION['username'] ?></h1>
            <div class="container mb-3">

        

        <div class="d-flex flex-col justify-content-between mb-4">
          <div class="card bg-info " style="width: 24rem;">
          <?php 
            $sel_mhs = "SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa";
            $res_mhs = mysqli_query($conn, $sel_mhs);
            $row_mhs = mysqli_fetch_assoc($res_mhs);
          ?>
            <div class="d-flex justify-content-between">
              
              <div class="justify-content-start">
                <h1 class="ms-4" style="font-size:120px"><?= $row_mhs['total_mahasiswa'] ?> </h1>
                <p class="ms-4">TOTAL MAHASISWA</p>
              </div>
              <i class="fa-solid fa-user-group m-4" style="font-size:100px"></i>
            </div>
          </div>
  
          <div class="card bg-info " style="width: 24rem;">
          <?php 
            $sel_dsn = "SELECT COUNT(*) AS total_dosen FROM dosen";
            $res_dsn = mysqli_query($conn, $sel_dsn);
            $row_dsn = mysqli_fetch_assoc($res_dsn);
          ?>
            <div class="d-flex justify-content-between">
              
              <div class="justify-content-start">
                <h1 class="ms-4" style="font-size:120px"><?= $row_dsn['total_dosen'] ?>  </h1>
                <p class="ms-4">TOTAL DOSEN</p>
              </div>
              <i class="fa-solid fa-school m-4" style="font-size:100px"></i>
            </div>
          </div>
  
          <div class="card bg-info " style="width: 24rem;">
          <?php 
            $sel_jrs = "SELECT COUNT(*) AS total_jurusan FROM tabel_jurusan";
            $res_jrs = mysqli_query($conn, $sel_jrs);
            $row_jrs = mysqli_fetch_assoc($res_jrs);
          ?>
            <div class="d-flex justify-content-between">
              
              <div class="justify-content-start">
                <h1 class="ms-4" style="font-size:120px"><?= $row_jrs['total_jurusan'] ?>  </h1>
                <p class="ms-4">TOTAL JURUSAN</p>
              </div>
              <i class="fa-solid fa-graduation-cap m-4" style="font-size:100px"></i>
            </div>
          </div>
          
        </div>

        <hr>
        <div class="d-flex flex-col justify-content-between"  >
          
          <div class="table-scroll " style="width:60%" >

            <table class="table table-bordered rounded-3 me-4 " >
                <thead class="table-info ">
                    <tr class="">
                        
                        <th>NIM</th>
                        <th class="col-3">Nama Mahasiswa</th>
                        <th>Jurusan</th>
                        
                       
                        <th>Email</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody class="warna "> 
                <tr >
                <?php 
                //reading the database 
                    
                    $query = "SELECT * FROM `mahasiswa` AS m JOIN tabel_jurusan as j ON m.kode_jurusan = j.kode_jurusan";
                    $exec = mysqli_query($conn, $query);
    
                    $i = 1;
                    if(mysqli_num_rows($exec) == 0){
                        echo '<tr><td class="no-data-cell" colspan="9">There are no data</td></tr>';
                    } else 
                        while($data = mysqli_fetch_assoc($exec)){
                ?>
                    
                    <td class="col-xs-3"><?= htmlspecialchars($data['nim']) ?></td>
                    <td class="col-xs-3"><?= htmlspecialchars($data['nama_mhs']) ?></td>
                    <td class="col-xs-3"><?= $data['nama_jurusan'] ?></td>
                    
                    
                    <td class="col-xs-3"><?= htmlspecialchars($data['email']) ?></td>
                    <td class="col-xs-3"><?= htmlspecialchars($data['alamat']) ?></td>
                    
                </tr>
                <?php
                $i++;
                } ?>    
                </tbody>
            </table>
              </div>
              <div class="table-scroll" style="width:40%" >

              <table class="table table-bordered ">
                <thead class="table-info">
                    <tr>
                        
                        <th>Nama Dosen</th>
                        <th>Email</th>
                        
                        <th>Mata Kuliah</th>
                        
                    </tr>
                </thead>
                <tbody class="warna">
                <?php
                //reading the database 
                   
                    $query_dosen = "SELECT * FROM `dosen` as d join mata_kuliah as mk on d.matkul_id = mk.matkul_id";
                    $exec_dosen = mysqli_query($conn, $query_dosen);
    
                    $i = 1;
                    if(mysqli_num_rows($exec_dosen) == 0){
                        echo '<tr><td class="no-data-cell text-center" colspan="7">There are no data</td></tr>';
                    } else 
                        while($data_dosen = mysqli_fetch_assoc($exec_dosen)){
                ?>
                <tr>
                    
                    <td class="colll"><?= htmlspecialchars($data_dosen['nama_dosen']) ?></td>
                    <td class="colll"><?= htmlspecialchars($data_dosen['email']) ?></td>
                        
                    <td class="colll"><?= htmlspecialchars($data_dosen['nama_matkul']) ?></td>
                    
                    
                </tr>
                <?php
                $i++;
                } ?>    
                </tbody>
            </table>
          </div>
        </div>


        </div>
          <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center border-top">
              <div class="col-md-4 d-flex align-items-center">
                
                <span class="text-body-secondary">© 2023 Company, Inc All rights reserved</span>
              </div>

              
            </footer>
          </div>
        </div>
                
        </div>
       
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
