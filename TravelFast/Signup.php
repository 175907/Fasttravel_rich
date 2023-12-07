<?php

@include 'database.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['password_confirmation']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create an Account</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="Signup.css" />
  </head>
  <body>
    <h1>Sign Up</h1>
    <form action="" method="post">
      <p>Please Fill this form to create an account.</p>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <label>Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your Name" required />
        <label>Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your Email" required/>
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your Password" required/>
        <label>Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your Password" required/>
        <select name="user_type" >
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
      <input type="submit" name="submit" class="submit" value="Register Now"></input>
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
  </body>
</html>
