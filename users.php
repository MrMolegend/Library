<!DOCTYPE html>
<html>
<head>
    
    <title>Page title</title>
    
</head>
<body>
   <form action="add_users.php" method="post">
    Forename:<input type="text" name="forename"><br>
    Surname:<input type="text" name="surname"><br>
    Address:<input type="text" name="address"><br>
    E-mail Address:<input type="text" name="email"><br>
    Password:<input type="text" name="password"><br>
    Phone Number:<input type="text" name="phone_num" minlength="11" maxlength="11"><br>
    Role:
    <select name="role">
        
        <option value="user">user</option>
        <option value="librarian">librarian</option>
        <option value="admin">administrator</option>
    
    </select><br>

    <input type="submit" value="submit" name="submit">
</form>

<?php
	include_once('connection.php');
	$stmt = $conn->prepare("SELECT * FROM tbl_users");
	$stmt->execute();	
?>   
</body>
</html>