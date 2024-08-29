<?php
  include_once('./config.php');
  $page = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie List</title>
    <link href="<?= PROJECT_ROOT ?>/assets/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= PROJECT_ROOT ?>/assets/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="<?= PROJECT_ROOT ?>/assets/styles.css" rel="stylesheet" />
  </head>
  <body>
    <header class="mb-5 py-3 bg-light">
      <div class="container">
        <div class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a href="index.php" class="nav-link <?php echo ($page == 'index.php' ? 'active' : '') ?>" aria-current="page">Home</a>
            </li>
            <li class="nav-item">
              <a href="about.php" class="nav-link <?php echo ($page == 'about.php' ? 'active' : '') ?>">About</a>
            </li>
            <li class="nav-item">
              <a href="contact.php" class="nav-link <?php echo ($page == 'contact.php' ? 'active' : '') ?>">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </header>
    <div class="container border">