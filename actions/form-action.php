<?php

include __DIR__ . '/db/db.php';

$error_message = "";
$success_message = "";

if (isset($_POST)) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $hobbies_data = $_POST['hobbies'];
    $hobbies = implode(',', $hobbies_data);
    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);
    $isValid = true;
    if ($fname == '' || $lname == '' || $email == '' || $password == '' || $confirmpassword == '') {
        $isValid = false;
        $error_message = "Please fill all fields.";
    }
    if ($isValid && ($password != $confirmpassword)) {
        $isValid = false;
        $error_message = "Confirm password not matching";
    }
    if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $error_message = "Invalid Email-ID.";
    }
    if ($isValid) {
        $email = mysqli_real_escape_string($mysql_connection, $_POST['email']);
        $sqlcheck = "SELECT email FROM users WHERE email = '$email' ";
        $checkResult = $mysql_connection->query($sqlcheck);
        if ($checkResult->num_rows > 0) {
            $error_message = "Sorry! email has already taken. Please try another.";
        }
    }
    if (strlen($error_message) > 0) {
        $_SESSION['error_message'] = $error_message;
        redirect_to('index.php');
    }
    if ($isValid) {
        $insertSQL = "INSERT INTO users(fname,lname,email,password,gender,hobbies) values('$fname','$lname','$email','$password','$gender','$hobbies')";
        if ($mysql_connection->query($insertSQL) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $insertSQL . "<br>" . $mysql_connection->error;
        }
        $success_message = "Account created successfully.";
        header("Location: success.php");
    }
}
?>