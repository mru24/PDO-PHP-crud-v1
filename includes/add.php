<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($_POST['submit'])) {
    $name = $post['name'];
    $link = $post['link'];

    // checking empty fields
    if(empty($name) || empty($link)) {

        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }

        if(empty($link)) {
            echo "<font color='red'>Link field is empty.</font><br/>";
        }

        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // if all the fields are filled (not empty)

        //insert data to database
        $sql = "INSERT INTO mynav(name, link) VALUES(:name, :link)";
        $query = $dbc->prepare($sql);

        $query->bindparam(':name', $name);
        $query->bindparam(':link', $link);
        $query->execute();

        header('Location: ../index.php');

        // Alternative to above bindparam and execute
        // $query->execute(array(':name' => $name, ':email' => $email, ':age' => $age));

        //display success message
        // echo "<font color='green'>Data added successfully.";
        // echo "<br/><a href='../index.php'>View Result</a>";
    }
}
?>
</body>
</html>
