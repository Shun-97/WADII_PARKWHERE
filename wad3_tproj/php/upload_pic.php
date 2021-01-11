<?php
require_once 'include/common.php';


$target_dir = "../images/User/";
// var_dump(is_dir($target_dir));
//WORKING!!!
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $pic_name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    echo "The file ". $pic_name. " has been uploaded.";
    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      // var_dump($pic_name);
      // var_dump($username);
      $dao = new AccountDAO();
      // var_dump($pic_name);
      $dao->updatePic($pic_name, $username);
      header("location: ../profile.php");
      exit();
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
  header("location: ../profile.php");
  exit();
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
  header("location: ../profile.php");
  exit();
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  echo realpath(($_FILES["fileToUpload"]["name"]));
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $pic_name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    echo "The file ". $pic_name. " has been uploaded.";
    if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      // var_dump($pic_name);
      // var_dump($username);
      $dao = new AccountDAO();
      // var_dump($pic_name);
      $dao->updatePic($pic_name, $username);
      header("location: ../profile.php");
      exit();
    }
    

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>