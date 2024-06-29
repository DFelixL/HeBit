<?php
    $usn = $_POST['usn'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];

    //DB connection
    $conn = new mysqli('localhost','root', '', 'hebit');
    if($conn->connect_error){
        mysqli_error($conn);
    }else{
        $sql="INSERT INTO msuser (usn, email, pw) VALUES ('$usn', '$email', '$pw')";
        $result=mysqli_query($conn,$sql);
        if($result){
            header("Location: question1.php");
        }else{
            die(mysqli_error($conn));
        }
    }
?>