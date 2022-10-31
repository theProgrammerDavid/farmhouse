<?php
include("header.php");
include("dbconnection.php");
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		$imgname1 = rand() . $_FILES[img1][name];
		move_uploaded_file($_FILES[img1][tmp_name], "imgsellingproduct/" . $imgname1);
		$imgname2 = rand() . $_FILES[img2][name];
		move_uploaded_file($_FILES[img2][tmp_name], "imgsellingproduct/" . $imgname2);
		$imgname3 = rand() . $_FILES[img3][name];
		move_uploaded_file($_FILES[img3][tmp_name], "imgsellingproduct/" . $imgname3);
		$imgname4 = rand() . $_FILES[img4][name];
		move_uploaded_file($_FILES[img4][tmp_name], "imgsellingproduct/" . $imgname4);
		$imgname5 = rand() . $_FILES[img5][name];
		move_uploaded_file($_FILES[img5][tmp_name], "imgsellingproduct/" . $imgname5);

		if (isset($_GET[editid])) {
			$sql = "UPDATE selling_product SET  `category_id`='$_POST[category]', `product_name`='$_POST[productname]', `product_description`='$_POST[productdescription]', `product_img1`='$imgname1', `product_img2`='$imgname2', `product_img3`='$imgname3', `product_img4`='$imgname4', `product_img5`='$imgname5', `cost`='$_POST[cost]',`quantity_type`='$_POST[quantitytype]', `status`='Active' WHERE selling_prod_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Selling Product record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO `selling_product`(`category_id`, `product_name`, `product_description`,  `product_img1`,";
			if ($_FILES[img2][name] != "") {
				$sql = $sql . "  `product_img2`, ";
			}
			if ($_FILES[img3][name] != "") {
				$sql = $sql . " `product_img3`, ";
			}
			if ($_FILES[img4][name] != "") {
				$sql = $sql . " `product_img4`, ";
			}
			if ($_FILES[img5][name] != "") {
				$sql = $sql . " `product_img5`,";
			}
			$sql = $sql . "  `cost`,`quantity_type`, `status`) VALUES ('$_POST[category]','$_POST[productname]','$_POST[productdescription]','$imgname1',";
			if ($_FILES[img2][name] != "") {
				$sql = $sql . " '$imgname2',";
			}
			if ($_FILES[img3][name] != "") {
				$sql = $sql . " '$imgname3',";
			}
			if ($_FILES[img4][name] != "") {
				$sql = $sql . " '$imgname4',";
			}
			if ($_FILES[img5][name] != "") {
				$sql = $sql . " '$imgname5',";
			}
			$sql = $sql . "'$_POST[cost]','$_POST[quantitytype]','Active')";

			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query" . mysqli_error($con);
			} else {
				echo "<script>alert('Selling Product record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM selling_product WHERE selling_prod_id='$_GET[editid]'";
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
				<h3>Farmer's Kit</h3>
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
							<h4>Enter Farmer's Kit record...</h4>
						</center>
						<hr>

						<form method="post" action="" enctype="multipart/form-data" name="frmsellingproduct" onSubmit="return validatesellingproduct()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">

								<div class="col-md-6 form-group">
									Category <font color="#FF0000">*</font>
									<select name="category" id="category" autofocus class="form-control">
										<option value="">Select</option>
										<?php
										$sql1 = "SELECT * FROM category where status='Active' AND category_type='SellingProduct'";
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

								<div class="col-md-6 form-group">
									Product Name <font color="#FF0000">*</font>
									<input type="text" name="productname" id="productname" value="<?php echo $rsedit[product_name]; ?>" class="form-control">
								</div>


								<div class="col-md-12 form-group">
									Product Description <font color="#FF0000">*</font>
									<textarea name="productdescription" id="productdescription" class="form-control"><?php echo $rsedit[product_description]; ?></textarea>
								</div>



								<div class="col-md-6 form-group">
									Image 1 (Primary image) <font color="#FF0000">*</font>
									<input type="file" name="img1" id="img1" class="form-control">
								</div>
								<div class="col-md-6 form-group">
									Image 2<font color="#FF0000">*</font>
									<input type="file" name="img2" id="img2" class="form-control">
								</div>
								<div class="col-md-6 form-group">
									Image 3<font color="#FF0000">*</font>
									<input type="file" name="img3" id="img3" class="form-control">
								</div>
								<div class="col-md-6 form-group">
									Image 4<font color="#FF0000">*</font>
									<input type="file" name="img4" id="img4" class="form-control">
								</div>
								<div class="col-md-6 form-group">
									Image 5<font color="#FF0000">*</font>
									<input type="file" name="img5" id="img5" class="form-control">
								</div>

								<div class="col-md-6 form-group">

								</div>

								<div class="col-md-6 form-group">
									Quantity Type <font color="#FF0000">*</font>
									<select name="quantitytype" id="quantitytype" autofocus class="form-control">
										<option value="">Select</option>
										<?php
										$arr = array("Kilogram", "Gram", "Piece");
										foreach ($arr as $val) {
											if ($rsedit[quantity_type] == $val) {
												echo "<option value='$val' selected >$val</option>";
											} else {
												echo "<option value='$val'>$val</option>";
											}
										}
										?>
									</select>
								</div>


								<div class="col-md-6 form-group">
									Cost <font color="#FF0000">*</font>
									<input type="text" name="cost" id="cost" value="<?php echo $rsedit[cost]; ?>" class="form-control">
								</div>

								<div class="col-md-6 form-group">
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
	function validatesellingproduct() {
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		if (document.frmsellingproduct.category.value == "") {
			alert("Kindly select the category..");
			document.frmsellingproduct.category.focus();
			return false;
		} else if (document.frmsellingproduct.productname.value == "") {
			alert("Product name should not be blank..");
			document.frmsellingproduct.productname.focus();
			return false;
		} else if (!document.frmsellingproduct.productname.value.match(alphaspaceExp)) {
			alert("Please enter only letters for product name..");
			document.frmsellingproduct.productname.focus();
			return false;
		} else if (document.frmsellingproduct.img1.value == "") {
			alert("Select at least one image..");
			document.frmsellingproduct.img1.focus();
			return false;
		} else if (document.frmsellingproduct.cost.value == "") {
			alert("Cost should not be blank..");
			document.frmsellingproduct.cost.focus();
			return false;
		} else {
			return true;
		}
	}
</script>