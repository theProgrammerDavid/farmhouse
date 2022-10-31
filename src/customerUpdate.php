<?php
if (!isset($_SESSION)) {
	session_start();
}
include("header.php");
include("dbconnection.php");
if (!isset($_SESSION[customerid])) {
	echo "<script>window.location='index.php';</script>";
}
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		$sql = "UPDATE customer SET  `customer_name`='$_POST[customername]', `address`='$_POST[address]', `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city_id`='$_POST[city]', `pincode`='$_POST[pincode]', `contact_no`='$_POST[cntctnum]', `mobile_no`='$_POST[mblnum]', `email_id`='$_POST[email_id]', `password`='$_POST[password]', `customer_type`='$_POST[customertype]', `status`='$_POST[status]' WHERE customer_id='$_SESSION[customerid]'";
		if (!mysqli_query($con, $sql)) {
			echo "Error in mysqli query";
		} else {
			echo "<script>alert('Customer record updated successfully...');</script>";
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_SESSION[customerid])) {
	$sql = "SELECT * FROM customer WHERE customer_id='$_SESSION[customerid]'";
	$qsql = mysqli_query($con, $sql);
	$rsedit = mysqli_fetch_array($qsql);
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3 style="color:black;">Customer Profile</h3>
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
							<h4>Keep Your Profile Updated Here..</h4>
						</center>

						<form method="post" action="" name="frmcstupdate" onsubmit="return validatecstupdate()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">
								<div class="col-md-6 form-group">
									Customer Name <font color="#FF0000">*</font>
									<input type="text" name="customername" id="customername" value="<?php echo $rsedit[customer_name]; ?>" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									Email ID <font color="#FF0000">*</font>
									<input type="email" name="email_id" id="email_id" value="<?php echo $rsedit[email_id]; ?>" class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Address <font color="#FF0000">*</font>
									<textarea name="address" id="address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
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
									<span id='loadstate'><select name="state" id="state" class="form-control">
											<option value="">Select</option>
											<?php
											$sql2 = "SELECT * FROM state where status='Active'";
											$qsql2 = mysqli_query($con, $sql2);
											while ($rssql2 = mysqli_fetch_array($qsql2)) {
												if ($rssql2[state_id] == $rsedit[state_id]) {
													echo "<option value='$rssql2[state_id]' selected>$rssql2[state]</option>";
												} else {
													echo "<option value='$rssql2[state_id]'>$rssql2[state]</option>";
												}
											}
											?>
										</select></span>
								</div>

								<div class="col-md-6 form-group">
									City <font color="#FF0000"> *</font>
									<span id='loadcity'><select name="city" id="city" class="form-control">
											<option value="">Select</option>
											<?php
											$sql3 = "SELECT * FROM city where status='Active'";
											$qsql3 = mysqli_query($con, $sql3);
											while ($rssql3 = mysqli_fetch_array($qsql3)) {
												if ($rssql3[city_id] == $rsedit[city_id]) {
													echo "<option value='$rssql3[city_id]' selected>$rssql3[city]</option>";
												} else {
													echo "<option value='$rssql3[city_id]'>$rssql3[city]</option>";
												}
											}
											?>
										</select></span>
								</div>

								<div class="col-md-6 form-group">
									Pincode <font color="#FF0000"> *</font>
									<input type="number" name="pincode" id="pincode" value="<?php echo $rsedit[pincode]; ?>" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									Contact Number <font color="#FF0000"> *</font>
									<input type="number" name="cntctnum" id="cntctnum" value="<?php echo $rsedit[contact_no]; ?>" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									Mobile Number <font color="#FF0000"> *</font>
									<input type="number" name="mblnum" id="mblnum" value="<?php echo $rsedit[mobile_no]; ?>" class="form-control">
								</div>

								<div class="col-md-6 form-group">
									Customer Type <font color="#FF0000"> *</font>
									<select name="customertype" id="customertype" class="form-control">
										<option value="">Select</option>
										<?php
										$arr = array("Wholesaler", "Retailer", "Consumer");
										foreach ($arr as $val) {
											if ($rsedit[customer_type] == $val) {
												echo "<option value='$val' selected >$val</option>";
											} else {
												echo "<option value='$val'>$val</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="col-md-6 form-group">
									<?php
									if (isset($_SESSION[adminid])) {
									?>
										Status <font color="#FF0000"> *</font>
										<select name="status" id="status">
											<option value="">Select</option>
											<?php
											$arr = array("Active", "Inactive");
											foreach ($arr as $val) {
												if ($rsedit[status] == $val) {
													echo "<option value='$val' selected >$val<option>";
												} else {
													echo "<option value='$val'>$val<option>";
												}
											}
											?>
										</select>
									<?php
									} else {
									?>
										<input type="hidden" name="status" value="Active">
									<?php
									}
									?>
								</div>
							</div>

							<hr>
							<button type="submit" name="submit" id="submit" class="btn btn-info btn-lg btn-block">Update Profile</button>

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
<script>
	$(document).ready(function() {
		$('#datatable').DataTable();
	});
</script>