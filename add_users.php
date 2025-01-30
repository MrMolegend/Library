<?php
echo($_POST);
header("Location:users.php");
include_once("connection.php");
array_map("htmlspecialchars",$_POST);
print_r($_POST);

switch($_POST["role"]){
	case "user":
		$role=0;
		break;
	case "librarian":
		$role=1;
		break;
	case "admin":
		$role=2;
		break;
};

$stmt = $conn->prepare("INSERT INTO tbl_users (user_id,forename,surname,address,email,password,phone_num,role)
VALUES (NULL,:forename,:surname,:address,:email,:password,:phone_num,:role)");

$stmt->bindParam(':forename', $_POST["forename"]);
$stmt->bindParam(':surname', $_POST["surname"]);
$stmt->bindParam(':address', $_POST["address"]);
$stmt->bindParam(':email', $_POST["email"]);
$stmt->bindParam(':password', $_POST["password"]);
<?php
echo($_POST);
header("Location:users.php");
include_once("connection.php");
array_map("htmlspecialchars",$_POST);
print_r($_POST);

switch($_POST["role"]){
	case "user":
		$role=0;
		break;
	case "librarian":
		$role=1;
		break;
	case "admin":
		$role=2;
		break;
};

$stmt = $conn->prepare("INSERT INTO tbl_users (user_id,forename,surname,address,email,password,phone_num,role)
VALUES (NULL,:forename,:surname,:address,:email,:password,:phone_num,:role)");

$stmt->bindParam(':forename', $_POST["forename"]);
$stmt->bindParam(':surname', $_POST["surname"]);
$stmt->bindParam(':address', $_POST["address"]);
$stmt->bindParam(':email', $_POST["email"]);
$stmt->bindParam(':password', $_POST["password"]);
$stmt->bindParam(':phone_num', $_POST["phone_num"]);
$stmt->bindParam(':role', $role);

$stmt->execute();
?>

$stmt->bindParam(':phone_num', $_POST["phone_num"]);
$stmt->bindParam(':role', $role);

$stmt->execute();
?>