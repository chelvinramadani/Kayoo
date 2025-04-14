<?php
$filename = 'testimoni.txt';

// Simpan data baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $instansi = $_POST['instansi'];
  $pesan = $_POST['pesan'];
  $tanggal = date('d-m-Y H:i');

  $baris = implode('|', [htmlspecialchars($nama), htmlspecialchars($instansi), htmlspecialchars($pesan), $tanggal]) . PHP_EOL;
  file_put_contents($filename, $baris, FILE_APPEND);
}

// Ambil data dari file
$testimoni = [];
if (file_exists($filename)) {
  $barisArray = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($barisArray as $line) {
    [$nama, $instansi, $pesan, $tanggal] = explode('|', $line);
    $testimoni[] = compact('nama', 'instansi', 'pesan', 'tanggal');
  }
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kayoo.id</title>

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Amiri&family=Noto+Naskh+Arabic&family=Poppins&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="style.css" />
    <style>
    .testimoni-card {
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      background: #fff;
    }
    .avatar-icon {
      font-size: 2rem;
      color: #198754;
    }
    .table thead {
      background-color: #198754;
      color: white;
    }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom"
    >
      <div class="container">
        <a class="navbar-brand fw-bold text-success" href="#">Kayoo.id</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-success" href="index.html">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-success" href="about.html">Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-success" href="produk.html">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="testimoni.php">Testimoni</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-success" href="pesan.html">Pesan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-success" href="kontak.html">Kontak</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Konten -->
<div class="container my-5">
    <div class="d-flex justify-content-center align-items-center mb-4">
      <h2 class="fw-bold">Apa Kata Pelanggan?</h2>

    </div>

    <div class="row g-4 mb-5">
      <?php if (!empty($testimoni)): ?>
        <?php foreach (array_reverse($testimoni) as $t): ?>
          <div class="col-md-6 col-lg-4">
            <div class="testimoni-card h-100">
              <div class="d-flex align-items-start">
                <div class="me-3">
                  <i class="bi bi-person-circle avatar-icon"></i>
                </div>
                <div>
                  <h6 class="mb-1"><?= $t['nama'] ?></h6>
                  <small class="text-muted"><?= $t['instansi'] ?></small><br>
                  <small class="text-muted"><?= $t['tanggal'] ?></small>
                  <p class="mt-2 mb-0"><?= nl2br($t['pesan']) ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      <?php else: ?>
        <p class="text-center text-muted">Belum ada testimoni.</p>
      <?php endif; ?>
    </div>

    <div class="bg-white p-4 rounded shadow-sm">
      <h4 class="mb-3">Tulis Testimoni Anda</h4>
      <form method="POST">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Anda</label>
          <input type="text" name="nama" class="form-control" required />
        </div>
        <div class="mb-3">
          <label for="instansi" class="form-label">Instansi / Perusahaan</label>
          <input type="text" name="instansi" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan / Testimoni</label>
          <textarea name="pesan" rows="4" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Kirim</button>
      </form>
    </div>
  </div>


    <footer>
      <p>&copy; 2025 Kayoo.id</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
