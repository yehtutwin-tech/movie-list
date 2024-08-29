<?php
  include_once('../../dbConnection.php');

  if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM movies WHERE `id`=$id";

    $conn->query($sql);
  }

  header("Location: index.php?tab=movie");