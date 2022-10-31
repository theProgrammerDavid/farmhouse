<?php
include("header.php");
include("dbconnection.php");

if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		if (isset($_GET[editid])) {
			$sql = "UPDATE city SET  `country_id`='$_POST[country]', `state_id`='$_POST[state]', `city`='$_POST[city]', `description`='$_POST[description]', `status`='$_POST[status]' WHERE city_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('City record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO `city`(`city_id`, `country_id`, `state_id`, `city`, `description`, `status`) VALUES ('','$_POST[country]','$_POST[state]','$_POST[city]','$_POST[description]','$_POST[status]')";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query" . mysqli_error($con);
			} else {
				echo "<script>alert('City record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM city WHERE city_id='$_GET[editid]'";
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
				<h3>City</h3>
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
							<h4>Enter City record...</h4>
						</center>
						<hr>

						<form method="post" action="" name="frmcity" onSubmit="return validatecity()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">
								<div class="col-md-12 form-group">
									Country <font color="#FF0000">*</font>
									<select name="country" id="country" class="form-control" onChange="loadstate(this.value)" autofocus>
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
									<span id='loadstate'><select class="form-control"></select></span>
								</div>

								<div class="col-md-12 form-group">
									City <font color="#FF0000">*</font>
									<input type="text" name="city" id="city" class="form-control" value="<?php echo $rsedit[city]; ?>">
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
	function validatecity() {

		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		if (document.frmcity.country.value == "") {
			alert("Kindly select the country..");
			document.frmcity.country.focus();
			return false;
		} else if (document.frmcity.state.value == "") {
			alert("Kindly select the state..");
			document.frmcity.state.focus();
			return false;
		} else if (document.frmcity.city.value == "") {
			alert("Enter city..");
			document.frmcity.city.focus();
			return false;
		} else if (!document.frmcity.value.match(alphaspaceExp)) {
			alert("Please enter only letters for city name..");
			document.frmcity.city.focus();
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
</script>