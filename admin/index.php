<?php include_once("partial/header.php"); ?>

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
    $tmp_data = [
      [
        "id" => 1,
        "title" => "Jackie Chan Adventures",
        "year" => "2000–2005",
        "type" => "series",
        "poster" => "./images/jc1.jpg",
        "created_at" => "2024-08-28 05:43AM"
      ],
      [
        "id" => 2,
        "title" => "Jackie Chan: My Stunts",
        "year" => "1999",
        "type" => "movie",
        "poster" => "./images/jc2.jpg",
        "created_at" => "2024-08-28 05:43AM"
      ],
      [
        "id" => 3,
        "title" => "Jackie Chan Presents: Wushu",
        "year" => "2008",
        "type" => "movie",
        "poster" => "./images/jc3.jpg",
        "created_at" => "2024-08-28 05:43AM"
      ],
    ];
    $movie_list = $tmp_data;
    $_SESSION["movie-list"] = $tmp_data;
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
        <img src="<?php echo $movie['poster'] ?>" width="50" />
      </td>
      <td><?php echo $movie['title']; ?></td>
      <td><?php echo $movie['year']; ?></td>
      <td><?php echo $movie['type']; ?></td>
      <td><?php echo $movie['created_at']; ?></td>
      <td>
        <a href="edit.php?id=<?php echo $movie['id']; ?>">Edit</a>
        <a href="delete.php?id=<?php echo $movie['id']; ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<?php include_once("partial/footer.php"); ?>