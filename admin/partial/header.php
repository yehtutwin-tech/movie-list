<?php
  include_once('../../config.php');

  $qs = $_SERVER['QUERY_STRING'];
  parse_str($qs, $qs_arr);
  $tab = $qs_arr['tab'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
          <li class="nav-item"><a href="<?= PROJECT_ROOT ?>/admin/movie/index.php?tab=movie" class="nav-link <?php echo $tab =='movie' ? 'active' : '' ?>" aria-current="page">Movies</a></li>
          <li class="nav-item"><a href="<?= PROJECT_ROOT ?>/admin/type/index.php?tab=type" class="nav-link <?php echo $tab =='type' ? 'active' : '' ?>">Types</a></li>
        </ul>
      </header>
    </div>
    <div class="container border pt-3">