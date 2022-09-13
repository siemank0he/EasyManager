<?php 

$con=mysqli_connect("sql52.lh.pl","serwer73352_easymenage","Nielubiebananow12","serwer73352_easymenage");
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      
    $result = mysqli_query($con,"SELECT * FROM ksiazki-tata");


    mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki</title>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
</style>
<body>
<h1>Test</h1>
<?php
 echo "<table>";
 if($result){
 while($row = mysqli_fetch_array($result))
          {
          echo "<tr><td>" . $row['FirstName'] . "</td><td> " . $row['LastName'] . "</td></tr>"; //these are the fields that you have stored in your database table employee
          }
        }
 echo "</table>";
?>
</body>
</html>