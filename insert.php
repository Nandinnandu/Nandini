<?php
$username = $_POST['user_name'];
$password = $_POST['user_password'];
$gender = $_POST['gender'];
$email = $_POST['user_email'];
$phone = $_POST['user_number'];
$age = $_POST['user_age'];

if (!empty($username) || !empty($password) || !empty($gender) || !empty($email) || !empty($phone) || !empty($age)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "petshop";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (username, password, gender, email, phone, age) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $username, $password, $gender, $email, $phone, $age);
      $stmt->execute();
      header('Location: signupthanks.html');
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>