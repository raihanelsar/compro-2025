<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$image_name = ''; // default kosong

// Ambil data untuk edit
if (!empty($id)) {
  $query = mysqli_query($koneksi, "SELECT * FROM clients WHERE id = '$id'");
  $rowEdit = mysqli_fetch_assoc($query);
  $titlePage = "Edit Client";
} else {
  $titlePage = "Tambah Client";
}

// Hapus data
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $queryGambar = mysqli_query($koneksi, "SELECT id, image FROM clients WHERE id='$id'");
  $rowGambar = mysqli_fetch_assoc($queryGambar);
  $image_name = $rowGambar['image'];
  unlink("uploads/" . $image_name);
  $delete = mysqli_query($koneksi, "DELETE FROM clients WHERE id='$id'");

  if ($delete) {
    header("location:?page=client&hapus=berhasil");
    exit;
  }
}

// Simpan data (insert atau update)
if (isset($_POST['simpan'])) {
  $title = mysqli_real_escape_string($koneksi, $_POST['title']);
  $content = mysqli_real_escape_string($koneksi, $_POST['content']);
  $is_active = $_POST['is_active'];
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
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target_files)) {
        // Hapus gambar lama jika update
        if (!empty($rowEdit['image'])) {
          @unlink($path . $rowEdit['image']);
        }
      }
    } else {
      echo "extensi file tidak ditemukan";
      die;
    }
  } else {
    // Kalau update dan tidak upload gambar, pakai gambar lama
    if (!empty($rowEdit['image'])) {
      $image_name = $rowEdit['image'];
    }
  }

  if (!empty($id)) {
    // UPDATE
    $update = mysqli_query($koneksi, "UPDATE clients 
            SET name='$name', image='$image_name', is_active='$is_active'
            WHERE id='$id'");
    if ($update) {
      header("location:?page=client&ubah=berhasil");
      exit;
    }
  } else {
    // INSERT
    $insert = mysqli_query($koneksi, "INSERT INTO clients (name,  image, is_active) 
            VALUES('$name', '$image_name', '$is_active')");
    if ($insert) {
      header("location:?page=client&tambah=berhasil");
      exit;
    }
  }
}
?>

<div class="pagetitle">
  <h1><?php echo $titlePage ?></h1>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $titlePage ?></h5>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="">Gambar</label>
              <input type="file" name="image" <?php echo empty($id) ? 'required' : ''; ?>>
              <small class="text-danger">*image must be in landscape or 1920x1080</small>
            </div>
            <div class="mb-3">
              <label for="">Nama</label>
              <input type="text" name="name" placeholder="Masukkan nama" required
                value="<?php echo ($id) ? $rowEdit['name'] : '' ?>">
            </div>
            <div class="mb-3">
              <label for="">Is Active</label>
              <select name="is_active" id="" class="form-control">
                <option <?php echo ($id) ? $rowEdit['is_active'] == 1 ? 'selected' : '' : '' ?> value="1">Publish
                </option>
                <option <?php echo ($id) ? $rowEdit['is_active'] == 0 ? 'selected' : '' : '' ?>value="0">Draft
                </option>
              </select>
            </div>
            <div class="mb-3">
              <button class="btn btn-outline-primary" type="submit" name="simpan">Simpan</button>
              <a href="?page=client" class="text-muted">Kembali</a>
            </div>
          </form>

        </div>
      </div>

    </div>

  </div>
</section>