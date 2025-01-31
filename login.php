<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>StockWise Trade Center - Login</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

	<main>
		<div class="container">

			<section
				class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

							<div class="d-flex justify-content-center py-4">
								<a href="index.html" class="logo d-flex align-items-center w-auto">
									<img src="assets/img/logo.png" alt="">
									<span class="d-none d-lg-block">StockWise Trade Center</span>
								</a>
							</div><!-- End Logo -->

							<div class="card mb-3">

								<div class="card-body">

									<div class="pt-4 pb-2">
										<h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
										<p class="text-center small">Enter your username & password to login</p>
									</div>

									<form class="row g-3 needs-validation" method="POST" novalidate>

										<div class="col-12">
											<label for="yourUsername" class="form-label">Username</label>
											<div class="input-group has-validation">
												<span class="input-group-text" id="inputGroupPrepend">@</span>
												<input type="text" name="username" class="form-control"
													id="yourUsername" required>
												<div class="invalid-feedback">Please enter your username.</div>
											</div>
										</div>

										<div class="col-12">
											<label for="yourPassword" class="form-label">Password</label>
											<input type="password" name="password" class="form-control"
												id="yourPassword" required>
											<div class="invalid-feedback">Please enter your password!</div>
										</div>
										<div class="col-12">
											<button class="btn btn-primary w-100" name="submit"
												type="submit">Login</button>
										</div>
									</form>
								</div>
							</div>
							<div class="credits">
								Designed for <a href="">StockWise - Trade Center </a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</main>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>
	<script src="assets/js/main.js"></script>
</body>

</html>


<?php
session_start();
require_once "config/database.php";
if (isset ($_POST['submit'])) {
  if ($stmt = $conn->prepare('SELECT  name , username , password ,status FROM users WHERE username = ?')) {
      $stmt->bind_param('s', $_POST['username']);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
          $stmt->bind_result( $name, $username, $password, $status);
          $stmt->fetch();
          $post_password=md5($_POST['password']);
          if ($post_password== $password) {
            if ($status==1){
              $_SESSION['Session_Id']=uniqid();
              $_SESSION['username'] =$username;
              $_SESSION['name'] =$name;
              
              $sql = "UPDATE `users` SET last_login='". date('Y-m-d H:i:s')."' WHERE `username` = '". $_SESSION['username']."';";
              $conn->query($sql);
              echo "<script>window.location = 'Dashboard.php';</script>";
            }else{
              echo "<script>alert('Account Banned');document.location='login.php'</script>";
            }
          } else {
            echo "<script>alert('Incorrect Password');document.location='login.php'</script>";
          }
      } else {
        echo "<script>alert('Incorrect User Name');document.location='login.php'</script>";
      }
      $stmt->close();
  }
}

?>