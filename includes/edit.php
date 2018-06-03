<?php
// including the database connection file
include_once("config.php");

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($_POST['update']))
{
    $id = $post['id'];
    $name = $post['name'];
    $link = $post['link'];

    // checking empty fields
    if(empty($name) || empty($link)) {

        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }

        if(empty($link)) {
            echo "<font color='red'>link field is empty.</font><br/>";
        }
    } else {
        //updating the table
        $sql = "UPDATE mynav SET name=:name, link=:link WHERE id=:id";
        $query = $dbc->prepare($sql);

        $query->bindparam(':id', $id);
        $query->bindparam(':name', $name);
        $query->bindparam(':link', $link);
        $query->execute();

        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':link' => $link));

        //redirectig to the display plink. In our case, it is index.php
        header("Location: ../index.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM mynav WHERE id=:id";
$query = $dbc->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $name = $row['name'];
    $link = $row['link'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP 1</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>
  <body>

<body>
  <div class="container">
    <div class="card mx-auto mt-5">
      <div class="card-header text-center">
        <h3>Edit Data</h3>
      </div>
      <div class="card-body">
        <form method="post" action="edit.php">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
          </div>
          <div class="form-group">
            <label>Link</label>
            <input type="text" class="form-control" name="link" value="<?php echo $link; ?>">
          </div>
          <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
          <input type="submit" class="btn btn-primary d-block mx-auto" name="update" value="Update">
        </form>
      </div>
      <div class="card-footer text-center">
        <h5><a href="../index.php"><< Main Page</a></h5>
      </div>
    </div>
  </div>

  <script src="../js/jquery.min.js" charset="utf-8"></script>
  <script src="../js/bootstrap.min.js" charset="utf-8"></script>
</body>
</html>
