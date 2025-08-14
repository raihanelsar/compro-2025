<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$image_name = ''; // default kosong
$rowEdit = []; // inisialisasi array kosong agar aman

// Ambil data untuk edit
if (!empty($id)) {
  $query = mysqli_query($koneksi, "SELECT * FROM blogs WHERE id = '$id'");
  $rowEdit = mysqli_fetch_assoc($query) ?? [];
  $titlePage = "Edit Blog";
} else {
  $titlePage = "Tambah Blog";
}

// Hapus data
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $queryGambar = mysqli_query($koneksi, "SELECT id, image FROM blogs WHERE id='$id'");
  $rowGambar = mysqli_fetch_assoc($queryGambar) ?? [];
  $image_name = $rowGambar['image'] ?? '';

  if (!empty($image_name) && file_exists("uploads/" . $image_name)) {
    @unlink("uploads/" . $image_name);
  }

  $delete = mysqli_query($koneksi, "DELETE FROM blogs WHERE id='$id'");
  if ($delete) {
    header("location:?page=blog&hapus=berhasil");
    exit;
  }
}

// Simpan data (insert atau update)
if (isset($_POST['simpan'])) {
  $title = mysqli_real_escape_string($koneksi, $_POST['title'] ?? '');
  $content = mysqli_real_escape_string($koneksi, $_POST['content'] ?? '');
  $is_active = $_POST['is_active'] ?? 0;
  $writer = $_SESSION['NAME'] ?? '';
  $id_category = $_POST['id_category'] ?? '';
  $tags = mysqli_real_escape_string($koneksi, $_POST['tags'] ?? '');


  // Upload gambar jika ada
  if (!empty($_FILES['image']['name'])) {
    $image       = $_FILES['image']['name'];
    $tmp_name    = $_FILES['image']['tmp_name'];
    $type        = mime_content_type($tmp_name);

    $ext_allowed = ["image/png", "image/jpg", "image/jpeg"];

    if (in_array($type, $ext_allowed)) {
      $path = "uploads/";
      if (!is_dir($path)) mkdir($path);
      $image_name = time() . "-" . basename($image);
      $target_files = $path . $image_name;

      if (move_uploaded_file($tmp_name, $target_files)) {
        // Hapus gambar lama jika update
        if (!empty($rowEdit['image']) && file_exists($path . $rowEdit['image'])) {
          @unlink($path . $rowEdit['image']);
        }
      }
    } else {
      echo "Extensi file tidak diperbolehkan";
      die;
    }
    $updateQuery = "UPDATE blogs SET id_category='$id_category', title='$title', content='$content', image='$image_name', tags='$tags', is_active='$is_active', writer='$writer' WHERE id='$id'";
  } else {
    // Kalau update dan tidak upload gambar, pakai gambar lama
    $image_name = $rowEdit['image'] ?? '';
    $updateQuery = "UPDATE blogs SET id_category='$id_category', title='$title', content='$content', image='$image_name', tags='$tags', is_active='$is_active', writer='$writer' WHERE id='$id'";
  }

  if (!empty($id)) {
    // UPDATE
    $update = mysqli_query($koneksi, $updateQuery);
    if ($update) {
      header("location:?page=blog&ubah=berhasil");
      exit;
    }
  } else {
    // INSERT
    $insert = mysqli_query($koneksi, "INSERT INTO blogs (id_category, title, content, image, tags, is_active, writer) 
VALUES('$id_category', '$title','$content','$image_name', '$tags', '$is_active', '$writer')");

    if ($insert) {
      header("location:?page=blog&tambah=berhasil");
      exit;
    }
  }
}

$queryCategories = mysqli_query($koneksi, "SELECT * FROM categories ORDER BY name DESC");
$rowCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

?>


<div class="pagetitle">
  <h1><?php echo $titlePage ?></h1>
</div><!-- End Page Title -->

<section class="section">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $titlePage ?></h5>
            <div class="mb-3">
              <label for="" class="form-label">Gambar</label>
              <input type="file" name="image" <?php echo empty($id) ? 'required' : ''; ?>>
              <small class="text-danger">*image must be in landscape or 1920x1080</small>
            </div>
            <div class="mb-3">
              <label for="">Kategori</label>
              <select name="id_category" id="" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($rowCategories as $rowCategory): ?>
                  <option value="<?php echo $rowCategory['id'] ?>"
                    <?php echo (isset($rowEdit['id_category']) && $rowEdit['id_category'] == $rowCategory['id']) ? 'selected' : ''; ?>>
                    <?php echo $rowCategory['name'] ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Judul</label>
              <input type="text" name="title" class="form-control" placeholder="Masukkan judul" required
                value="<?php echo $rowEdit['title'] ?? '' ?>">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Isi</label>
              <textarea name="content" id="summernote"
                class="form-control"><?php echo $rowEdit['content'] ?? '' ?></textarea>
            </div>
            <div class="mb-3">
              <label for="tags" class="form-label">Tags</label>
              <input type="text" id="tags" name="tags" class="form-control"
                value="<?php echo $rowEdit['tags'] ?? '' ?>">

            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?php echo $titlePage ?></h5>
            <div class="mb-3">
              <label for="" class="form-label">Status</label>
              <select name="is_active" id="" class="form-control">
                <option value="1"
                  <?php echo (isset($rowEdit['is_active']) && $rowEdit['is_active'] == 1) ? 'selected' : ''; ?>>Publish
                </option>
                <option value="0"
                  <?php echo (isset($rowEdit['is_active']) && $rowEdit['is_active'] == 0) ? 'selected' : ''; ?>>Draft
                </option>
              </select>
            </div>
            <div class="mb-3">
              <button class="btn btn-outline-primary" type="submit" name="simpan">Simpan</button>
              <a href="?page=slider" class="text-muted">Kembali</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </form>
</section>