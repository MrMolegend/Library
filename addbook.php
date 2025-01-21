
<?php
include_once("connection.php");
#header('Location:books.php');
array_map("htmlspecialchars", $_POST);


$stmt = $conn->prepare("INSERT INTO tbl_books (book_id,title,author,genre,blurb,rating,t_copies,a_copies,cover)
VALUES (null,:title,:author,:genre,:blurb,:rating,null,null,:cover)");


$stmt->bindParam(':title', $_POST["title"]);
$stmt->bindParam(':author', $_POST["author"]);
$stmt->bindParam(':genre', $_POST["genre"]);
$stmt->bindParam(':blurb', $_POST["blurb"]);
$stmt->bindParam(':rating', $_POST["rating"]);
$stmt->bindParam(':cover', $_FILES["cover"]["name"]);
$stmt->execute();

$target_dir = "images/";
    print_r($_FILES);
    $target_file = $target_dir . basename($_FILES["cover"]["name"]);
    $target_dir = "images/";
    $original_file = $_FILES["cover"]["tmp_name"];
    $original_filename = basename($_FILES["cover"]["name"]);
    $target_file = $target_dir . $original_filename;
    $new_file_name = $target_dir . $_POST["title"] . "." . strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
    echo $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($original_file, $target_file)) {
        if (rename($target_file, $new_file_name)) {
            echo "The file " . htmlspecialchars($_POST["title"]) . " has been uploaded and renamed.";
        } else {
            echo "The file was uploaded, but renaming failed.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
$conn=null;
?>
