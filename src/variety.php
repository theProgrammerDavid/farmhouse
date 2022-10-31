<?php
include("header.php");
include("dbconnection.php");

if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {

		$imgname1 = rand() . $_FILES[img][name];
		move_uploaded_file($_FILES[img][tmp_name], "imgvariety/" . $imgname1);

		if (isset($_GET[editid])) {
			$sql = "UPDATE variety SET  `category_id`='$_POST[category]', `produce_id`='$_POST[produce]', `variety`='$_POST[variety]', `description`='$_POST[description]', `img`='$imgname1', `status`='Active'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Variety record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO `variety`(`variety_id`, `category_id`, `produce_id`, `variety`, `description`, `img`, `status`) VALUES ('','$_POST[category]','$_POST[produce]','$_POST[variety]','$_POST[description]','$imgname1','Active')";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Variety record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM variety WHERE variety_id='$_GET[editid]'";
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
				<h3>Variety</h3>
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
							<h4><?php echo " <h2>Add or Edit Variety</h2>"; ?></h4>
						</center>
						<hr>

						<form method="post" action="" enctype="multipart/form-data" name="frmvariety" onSubmit="return validatevariety()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">

								<div class="col-md-12 form-group">
									Category <font color="#FF0000">*</font>
									<select name="category" id="category" onchange="showproduce(this.value)" autofocus class="form-control">
										<option value="">Select</option>
										<?php
										$sql1 = "SELECT * FROM category where status='Active'";
										if (isset($_GET[varietytype])) {
											$sql1 = $sql1 . " and category_type='$_GET[varietytype]'";
										}
										$qsql1 = mysqli_query($con, $sql1);
										while ($rssql1 = mysqli_fetch_array($qsql1)) {
											if ($rssql1[category_id] == $rsedit[category_id]) {
												echo "<option value='$rssql1[category_id]' selected>$rssql1[category]</option>";
											} else {
												echo "<option value='$rssql1[category_id]'>$rssql1[category]</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="col-md-12 form-group">
									Produce <font color="#FF0000">*</font>

									<div id="txtHint">
										<select name="produce" id="produce" class="form-control">
											<option value="">Select</option>
											<?php
											$sql1 = "SELECT * FROM produce where status='Active'";
											$qsql1 = mysqli_query($con, $sql1);
											while ($rssql1 = mysqli_fetch_array($qsql1)) {
												if ($rssql1[produce_id] == $rsedit[produce_id]) {
													echo "<option value='$rssql1[produce_id]' selected>$rssql1[produce]</option>";
												} else {
													echo "<option value='$rssql1[produce_id]'>$rssql1[produce]</option>";
												}
											}
											?>
										</select>
									</div>
								</div>

								<div class="col-md-12 form-group">
									Variety <font color="#FF0000">*</font>
									<input type="text" name="variety" id="variety" value="<?php echo $rsedit[variety]; ?>" class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Description <font color="#FF0000">*</font>
									<textarea name="description" id="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
								</div>

								<div class="col-md-12 form-group">
									Image <font color="#FF0000">*</font>
									<input type="file" name="img" id="img" class="form-control">
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
	function showproduce(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "<select name='category' id='category'><option value=''>Select</option></select>";
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
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "ajaxproduce.php?q=" + str, true);
			xmlhttp.send();
		}
	}


	function validatevariety() {
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space

		if (document.frmvariety.category.value == "") {
			alert("Kindly select the category..");
			document.frmvariety.category.focus();
			return false;
		} else if (document.frmvariety.produce.value == "") {
			alert("Kindly select the produce..");
			document.frmvariety.produce.focus();
			return false;
		} else if (document.frmvariety.img.value == "") {
			alert("Kindly select an image..");
			document.frmvariety.img.focus();
			return false;
		} else {
			return true;
		}
	}
</script>