<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container" id="signup">
      <h1 class="form-title">Register</h1>
      <form action="connect.php" method="post">
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="usn" id="usn" placeholder="Username" required>
            <label for="usn">Username</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pw" id="pw" placeholder="Password" required>
            <label for="pw">Password</label>
        </div>
       <input href="question1.php" type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <p class="or">
        - or sign up with -
      </p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
        <i class="fab fa-apple"></i>
      </div>
      <div class="links">
        <p>Already Have Account ?</p>
        <a href="login.php"><button id="signInButton">Sign In</button></a>
      </div>
    </div>
    </body>