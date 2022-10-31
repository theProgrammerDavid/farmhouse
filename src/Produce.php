<?php
include("header.php");
include("dbconnection.php");

if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		$imgname1 = rand() . $_FILES[img][name];
		move_uploaded_file($_FILES[img][tmp_name], "imgproduce/" . $imgname1);

		if (isset($_GET[editid])) {
			$sql = "UPDATE produce SET  `category_id`='$_POST[category]', `produce`='$_POST[produce]', `description`='$_POST[description]', `img`='$imgname1', `status`='$_POST[status]'  WHERE produce_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query" . mysqli_error($con);
			} else {
				echo "<script>alert('Produce record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO `produce`(`produce_id`, `category_id`, `produce`, `description`, `img`, `status`) VALUES ('','$_POST[category]','$_POST[produce]','$_POST[description]','$imgname1','$_POST[status]')";

			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query" . mysqli_error($con);
			} else {
				echo "<script>alert('Produce record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM produce WHERE produce_id='$_GET[editid]'";
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
				<h3 style="color:black;">Produce</h3>
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
							<h4>Enter Produce Detail...</h4>
						</center>
						<hr>

						<form method="post" action="" enctype="multipart/form-data" name="frmproduce" onSubmit="return validateproduce()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">

								<div class="col-md-12 form-group">
									Category <font color="#FF0000">*</font>
									<select name="category" id="category" autofocus class="form-control">
										<option value="">Select</option>
										<?php
										$sql2 = "SELECT * FROM category where status='Active' AND category_type='Produce'";
										$qsql2 = mysqli_query($con, $sql2);
										while ($rssql2 = mysqli_fetch_array($qsql2)) {
											if ($rssql2[category_id] == $rsedit[category_id]) {
												echo "<option value='$rssql2[category_id]' selected>$rssql2[category]</option>";
											} else {
												echo "<option value='$rssql2[category_id]'>$rssql2[category]</option>";
											}
										}
										?>
									</select>
								</div>

								<div class="col-md-12 form-group">
									Produce <font color="#FF0000">*</font>
									<input type="text" name="produce" id="produce" value="<?php echo $rsedit[produce]; ?>" class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Image <font color="#FF0000">*</font>
									<input type="file" name="img" id="img" class="form-control">
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
	function validateproduce() {
		if (document.frmproduce.category.value == "") {
			alert("Kindly select the category..");
			document.frmproduce.category.focus();
			return false;
		} else if (document.frmproduce.produce.value == "") {
			alert("Produce should not be blank..");
			document.frmproduce.produce.focus();
			return false;
		} else if (!document.frmproduce.produce.value.match(alphaspaceExp)) {
			alert("Please enter only letters for produce..");
			document.frmproduce.produce.focus();
			return false;
		} else if (document.frmproduce.img.value == "") {
			alert("Select an image..");
			document.frmproduce.img.focus();
			return false;
		} else {
			return true;
		}
	}
</script>