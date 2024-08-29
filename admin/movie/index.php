<?php include_once("../partial/header.php"); ?>

<h1 class="text-center">Movie List</h1>

<a href="add.php" class="btn btn-outline-secondary my-2">Create New</a>

<?php
  session_start();
  // session_destroy();

  $movie_list = [];
  if (
    isset($_SESSION["movie-list"]) && 
    count($_SESSION["movie-list"]) > 0
  ) {
    $movie_list = $_SESSION["movie-list"];
  } else {
    include_once('./data/movie-list.php');
    $_SESSION["movie-list"] = $data;
  }
  // print_r($movie_list);
?>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">Poster</th>
      <th scope="col">Title</th>
      <th scope="col">Year</th>
      <th scope="col">Type</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($movie_list as $movie) { ?>
    <tr>
      <td>
        <img src="<?= '../'.$movie['poster'] ?>" width="50" />
      </td>
      <td><?= $movie['title']; ?></td>
      <td><?= $movie['year']; ?></td>
      <td><?= $movie['type']; ?></td>
      <td><?= $movie['created_at']; ?></td>
      <td>
        <a href="edit.php?id=<?= $movie['id']; ?>">Edit</a>
        <a href="delete.php?id=<?= $movie['id']; ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php include_once("../partial/footer.php"); ?>