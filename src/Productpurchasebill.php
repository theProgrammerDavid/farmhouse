<?php
include("header.php");
include("dbconnection.php");
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		if (isset($_GET[editid])) {
			$sql = "UPDATE product_purchase_bill SET `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city_id`='$_POST[city]', `customer_name`='$_POST[customername]', `customer_address`='$_POST[customeraddress]', `pincode`='$_POST[pincode]', `customer_contact_number`='$_POST[contactnumber]', `purchase_date`='', `status`='$_POST[status]' WHERE product_purchase_bill_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Product Purchase Bill record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO `product_purchase_bill`(`product_purchase_bill_id`, `country_id`, `state_id`, `city_id`, `customer_name`, `customer_address`, `pincode`, `customer_contact_number`, `purchase_date`, `status`) VALUES ('','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[customername]','$_POST[customeraddress]','$_POST[pincode]','$_POST[contactnumber]','','$_POST[status]')";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Product Purchase Bill record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM product_purchase_bill WHERE product_purchase_bill_id='$_GET[editid]'";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>Product Purchase Bill</h3>
			</div>

		</div>
	</section><!-- End Cta Section -->


	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<div class="row">


				<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
					<div class="info mt-4 ">

						<center>
							<h4>Enter Product Detail...</h4>
						</center>
						<hr>

						<form method="post" action="" name="frmprodpurchasebill" onSubmit="return validateprodpurchasebill()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">

								<div class="col-md-12 form-group">
									Customer Name <font color="#FF0000">*</font>
									<input type="text" name="customername" id="customername" value="<?php echo $rsedit[customer_name]; ?>" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Customer Address <font color="#FF0000">*</font>
									<textarea name="customeraddress" id="customeraddress" class="form-control"><?php echo $rsedit[customer_address]; ?></textarea>
								</div>


								<div class="col-md-4 form-group">
									Country <font color="#FF0000">*</font>
									<select name="country" id="country" onChange="loadstate(this.value)" class="form-control">
										<option value="">Select Country</option>
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

								<div class="col-md-4 form-group">
									State <font color="#FF0000">*</font>
									<span id='loadstate'><select name="state" id="state" class="form-control">
											<option value="">Select</option>
											<?php
											$sql3 = "SELECT * FROM state where status='Active'";
											$qsql3 = mysqli_query($con, $sql3);
											while ($rssql3 = mysqli_fetch_array($qsql3)) {
												if ($rssql3[state_id] == $rsedit[state_id]) {
													echo "<option value='$rssql3[state_id]' selected>$rssql3[state]</option>";
												} else {
													echo "<option value='$rssql3[state_id]'>$rssql3[state]</option>";
												}
											}
											?>
										</select></span>
								</div>

								<div class="col-md-4 form-group">
									City <font color="#FF0000">*</font>
									<span id='loadcity'><select name="city" id="city" class="form-control">
											<option value="">Select</option>
											<?php
											$sql2 = "SELECT * FROM city where status='Active'";
											$qsql2 = mysqli_query($con, $sql2);
											while ($rssql2 = mysqli_fetch_array($qsql2)) {
												if ($rssql2[city_id] == $rsedit[city_id]) {
													echo "<option value='$rssql2[city_id]' selected>$rssql2[city]</option>";
												} else {
													echo "<option value='$rssql2[city_id]'>$rssql2[city]</option>";
												}
											}
											?>
										</select></span>
								</div>


								<div class="col-md-6 form-group">
									Pin code <font color="#FF0000">*</font>
									<input type="number" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									Contact Number <font color="#FF0000">*</font>
									<input type="number" name="contactnumber" id="contactnumber" value="<?php echo $rsedit[customer_contact_number]; ?>" class="form-control">
								</div>

							</div>

							<hr>
							<button type="submit" name="submit" id="submit" class="btn btn-info btn-lg btn-block">Submit</button>

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
	function validateprodpurchasebill() {
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers

		if (document.frmprodpurchasebill.customername.value == "") {
			alert("Customer name should not be empty..");
			document.frmprodpurchasebill.customername.focus();
			return false;
		} else if (!document.frmprodpurchasebill.customername.value.match(alphaspaceExp)) {
			alert("Please enter only letters Customer name..");
			document.frmprodpurchasebill.customername.focus();
			return false;
		} else if (document.frmprodpurchasebill.customeraddress.value == "") {
			alert("Customer address should not be empty..");
			document.frmprodpurchasebill.customeraddress.focus();
			return false;
		} else if (document.frmprodpurchasebill.country.value == "") {
			alert("Kindly select the country..");
			document.frmprodpurchasebill.country.focus();
			return false;
		} else if (document.frmprodpurchasebill.state.value == "") {
			alert("Kindly select the state..");
			document.frmprodpurchasebill.state.focus();
			return false;
		} else if (document.frmprodpurchasebill.city.value == "") {
			alert("Kindly select the city..");
			document.frmprodpurchasebill.city.focus();
			return false;
		} else if (document.frmprodpurchasebill.pincode.value == "") {
			alert("Kindly enter PIN Code..");
			document.frmprodpurchasebill.pincode.focus();
			return false;
		} else if (document.frmprodpurchasebill.contactnumber.value == "") {
			alert("Kindly enter Contact number..");
			document.frmprodpurchasebill.contactnumber.focus();
			return false;
		} else {
			return true;
		}
	}
</script>