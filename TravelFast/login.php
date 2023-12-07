<?php

@include 'database.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['password_confirmation']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="register.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <title>FastTravel</title>
  </head>
  <body>
    <div>
      <form action="" method="post">
        <h1>
          <img class="logo" src="image/airplane.jpeg" /><span
            class="companyName"
            >FastTravel</span
          >
        </h1>
        <h1>Sign In or Create an Account</h1>
        <button class="google">
          <img class="google-svg" src="image/google-svg.png" /><span
            class="sign-in"
            >Sign in with Google</span
          >
        </button>
        <p>or</p>
        <h1>Log In</h1>
        <?php
        if(isset($error)){
          foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
          };
        };
        ?>
        <input
          type="email"
          placeholder="Enter your Email"
          name="email"
          class="emailInput"
        />
        <input
          type="password"
          placeholder="Enter your Password"
          name="password"
          class="emailInput"
        />
        <input type="submit" name="submit" value="login now" class="continue">
         
        <p>or <a href="Signup.php">create a new account</a></p>
        <p class="terms">
          By continuing, you have read and agree to our
          <a>Terms and Conditions</a>, <a>Privacy Statement</a>, and
          <a>FastTravel Rewards Terms & Conditions</a>.
        </p>
      </form>
    </div>
  </body>
</html>
