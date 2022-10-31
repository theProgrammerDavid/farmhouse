<?php
include("header.php");
include("dbconnection.php");

if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {

		if (isset($_GET[editid])) {
			$sql = "UPDATE state SET `country_id`='$_POST[country]', `state`='$_POST[state]', `description`='$_POST[description]', `status`='Active' where state_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('State record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO `state`(`state_id`, `country_id`, `state`, `description`, `status`) VALUES ('','$_POST[country]','$_POST[state]','$_POST[description]','Active')";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('State record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM state WHERE state_id='$_GET[editid]'";
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
				<h3>State</h3>
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
							<h4>Enter State Detail...</h4>
						</center>
						<hr>

						<form method="post" action="" name="frmstate" onSubmit="return validatestate()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">
								<div class="col-md-12 form-group">
									Country <font color="#FF0000">*</font>
									<select name="country" id="country" autofocus class="form-control">
										<option value="">Select Country</option>
										<?php
										$sql2 = "SELECT * FROM country where status='Active'";
										$qsql2 = mysqli_query($con, $sql2);
										while ($rssql2 = mysqli_fetch_array($qsql2)) {
											if ($rssql2[country_id] == $rsedit[country_id]) {
												echo "<option value='$rssql2[country_id]' selected>$rssql2[country]</option>";
											} else {
												echo "<option value='$rssql2[country_id]'>$rssql2[country]</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="col-md-12 form-group">
									State <font color="#FF0000">*</font>
									<input type="text" name="state" id="state" value="<?php echo $rsedit[state]; ?>" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Description <font color="#FF0000">*</font>
									<textarea name="description" id="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
								</div>

								<div class="col-md-12 form-group">
									Status <font color="#FF0000">*</font>
									<select name="status" id="status" class="form-control">
										<option value="">Select Status</option>
										<?php
										$arr = array("Active", "Inactive");
										foreach ($arr as $val) {
											if ($rsedit['status'] == $val) {
												echo "<option value='$val' selected >$val</option>";
											} else {
												echo "<option value='$val'>$val</option>";
											}
										}
										?>
									</select>
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
	function validatestate() {
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space

		if (document.frmstate.country.value == "") {
			alert("Kindly select the country..");
			document.frmstate.country.focus();
			return false;
		} else if (document.frmstate.state.value == "") {
			alert("State should not be blank..");
			document.frmstate.state.focus();
			return false;
		} else if (!document.frmstate.state.value.match(alphaspaceExp)) {
			alert("Please enter only letters for state..");
			document.frmstate.state.focus();
			return false;
		} else {
			return true;
		}
	}
</script>