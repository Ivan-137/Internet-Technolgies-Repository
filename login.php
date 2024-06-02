<?php

session_start();

include('server/connection.php');


if(isset($_POST['login_btn'])){


$username = $_POST['username'];
$password = md5($_POST['password']);

$stmt = $conn->prepare("SELECT user_id, user_name, username, user_password FROM users WHERE username = ? AND user_password = ? LIMIT 1");

$stmt->bind_param('ss', $username,$password);

if($stmt->execute()){
   $stmt->bind_result($user_id, $user_name, $username, $user_password);
   $stmt->store_result();

         if($stmt->num_rows() == 1){
         $stmt->fetch();
         
         $_SESSION['user_id'] = $user_id;
         $_SESSION['user_name'] = $user_name;
         $_SESSION['username'] = $username;
         $_SESSION['logged_in'] = true;

         header('location: account.php?login_success=logged in successfully');


        }else{
            header('location: login.php?error=could not verify your account');
        }

    }else{
      //error
      header('location: login.php?error=something went wrong');
    }


}




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/style.css"/>


</head>
<body>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-skyblue py-3 fixed-top">
        <div class="container">
          <img class="logo" src="assets/imgs/logoo.png"/>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.html">Shop</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>


              <li class="nav-item">
                <a class="nav-link" href="cart.html">Cart</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="account.html">Account</a>
              </li>




            </ul>
          </div>
        </div>
      </nav>

    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="login-hr mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="login-form" method="POST" action="login.php">
                <p style="color:orange" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="login-username" name="username" placeholder="Enter Your Username" required/>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" id="login-password" name="password" placeholder="Enter Your Password" required/>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="login-btn" name="login_btn" value="Login"/>
                </div>

                <div class="form-group">
                    <a id="register-url" href="register.php" class="btn">Don't have an account? Register</a>
                </div>

            </form>
        </div>
    </section>





      <!--Footer-->
      <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img class="logo" src="assets/imgs/logoo.png"/>
                <p class="pt-3">We provide the best product for the most affordable prices</p>
            </div>
    
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">Shirts</a></li>
                    <li><a href="#">Lanyards</a></li>
                    <li><a href="#">Totebags</a></li>
                    <li><a href="#">Stickers</a></li>
                    <li><a href="#">New Release</a></li>
                </ul>
            </div>
    
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address:</h6>
                    <p>Rizal Street, Legazpi City, Albay, Legazpi, Philippines</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Contact Number:</h6>
                    <p>090909090909 / 09324142342</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email Address:</h6>
                    <p>admin@bicol-u.edu.ph</p>
                </div>
            </div>
    
            <div class="footer-one col-lg-3 col-md-6 col-sm-12 ">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="assets/imgs/footer1.jpeg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/footer1.jpeg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/footer1.jpeg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/footer1.jpeg" class="img-fluid w-25 h-100 m-2"/>
                    <img src="assets/imgs/footer1.jpeg" class="img-fluid w-25 h-100 m-2"/>
                </div>
            </div>
        </div>
    
        <div class="copyright mt-5">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="assets/imgs/payment.png"/>
                    <img src="assets/imgs/Gcash.png"/>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                    <p>BUMAKAL@2024 All Right Reserved</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-4"> 
                    <a href="#"><i class="fab fa-facebook"></i> </a>
                    <a href="#"><i class="fab fa-instagram"></i> </a>
                    <a href="#"><i class="fab fa-x"></i> </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>