const produkList = [
  {
    nama: "Kaligrafi Syahadat",
    kategori: "kaligrafi",
    gambar: "assets/kaligrafi.jpg",
    deskripsi: "Kaligrafi syahadat terbuat dari kayu jati",
    harga: "Rp 250.000",
  },
  {
    nama: "Kaligrafi Allah & Muhammad",
    kategori: "kaligrafi",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi:
      "Kaligrafi Allah SWT & Nabi Muhammad SAW cocok untuk ditempel di dinding rumah",
    harga: "Rp 90.000",
  },
  {
    nama: "Nomor Rumah",
    kategori: "sign",
    gambar: "assets/nomorrumah.jpg",
    deskripsi: "Tanda nomor rumah dengan bentuk yang bisa di custom",
    harga: "Rp 450.000",
  },
  {
    nama: "Papan Peringatan",
    kategori: "sign",
    gambar: "assets/tanda.jpg",
    deskripsi: "Tanda peringatan aesthetic dengan bentuk yang bisa di custom",
    harga: "Rp 450.000",
  },
  {
    nama: "Papan Pernikahan",
    kategori: "sign",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi: "Masukkan Deskripsi Produk yang ditampilkan",
    harga: "Rp 450.000",
  },
  {
    nama: "Rak Hias",
    kategori: "dekorasi",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi: "Masukkan Deskripsi Produk yang ditampilkan",
    harga: "Rp 300.000",
  },
  {
    nama: "Pigora",
    kategori: "dekorasi",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi: "Masukkan Deskripsi Produk yang ditampilkan",
    harga: "Rp 300.000",
  },
  {
    nama: "Standing wood",
    kategori: "lainnya",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi: "Masukkan Deskripsi Produk yang ditampilkan",
    harga: "Rp 300.000",
  },
  {
    nama: "Plakat",
    kategori: "lainnya",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi: "Masukkan Deskripsi Produk yang ditampilkan",
    harga: "Rp 300.000",
  },
  {
    nama: "Mahar",
    kategori: "lainnya",
    gambar: "assets/kaligrafi1.jpg",
    deskripsi: "Masukkan Deskripsi Produk yang ditampilkan",
    harga: "Rp 300.000",
  },
];

function tampilkanProduk(list) {
  const container = document.getElementById("produkContainer");
  container.innerHTML = "";

  list.forEach((item) => {
    container.innerHTML += `
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
          <img src="${item.gambar}" class="card-img-top" alt="${item.nama}">
          <div class="card-body text-center">
            <h6 class="card-title">${item.nama}</h6>
            <p class="text-success fw-bold">${item.harga}</p>
            <button class="btn btn-outline-success btn-sm" onclick='bukaDetailProduk(${JSON.stringify(
              item
            )})'>Lihat Detail</button>
          </div>
        </div>
      </div>
    `;
  });
}

function bukaDetailProduk(item) {
  document.getElementById("modalNama").textContent = item.nama;
  document.getElementById("modalGambar").src = item.gambar;
  document.getElementById("modalHarga").textContent = item.harga;
  document.getElementById("modalDeskripsi").textContent =
    "Deskripsi: " + item.deskripsi;
  document.getElementById("modalKategori").textContent =
    "Kategori: " + item.kategori;

  const modal = new bootstrap.Modal(document.getElementById("detailModal"));
  modal.show();
}

function filterProduk(kategori) {
  if (kategori === "all") {
    tampilkanProduk(produkList);
  } else {
    const filtered = produkList.filter((p) => p.kategori === kategori);
    tampilkanProduk(filtered);
  }
}

window.onload = () => tampilkanProduk(produkList);
