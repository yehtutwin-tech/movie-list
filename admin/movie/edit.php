<?php
  include_once("../partial/header.php");
  include_once('../../dbConnection.php');
?>

<h1 class="text-center">Edit Movie</h1>

<a href="index.php?tab=movie" class="btn btn-outline-secondary my-2">
  <i class="fa-solid fa-arrow-left"></i>
  Back to Listing
</a>

<?php
  $error_message = '';
  $success_message = '';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['year']) && !empty($_POST['type_id'])) {
      
      $id = $_POST['id'];
      $title = $_POST['title'];
      $year = $_POST['year'];
      $type_id = $_POST['type_id'];

      $file = $_FILES['poster'];

      if ($file['name']) {

        $upload_file = '../images/' . $file['name'];

        move_uploaded_file(
          $file['tmp_name'],
          $upload_file,
        );

        // update db with poster
        $sql = "UPDATE movies SET `title`='$title', `year`='$year', `type_id`='$type_id', `poster`='$upload_file', `updated_at`=now() WHERE id=$id";

      } else {

        // update db w/o poster
        $sql = "UPDATE movies SET `title`='$title', `year`='$year', `type_id`='$type_id', `updated_at`=now() WHERE id=$id";
      }

      $result = $conn->query($sql);

      if (!$result) {
        die('query failed: ' . $conn->error);
      }

      // header('Location: index.php');
      // exit;
      $success_message = "Record updated successfully!";
    }
    else {
      $error_message = "All fields are required!";
    }
  }

  // find item by id
  if (!isset($_GET['id'])) {
    header('Location: index.php?tab=movie');
  }

  $id = $_GET['id'];

  $sql = "SELECT * FROM movies WHERE id=$id";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();

  if (!$row) {
    header('Location: idnex.php?tab=movie&err=rnf');
  }

  $sql_types = "SELECT * FROM types";
  $result_types = $conn->query($sql_types);
?>

<form method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $id ?>" />
  <div class="row my-3">
    <?php if ($error_message) { ?>
    <div class="col-12 mb-3">
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $error_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <?php } ?>
    <?php if ($success_message) { ?>
    <div class="col-12 mb-3">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $success_message; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <?php } ?>
    <div class="col-6 mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?= $row['title'] ?>"/>
    </div>
    <div class="col-6 mb-3">
      <label for="year" class="form-label">Year</label>
      <input type="text" class="form-control" id="year" name="year" value="<?= $row['year'] ?>"/>
    </div>
    <div class="col-6 mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-control" name="type_id">
        <?php while($types = $result_types->fetch_assoc()) { ?>
          <option
            value="<?= $types['id'] ?>"
            <?= $types['id'] == $row['type_id'] ? 'selected' : '' ?>
          >
            <?= ucfirst($types['name']) ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-6 mb-3">
      <label for="poster" class="form-label">Poster</label>
      <input type="file" class="form-control" id="poster" name="poster"/>
      <img src="<?= $row['poster'] ?>" width="150"/>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-floppy-disk"></i>
        Update
      </button>
    </div>
  </div>
</form>

<?php include_once("../partial/footer.php"); ?>