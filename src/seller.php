<?php
include("header.php");
include("dbconnection.php");
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		if (isset($_GET[editid])) {
			$sql = "UPDATE seller SET seller_name='$_POST[sellername]', seller_address='$_POST[selleraddress]', state_id='$_POST[state]', country_id='$_POST[country]', city_id='$_POST[city]', pincode='$_POST[pincode]', contact_number='$_POST[contactnumber]', mobile_no='$_POST[mbnumber]', email_id='$_POST[emailid]', password='$_POST[password]', bank_name='$_POST[bankname]', bank_branch='$_POST[branch]', bank_IFSC='$_POST[ifsccode]', bank_acno='$_POST[bankacnumber]', status='$_POST[status]' WHERE seller_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Seller record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO seller(seller_name, seller_address, state_id, country_id, city_id, pincode, contact_number, mobile_no, email_id, password, bank_name, bank_branch, bank_IFSC, bank_acno, status) VALUES ('$_POST[sellername]','$_POST[selleraddress]','$_POST[state]','$_POST[country]','$_POST[city]','$_POST[pincode]','$_POST[contactnumber]','$_POST[mbnumber]','$_POST[emailid]','$_POST[password]','$_POST[bankname]','$_POST[branch]','$_POST[ifsccode]','$_POST[bankacnumber]','Active')";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query" . mysqli_error($con);
			} else {
				echo "<script>alert('You have registered successfuly.....');</script>";
				echo "<script>window.location.assign('sellerloginpanel.php')</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM seller WHERE seller_id='$_GET[editid]'";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);
}
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
					<div class="row" style="justify-content:center;">

						
						<div class="col-md-9 d-flex align-items-stretch">
							<div class="icon-box" data-aos="zoom-in" data-aos-delay="100" style="width: 100%;text-align: left;">
								<form method="post" action="" name="frmsellreg" onSubmit="return validatesellreg()">
									<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">
									<h4>Registration Panel</h4>

									<div class="form-row">
										<div class="col-md-6 form-group">
											Farmer Name <font color="#FF0000">*</font>
											<input type="text" name="sellername" id="sellername" value="<?php echo $rsedit[seller_name]; ?>" autofocus class="form-control">
										</div>

										<div class="col-md-6 form-group">
											Email ID <font color="#FF0000">*</font>
											<input type="email" name="emailid" id="emailid" value="<?php echo $rsedit[email_id]; ?>" class="form-control">
										</div>

										<div class="col-md-6 form-group">
											Password <font color="#FF0000">*</font>
											<input type="password" name="password" id="password" value="<?php echo $rsedit[password]; ?>" class="form-control">
										</div>

										<div class="col-md-6 form-group">
											Confirm Password <font color="#FF0000">*</font>
											<input type="password" name="cpassword" id="cpassword" value="<?php echo $rsedit[password]; ?>" class="form-control">
										</div>

										<div class="col-md-12 form-group">
											Address <font color="#FF0000">*</font>
											<textarea name="selleraddress" id="selleraddress" class="form-control"><?php echo $rsedit[seller_address]; ?></textarea>
										</div>

										<div class="col-md-6 form-group">
											Country <font color="#FF0000"> *</font>
											<select name="country" id="country" onChange="loadstate(this.value)" class="form-control">
												<option value="">Select</option>
												<?php
												$sql1 = "SELECT * FROM country where status='Active'";
												$qsql1 = mysqli_query($con, $sql1);
												while ($rssql1 = mysqli_fetch_array($qsql1)) {
													if ($rssql1[country_id] == $rsedit[country_id]) {
														echo "<option value='$rssql1[country_id]' selected>$rssql1[country]</option>";
													} else {
														echo "<option value='$rssql1[country_id]'>$rssql1[country]</option>";
													}
												}
												?>
											</select>
										</div>

										<div class="col-md-6 form-group">
											State <font color="#FF0000"> *</font>
											<span id='loadstate'><select class="form-control"></select></span>
										</div>

										<div class="col-md-6 form-group">
											City <font color="#FF0000"> *</font>
											<span id='loadcity'><select class="form-control"></select></span>
										</div>

										<div class="col-md-6 form-group">
											Pincode <font color="#FF0000"> *</font>
											<input type="number" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" class="form-control">
										</div>

										<div class="col-md-6 form-group">
											Contact Number <font color="#FF0000"> *</font>
											<input type="number" name="contactnumber" id="contactnumber" value="<?php echo $rsedit[contact_number]; ?>" class="form-control">
										</div>

										<div class="col-md-6 form-group">
											Mobile Number <font color="#FF0000"> *</font>
											<input type="number" name="mbnumber" id="mbnumber" value="<?php echo $rsedit[mbnumber]; ?>" class="form-control">
										</div>


										<div class="col-md-6 form-group">
											Bank Name <font color="#FF0000">*</font>
											<input type="text" name="bankname" id="bankname" value="<?php echo $rsedit[bank_name]; ?>" autofocus class="form-control">
										</div>


										<div class="col-md-6 form-group">
											Branch <font color="#FF0000">*</font>
											<input type="text" name="branch" id="branch" value="<?php echo $rsedit[bank_branch]; ?>" autofocus class="form-control">
										</div>


										<div class="col-md-6 form-group">
											IFSC Code <font color="#FF0000">*</font>
											<input type="text" name="ifsccode" id="ifsccode" value="<?php echo $rsedit[bank_IFSC]; ?>" autofocus class="form-control">
										</div>


										<div class="col-md-6 form-group">
											Bank Account Number <font color="#FF0000">*</font>
											<input type="text" name="bankacnumber" id="bankacnumber" value="<?php echo $rsedit[bank_acno]; ?>" autofocus class="form-control">
										</div>

									</div>
									<hr>
									<button type="submit" name="submit" id="submit" class="btn btn-info btn-lg btn-block">Click here to Register</button>

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
	function validatesellreg() {
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

		if (document.frmsellreg.sellername.value == "") {
			alert("Seller name should not be empty..");
			document.frmsellreg.sellername.focus();
			return false;
		} else if (!document.frmsellreg.sellername.value.match(alphaspaceExp)) {
			alert("Please enter only letters for Seller  name..");
			document.frmsellreg.sellername.focus();
			return false;
		} else if (document.frmsellreg.selleraddress.value == "") {
			alert("Seller address should not be empty..");
			document.frmsellreg.selleraddress.focus();
			return false;
		} else if (document.frmsellreg.country.value == "") {
			alert("Kindly select the country..");
			document.frmsellreg.country.focus();
			return false;
		} else if (document.frmsellreg.state.value == "") {
			alert("Kindly select the state...");
			document.frmsellreg.state.focus();
			return false;
		} else if (document.frmsellreg.city.value == "") {
			alert("Kindly select the city..");
			document.frmsellreg.city.focus();
			return false;
		} else if (document.frmsellreg.pincode.value == "") {
			alert("Kindly enter the pincode..");
			document.frmsellreg.pincode.focus();
			return false;
		} else if (document.frmsellreg.contactnumber.value == "") {
			alert("Kindly enter the contact number..");
			document.frmsellreg.contactnumber.focus();
			return false;
		} else if (document.frmsellreg.mbnumber.value == "") {
			alert("Kindly enter the mobile number..");
			document.frmsellreg.mbnumber.focus();
			return false;
		} else if (document.frmsellreg.emailid.value == "") {
			alert("Kindly enter the E-Mail ID..");
			document.frmsellreg.emailid.focus();
			return false;
		} else if (!document.frmsellreg.emailid.value.match(emailExp)) {
			alert("Kindly enter Valid Email ID.");
			document.frmsellreg.emailid.focus();
			return false;
		} else if (document.frmsellreg.password.value == "") {
			alert("Kindly enter the password..");
			document.frmsellreg.password.focus();
			return false;
		} else if (document.frmsellreg.password.value.length < 8) {
			alert("Password length should be more than 8 characters...");
			document.frmsellreg.password.focus();
			return false;
		} else if (document.frmsellreg.password.value.length > 16) {
			alert("Password length should be less than 16 characters...");
			document.frmsellreg.password.focus();
			return false;
		} else if (document.frmsellreg.cpassword.value == "") {
			alert("Confirm password should not be empty..");
			document.frmsellreg.cpassword.focus();
			return false;
		} else if (document.frmsellreg.password.value != document.frmsellreg.cpassword.value) {
			alert("Password and confirm password not matching...");
			document.frmsellreg.cpassword.focus();
			return false;
		} else if (document.frmsellreg.bankname.value == "") {
			alert("Kindly enter the name of the bank...");
			document.frmsellreg.bankname.focus();
			return false;
		} else if (!document.frmsellreg.bankname.value.match(alphaspaceExp)) {
			alert("Please enter only letters..");
			document.frmsellreg.bankname.focus();
			return false;
		} else if (document.frmsellreg.branch.value == "") {
			alert("Kindly enter the branch of the bank...");
			document.frmsellreg.branch.focus();
			return false;
		} else if (!document.frmsellreg.branch.value.match(alphaspaceExp)) {
			alert("Please enter only letters ..");
			document.frmsellreg.branch.focus();
			return false;
		} else if (document.frmsellreg.ifsccode.value == "") {
			alert("Kindly enter the IFSC Code of the bank...");
			document.frmsellreg.ifsccode.focus();
			return false;
		} else if (document.frmsellreg.ifsccode.value.length > 11) {
			alert("Kindly enter a valid 11 Characters IFSC Code...");
			document.frmsellreg.ifsccode.focus();
			return false;
		} else if (document.frmsellreg.ifsccode.value.length < 11) {
			alert("Kindly enter a valid 11 Characters IFSC Code...");
			document.frmsellreg.ifsccode.focus();
			return false;
		} else if (document.frmsellreg.bankacnumber.value == "") {
			alert("Kindly enter the A/c number of the bank...");
			document.frmsellreg.bankacnumber.focus();
			return false;
		} else {
			return true;
		}
	}


	function loadstate(id) {
		if (id == "") {
			document.getElementById("loadstate").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("loadstate").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "ajaxstate.php?id=" + id, true);
			xmlhttp.send();
		}
	}

	function loadcity(id) {
		if (id == "") {
			document.getElementById("loadcity").innerHTML = "";
			return;
		} else {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("loadcity").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "ajaxcity.php?id=" + id, true);
			xmlhttp.send();
		}
	}
</script>