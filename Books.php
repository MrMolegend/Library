<!DOCTYPE html>
<html>
<head>
    
    <title>Page title</title>
    
</head>
<body>
   <form action="addbook.php" method="post" enctype="multipart/form-data">
  Title:<input type="text" name="title"><br>
  Author:<input type="text" name="author"><br>
  Genre:<input type="text" name="genre"><br>
  Blurb:<input type="text" name="blurb"><br>
  Rating:<input type="number" name="rating" max=5 min=0><br>


  <input type="file" name="cover" id="cover">
  <input type="submit" value="Submit" name="submit">
</form>
<?php
	include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM tbl_books");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		


?>   
</body>
</html>