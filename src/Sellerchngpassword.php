<?php
if (!isset($_SESSION)) {
	session_start();
}
include("header.php");
include("dbconnection.php");
if (!isset($_SESSION[sellerid])) {
	echo "<script>window.location='index.php';</script>";
}
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		$sql = "UPDATE seller SET password='$_POST[newpassword]' WHERE seller_id='$_SESSION[sellerid]' AND password='$_POST[oldpassword]'";
		$qsql = mysqli_query($con, $sql);
		if (mysqli_affected_rows($con) == 1) {
			echo "<script>alert('Password updated successfully...');</script>";
		} else {
			echo "<script>alert('Failed to update password...');</script>";
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" style="padding-bottom:0px;">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3 style="color:black;">Change Password</h3>
			</div>

		</div>
	</section><!-- End Cta Section -->


	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<div class="row">

				<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
					<div class="info mt-4">

						<center>
							<h4>Enter Old password, New Password, Confirm password to change password...</h4>
						</center>
						<hr>

						<form method="post" action="" name="frmcstchngpasswrd" onSubmit="return validatecstchngpasswrd()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">
								<div class="col-md-6 form-group">
									Old password <font color="#FF0000">*</font>
									<input type="password" name="oldpassword" id="oldpassword" class="form-control">
								</div>

								<div class="col-md-6 form-group">
								</div>

								<div class="col-md-6 form-group">
									New Password <font color="#FF0000">*</font>
									<input type="password" name="newpassword" id="newpassword" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									Confirm Password <font color="#FF0000">*</font>
									<input type="password" name="password3" id="password3" class="form-control">
								</div>

							</div>

							<hr>
							<button type="submit" name="submit" id="submit" class="btn btn-info btn-lg btn-block">Change Password</button>

						</form>
					</div>
				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
include("footer.php");
?>
<script type="application/javascript">
	function validatecstchngpasswrd() {
		if (document.frmcstchngpasswrd.oldpassword.value == "") {
			alert(" Enter your old password....");
			document.frmcstchngpasswrd.oldpassword.focus();
			return false;
		} else if (document.frmcstchngpasswrd.newpassword.value == "") {
			alert("Enter a new password..");
			document.frmcstchngpasswrd.newpassword.focus();
			return false;
		} else if (document.frmcstchngpasswrd.newpassword.value.length < 8) {
			alert("Password length should be more than 8 characters...");
			document.frmcstchngpasswrd.newpassword.focus();
			return false;
		} else if (document.frmcstchngpasswrd.newpassword.value.length > 16) {
			alert("Password length should be less than 16 characters...");
			document.frmcstchngpasswrd.newpassword.focus();
			return false;
		} else if (document.frmcstchngpasswrd.password3.value == "") {
			alert("Confirm password should not be empty..");
			document.frmcstchngpasswrd.password3.focus();
			return false;
		} else if (document.frmcstchngpasswrd.newpassword.value != document.frmcstchngpasswrd.password3.value) {
			alert("Password and confirm password not matching...");
			document.frmcstchngpasswrd.password3.focus();
			return false;
		} else {
			return true;
		}
	}
</script>