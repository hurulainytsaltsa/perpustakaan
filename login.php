<?php
    session_start();
    require 'koneksi.php';
    
    if (isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
      
        $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

        $result = $db->query($sql);
        $data=$result->fetch_assoc();
       
        if ($result->num_rows > 0) {
          // $data = $result->fetch_assoc();
          $_SESSION['email'] = $email;
          $_SESSION['nama'] = $data['nama']; 
          $_SESSION['photo'] = $data['photo']; 
          $_SESSION['level'] = $data['level']; 
          $_SESSION['login'] = TRUE;
          header("Location: index.php");
          exit;
      } else {
          echo "Login gagal";
      }
    }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/logopnp.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <div class="container">

<!-- Outer Row -->

      <div class="row justify-content-center">

          <div class="col-xl-10 col-lg-14 col-md-9">
<br>
<br>
              <div class="card o-hidden border-0 shadow-lg my-5">
                
                  <div class="card-body p-0">
                  
                      <!-- Nested Row within Card Body -->
                      <div class="row">
                      
                          <div class="col-lg-6 d-none d-lg-block bg-login-image ">
                          <img src="assets/images/backgrounds/admin.jpg" width="450" alt="">
                          </div>
                          <div class="col-lg-6">
                              <div class="p-5">
                                  <div class="text-center">
                                      <h1 class="h4 text-gray-900 mb-4">Welcome to Perpustakaan Politeknik Negeri Padang</h1>
                                  </div>
                                  <form action="" method="post">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email</label>
                          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-4">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                          <div class="form-check">
                            <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label text-dark" for="flexCheckChecked">
                              Remember this Device
                            </label>
                          </div>
                          <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                        </div>

                        
                        
                    <p class>Login can only be done by the admin or librarian of Padang State Polytechnic</p>
                    <button name=submit class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                    <div class="d-flex align-items-center justify-content-center">
                    </div>

                        
                      </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

          </div>

        </div>
      </div>

  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>