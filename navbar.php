<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<link rel="stylesheet" href="navbar.css">



<div class="container navbar text-bg-dark">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills ">
        <li class="nav-item "><a class="nav-link text-white" id="home-link" data-page="mahasiswa" href="dashboard.php">Home</a></li>
        <li class="nav-item "><a class="nav-link text-white" data-page="mahasiswa" href="mahasiswa.php">Mahasiswa</a></li>
        <li class="nav-item "><a class="nav-link text-white" data-page="jurusan" href="jurusan.php">Jurusan</a></li>
        <li class="nav-item "><a class="nav-link text-white" data-page="matakuliah" href="input_matkul.php">Mata Kuliah</a></li>
        <li class="nav-item "><a class="nav-link text-white" data-page="dosen" href="data_dosen.php">Dosen</a></li>
        <li class="nav-item "><a class="nav-link text-white" data-page="dosen" href="tampilan_data.php">Kelas</a></li>
        <li>
        <form action="system/logoutSystem.php" method="post">
              <input type="submit" name="keluar" value="KELUAR WIR">
          </form>
        </li>
        <!-- <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li> -->
      </ul>
    </header>
    <hr class="">
  </div>
  <script>

// Simpan URL saat ini
var currentURL = window.location.href;

// Ambil semua elemen tautan
var navLinks = document.querySelectorAll(".nav-link");

// Loop melalui elemen-elemen tersebut
for (var i = 0; i < navLinks.length; i++) {
  // Ambil atribut href dari tautan
  var href = navLinks[i].getAttribute("href");
  
  // Periksa apakah URL saat ini mengandung bagian akhir dari URL tautan
  if (currentURL.endsWith(href)) {
    // Tambahkan kelas "active" ke tautan yang sesuai
    navLinks[i].classList.add("active");
  }
}



//   // Simpan URL saat ini
//   var currentURL = window.location.href;

//   // Periksa URL saat ini dengan URL halaman yang sesuai dan tambahkan kelas "active" ke item navbar yang sesuai
//   var navLinks = document.querySelectorAll(".nav-link");

// // Loop melalui elemen-elemen tersebut
// for (var i = 0; i < navLinks.length; i++) {
//   // Periksa apakah URL saat ini mengandung kata yang sesuai dengan teks dalam link
//   if (window.location.href.includes(navLinks[i].textContent.toLowerCase())) {
//     // Tambahkan kelas "active" ke link yang sesuai
//     navLinks[i].classList.add("active");
//   }
// }
</script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
