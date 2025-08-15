<?php
// Koneksi database
include 'admin/koneksi.php';

// Ambil ID dari URL, pastikan integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = intval($_GET['id']);

  // Query portofolio berdasarkan ID
  $query = mysqli_query($koneksi, "SELECT portofolios.*, categories.name AS category_name FROM portofolios JOIN categories ON categories.id = portofolios.id_category
   WHERE portofolios.id = '$id'");

  if (mysqli_num_rows($query) > 0) {
    $portofolio = mysqli_fetch_assoc($query);
  } else {
    // Jika tidak ada data
    echo "<h2>Portofolio tidak ditemukan.</h2>";
    exit;
  }
} else {
  echo "<h2>ID portofolio tidak valid.</h2>";
  exit;
}

// Format tanggal
$date_portofolio = date("M d, Y", strtotime($portofolio['created_at']));
?>

<!-- Page Title -->
<div class="page-title accent-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0"><?php echo $portofolio['title']; ?></h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.html">Home</a></li>
        <li><a href="portofolio.php">Portfolio</a></li>
        <li class="current"><?php echo $portofolio['title']; ?></li>
      </ol>
    </nav>
  </div>
</div><!-- End Page Title -->

<!-- Portfolio Details Section -->
<section id="portfolio-details" class="portfolio-details section">
  <div class="container">

    <div class="row gy-4">

      <!-- Gambar Portofolio -->
      <div class="col-lg-8">
        <div class="portfolio-details-slider swiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="admin/uploads/<?php echo $portofolio['image']; ?>" alt="<?php echo $portofolio['title']; ?>"
                class="img-fluid">
            </div>
            <!-- Tambahkan slide lain jika ada multiple images -->
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <!-- Info Portofolio -->
      <div class="col-lg-4">
        <div class="portfolio-info">
          <h3>Portfolio Information</h3>
          <ul>
            <li><strong>Category</strong>: <?php echo ucfirst($portofolio['category_name']); ?></li>
            <li><strong>Date</strong>: <?php echo $date_portofolio; ?></li>
          </ul>
        </div>
        <div class="portfolio-description">
          <h2><?php echo $portofolio['title']; ?></h2>
          <p><?php echo $portofolio['content']; ?></p>
        </div>
      </div>

    </div>

  </div>
</section><!-- End Portfolio Details Section -->