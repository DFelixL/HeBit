<?php
    $email = $_POST['email'];
    $pw = $_POST['pw'];

    //DB connection
        $sql = "SELECT * FROM msuser WHERE email LIKE $email";
        $result = mysqli_query($conn,$sql);
        
        if($result){
            $user_data = mysqli_fetch_assoc($result);
            if($user_data['pw'] === $pw){
                header("Home.php");
            }
        }

        echo "wrong email or password";

        if($result){
            echo "Data inserted successfully!";
        }else{
            die(mysqli_error($conn));
        }
?>