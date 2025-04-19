<?php
// Konfigurasi pagination
$testimoniPerHalaman = 5;
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$mulai = ($halaman > 1) ? ($halaman * $testimoniPerHalaman) - $testimoniPerHalaman : 0;

session_start();

// Proses penyimpanan form jika ada data POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST["nama"]);
    $instansi = htmlspecialchars($_POST["instansi"]);
    $pesan = htmlspecialchars($_POST["pesan"]);

    $baris = "$nama|$instansi|$pesan\n";
    file_put_contents("testimoni.txt", $baris, FILE_APPEND);

    // Simpan status sukses di session
    $_SESSION['sukses'] = true;

    // Redirect ke GET (hindari resubmission saat refresh)
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Testimoni | Kayoo.id</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold text-success" href="#">Kayoo.id</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link text-success" href="index.html">Beranda</a></li>
          <li class="nav-item"><a class="nav-link text-success" href="about.html">Tentang</a></li>
          <li class="nav-item"><a class="nav-link text-success" href="produk.html">Produk</a></li>
          <li class="nav-item"><a class="nav-link active" href="#">Testimoni</a></li>
          <li class="nav-item"><a class="nav-link text-success" href="pesan.html">Pesan</a></li>
          <li class="nav-item"><a class="nav-link text-success" href="kontak.html">Kontak</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten -->
  <div class="container my-5">
    <h2 class="text-center fw-bold mb-4">Testimoni Pengguna</h2>

    <?php if (isset($_SESSION['sukses'])): ?>
  <div class="alert alert-success text-center">Testimoni berhasil dikirim!</div>
  <?php unset($_SESSION['sukses']); ?>
<?php endif; ?>


    <!-- Tabel Testimoni -->
    <div class="table-responsive mb-4">
       <table class="table table-striped table-bordered align-middle">
         <thead class="table-success text-center">
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 20%;">Nama</th>
            <th style="width: 20%;">Instansi</th>
            <th style="width: 60%;">Pesan</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $file = 'testimoni.txt';
            if (file_exists($file)) {
                $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $total = count($lines);

                if ($total > 0) {
                    $tampil = array_slice(array_reverse($lines), $mulai, $testimoniPerHalaman);
                    $no = $mulai + 1; // nomor dimulai dari posisi saat ini

                    if (count($tampil) > 0) {
                        foreach ($tampil as $line) {
                            list($nama, $instansi, $pesan) = explode('|', $line);
                            echo "<tr>
                                    <td class='text-center'>$no</td>
                                    <td>$nama</td>
                                    <td>$instansi</td>
                                    <td>$pesan</td>
                                  </tr>";
                            $no++;
                        }
                    } 
                  } else {
                      echo "<tr><td colspan='4' class='text-center'>Belum ada testimoni.</td></tr>";
                  }
              } else {
                  echo "<tr><td colspan='4' class='text-center'>Belum ada testimoni.</td></tr>";
            }
            ?>
        </tbody>

      </table>
    </div>

    <!-- Pagination -->
    <?php if (isset($total) && $total > $testimoniPerHalaman): ?>
      <nav class="d-flex justify-content-center">
        <ul class="pagination">
          <?php
          $jumlahHalaman = ceil($total / $testimoniPerHalaman);
          for ($i = 1; $i <= $jumlahHalaman; $i++) {
              echo '<li class="page-item ' . ($i == $halaman ? 'active' : '') . '">
                      <a class="page-link" href="?halaman=' . $i . '">' . $i . '</a>
                    </li>';
          }
          ?>
        </ul>
      </nav>
    <?php endif; ?>

    <!-- Garis pembatas -->
    <div class="section-border"></div>

    <!-- Form Testimoni -->
    <div class="card shadow p-4">
      <h4 class="mb-4 text-center">Tulis Testimoni Anda</h4>
      <form method="POST" action="">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" required />
        </div>
        <div class="mb-3">
          <label for="instansi" class="form-label">Instansi</label>
          <input type="text" class="form-control" id="instansi" name="instansi" required />
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan Testimoni</label>
          <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
        </div>
        <div>
          <button type="submit" class="btn btn-success">Kirim Testimoni</button>
        </div>
      </form>
    </div>
  </div>

    <footer>
      <p>&copy; 2025 Kayoo.id</p>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
