<?php include_once('partial/header.php'); ?>

<div class="row my-3">
  <div class="col-4 offset-4 input-group">
    <form method="get">
      <div class="input-group mb-3">
        <input name="title" type="text" class="form-control" placeholder="Search by Ttile...">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
      </div>
    </form>
  </div>
</div>
<div class="row my-3">
  <?php
    session_start();

    $movie_list = [];
    if (isset($_SESSION["movie-list"])) {
      $movie_list = $_SESSION["movie-list"];
    }

    if (isset($_GET['title'])) {
      $title = $_GET['title'];
      
      $tmp = [];
      foreach($movie_list as $movie) {
        if (str_contains($movie['title'], $title)) {
          $tmp[] = $movie;
        }
      }

      if (count($tmp) > 0) {
        $movie_list = $tmp;
      }
    }
    
    foreach($movie_list as $movie) {
  ?>
  <div class="col-3 mb-3">
    <div class="card" style="width: 18rem;">
      <img src="admin/<?= $movie['poster'] ?>" class="card-img-top" alt="Img">
      <div class="card-body">
        <h5 class="card-title"><?= $movie['title'] ?></h5>
        Year: <?= $movie['year'] ?>
        Type: <?= $movie['type'] ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<?php include_once('partial/footer.php'); ?>