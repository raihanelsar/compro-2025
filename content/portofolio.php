<?php
$queryPortofolios = mysqli_query($koneksi, "SELECT * FROM portofolios WHERE is_active = 1 ORDER BY id DESC");
$rowPortofolios  = mysqli_fetch_all($queryPortofolios, MYSQLI_ASSOC);

$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories WHERE type='portofolio' ORDER BY id DESC");
$rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);
?>
<!-- Page Title -->
<div class="page-title accent-background">
  <div class="container d-lg-flex justify-content-between align-items-center">
    <h1 class="mb-2 mb-lg-0">Portfolio</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.html">Home</a></li>
        <li class="current">Portfolio</li>
      </ol>
    </nav>
  </div>
</div>

<section id="portfolio" class="portfolio section">
  <div class="container">
    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
      <!-- Filters -->
      <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
        <li class="filter-active" data-filter="*">All</li>
        <?php foreach ($rowCategories as $rowCategory): ?>
          <li data-filter=".filter-<?php echo $rowCategory['id']; ?>">
            <?php echo htmlspecialchars($rowCategory['name']); ?>
          </li>
        <?php endforeach; ?>
      </ul>

      <!-- Portfolio Items -->
      <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
        <?php foreach ($rowPortofolios as $keyPortofolio): ?>
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?php echo $keyPortofolio['id_category'] ?>">
            <img src="admin/uploads/<?php echo $keyPortofolio['image'] ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $keyPortofolio['title'] ?></h4>
              <p><?php echo htmlspecialchars($keyPortofolio['description'] ?? 'No description'); ?></p>
              <a href="admin/uploads/<?php echo $keyPortofolio['image'] ?>" title="View Image"
                data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="?page=portofolio-detail&id=<?php echo $keyPortofolio['id'] ?>" title="More Details"
                class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>