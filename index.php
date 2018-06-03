<?php
//including the database connection file
include_once("includes/config.php");

//fetching data in descending order (lastest entry first)
$result = $dbc->query("SELECT * FROM mynav");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP 1</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <div class="card mx-auto mt-5">
        <h3 class="card-header text-center">Data</h3>
        <div class="card-body">

        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
          <div class="row">
            <div class="col-4"><?php echo $row['name']; ?></div>
            <div class="col-4"><?php echo $row['link']; ?></div>
            <div class="col-4">
              <a href="includes/edit.php?id=<?php echo $row['id']; ?>" class="card-link">Edit</a>
              <a href="includes/delete.php?id=<?php echo $row['id']; ?>" class="card-link" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
            </div>
            <hr>
          </div>
        <?php } ?>

        </div>
        <div class="card-footer text-center">
          <!-- Modal trigger -->
          <h5><a href="includes/add.html" data-toggle="modal" data-target="#addDataModal">Add New Data</a></h5>
        </div>
      </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="addDataModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDataModalLabel">Add New Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="" action="includes/add.php" method="post">
              <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" placeholder="Enter data name">
              </div>
              <div class="form-group">
                <label>Link</label>
                <input name="link" type="text" class="form-control" placeholder="Link">
              </div>
              <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>




    <script src="js/jquery.min.js" charset="utf-8"></script>
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
  </body>
</html>
