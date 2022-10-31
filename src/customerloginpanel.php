<?php
if (!isset($_SESSION)) {
	session_start();
}
include("header.php");
include("dbconnection.php");
if (isset($_SESSION[customerid])) {
	echo "<script>window.location='customerpanel.php';</script>";
}
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		$sql = "SELECT * FROM customer WHERE email_id='$_POST[emailid]' AND password='$_POST[password]' AND status='Active' ";
		$qsql = mysqli_query($con, $sql);
		if (mysqli_num_rows($qsql) == 1) {
			$rslogin = mysqli_fetch_array($qsql);
			$_SESSION[customerid] = $rslogin[customer_id];
			if (isset($_GET[pagename])) {
				echo "<script>window.location='" . $_GET[pagename] . "?productid=" . $_GET[productid] . "';</script>";
			} else {
				echo "<script>window.location='customerpanel.php';</script>";
			}
		} else {
			echo "<script>alert('Login ID and password not valid..');</script>";
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
?>

<main id="main">

	<!-- ======= Breadcrumbs ======= -->
	<section id="breadcrumbs" class="breadcrumbs">
		<div class="container">

			<div class="d-flex justify-content-between align-items-center">
				
			</div>

		</div>
	</section><!-- End Breadcrumbs -->
	

	<!-- ======= Services Section ======= -->
	<section id="services" class="services section-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row" style="justify-content:center">

						<!-- <div class="col-md-3 d-flex align-items-stretch mt-4 mt-lg-0">
							<div class="icon-box" data-aos="zoom-in" data-aos-delay="200" style="width: 100%;">
								<h4>Customer Login</h4>
								<img src="images/customericon.jpg" style="width: 100%;">
							</div>
						</div> -->
						<div class="col-md-6 d-flex align-items-stretch">
							<div class="icon-box" data-aos="zoom-in" data-aos-delay="100" style="width: 100%;text-align: left;">
								<form method="post" action="" name="frmcstlogin" onSubmit="return validatecstlogin()">
									<h4>Login Panel</h4>
									<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

									<div class="form-group">
										<label for="exampleInputEmail1">Email address</label>
										<input type="email" class="form-control" id="emailid" name="emailid" aria-describedby="emailHelp" placeholder="Enter email">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Password</label>
										<input type="password" class="form-control" placeholder="Password" id="password" name="password">
									</div>

									<button type="submit" name="submit" id="submit" class="btn btn-info btn-lg btn-block">Click here to Login</button>

								</form>
							</div>
						</div>


					</div>
				</div>
			</div>

		</div>
	</section><!-- End Services Section -->

	<hr>
</main><!-- End #main -->

<?php
include("footer.php");
?>
<script type="application/javascript">
	function validatecstlogin() {
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

		if (document.frmcstlogin.emailid.value == "") {
			alert("E-Mail ID should not be empty..");
			document.frmcstlogin.emailid.focus();
			return false;
		} else if (!document.frmcstlogin.emailid.value.match(emailExp)) {
			alert("Kindly enter Valid Email ID.");
			document.frmcstlogin.emailid.focus();
			return false;
		} else if (document.frmcstlogin.password.value == "") {
			alert("Password should not be empty..");
			document.frmcstlogin.password.focus();
			return false;
		} else {
			return true;
		}
	}
</script>