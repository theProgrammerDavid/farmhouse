<?php
include("header.php");
include("dbconnection.php");


if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_POST[submit])) {
		$dt = date("Y-m-d");
		$imgname1 = rand() . $_FILES[img1][name];
		move_uploaded_file($_FILES[img1][tmp_name], "imgproduct/" . $imgname1);
		$imgname2 = rand() . $_FILES[img2][name];
		move_uploaded_file($_FILES[img2][tmp_name], "imgproduct/" . $imgname2);
		$imgname3 = rand() . $_FILES[img3][name];
		move_uploaded_file($_FILES[img3][tmp_name], "imgproduct/" . $imgname3);
		$imgname4 = rand() . $_FILES[img4][name];
		move_uploaded_file($_FILES[img4][tmp_name], "imgproduct/" . $imgname4);
		$imgname5 = rand() . $_FILES[img5][name];
		move_uploaded_file($_FILES[img5][tmp_name], "imgproduct/" . $imgname5);

		if (isset($_GET[editid])) {
			$sql = "UPDATE product SET  seller_id='$_SESSION[sellerid]', category_id='$_POST[category]', produce_id='$_POST[produce]', variety_id='$_POST[variety]', title='$_POST[title]', img_1='$imgname1', img_2='$imgname2', img_3='$imgname3', img_4='$imgname4', img_5='$imgname5', quantity='$_POST[quantity]', quantity_type='$_POST[quantitytype]', description='$_POST[description]', uploaded_date='$_POST[uploaddate]', status='$_POST[status]' WHERE product_id='$_GET[editid]'";
			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Product record updated successfully...');</script>";
			}
		} else {
			$sql = "INSERT INTO product(seller_id, category_id, produce_id, variety_id, title, img_1, img_2, img_3, img_4, img_5, quantity, quantity_type, description, uploaded_date, status) VALUES (";
			if (isset($_SESSION[sellerid])) {
				$sql = $sql . " '$_SESSION[sellerid]'";
			} else {
				$sql = $sql . "'" . $_POST[sellerid] . "'";
			}
			$sql = $sql . " ,'$_POST[category]','$_POST[produce]','$_POST[variety]','$_POST[title]','$imgname1','$imgname2','$imgname3','$imgname4','$imgname5','$_POST[quantity]','$_POST[quantitytype]','$_POST[description]','$dt','$_POST[status]')";

			if (!mysqli_query($con, $sql)) {
				echo "Error in mysqli query";
			} else {
				echo "<script>alert('Product record inserted successfully...');</script>";
			}
		}
	}
}
$randnumber = rand();
$_SESSION[randnumber] = $randnumber;
if (isset($_GET[editid])) {
	$sql = "SELECT * FROM product WHERE product_id='$_GET[editid]'";
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
				<h3>Farm Produce</h3>
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
							<h4>Enter Farm Produce Detail...</h4>
						</center>
						<hr>

						<form method="post" action="" enctype="multipart/form-data" name="frmsellingproduce" onSubmit="return validatesellingproduce()">
							<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">

							<div class="form-row">

								<?php
								if (isset($_SESSION[adminid])) {
								?>
									<div class="col-md-12 form-group">
										Seller Name <font color="#FF0000">*</font>
										<select name="sellerid" id="sellerid" autofocus class="form-control">
											<option value="">Select Status</option>
											<?php
											$sql2 = "SELECT * FROM seller where status='Active'";
											$qsql2 = mysqli_query($con, $sql2);
											while ($rssql2 = mysqli_fetch_array($qsql2)) {
												if ($rssql2[seller_id] == $rsedit[seller_id]) {
													echo "<option value='$rssql2[seller_id]' selected>$rssql2[seller_name] ( $rssql2[email_id] )</option>";
												} else {
													echo "<option value='$rssql2[seller_id]'>$rssql2[seller_name] ( $rssql2[email_id] )</option>";
												}
											}
											?>
										</select>
									</div>
								<?php
								}
								?>

								<div class="col-md-12 form-group">
									Category <font color="#FF0000">*</font>
									<select name="category" id="category" onchange="showUser(this.value)" class="form-control">
										<option value="">Select</option>
										<?php
										$sql2 = "SELECT * FROM category where status='Active' AND category_type='Produce' ";
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
									<div id="txtHint"><select name="produce" id="produce" onchange="showUser1(this.value)" class="form-control">
											<option value="">Select</option>
											<?php
											$sql3 = "SELECT * FROM produce where status='Active'";
											$qsql3 = mysqli_query($con, $sql3);
											while ($rssql3 = mysqli_fetch_array($qsql3)) {
												if ($rssql3[produce_id] == $rsedit[produce_id]) {
													echo "<option value='$rssql3[produce_id]' selected>$rssql3[produce]</option>";
												} else {
													echo "<option value='$rssql3[produce_id]'>$rssql3[produce]</option>";
												}
											}
											?>
										</select></div>
								</div>


								<div class="col-md-12 form-group">
									Variety <font color="#FF0000">*</font>
									<div id="txtHint1"><select name="variety" id="variety" class="form-control">
											<option value="">Select</option>
											<?php
											$sql4 = "SELECT * FROM variety where status='Active'";
											$qsql4 = mysqli_query($con, $sql4);
											while ($rssql4 = mysqli_fetch_array($qsql4)) {
												if ($rssql4[variety_id] == $rsedit[variety_id]) {
													echo "<option value='$rssql4[variety_id]' selected>$rssql4[variety]</option>";
												} else {
													echo "<option value='$rssql4[variety_id]'>$rssql4[variety]</option>";
												}
											}
											?>
										</select></div>
								</div>

								<div class="col-md-12 form-group">
									Title <font color="#FF0000">*</font>
									<input type="text" name="title" id="title" value="<?php echo $rsedit[title]; ?>" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Image 1 <font color="#FF0000">*</font>
									<input type="file" name="img1" id="img1" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Image 2 <font color="#FF0000">*</font>
									<input type="file" name="img2" id="img2" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Image 3 <font color="#FF0000">*</font>
									<input type="file" name="img3" id="img3" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Image 4 <font color="#FF0000">*</font>
									<input type="file" name="img4" id="img4" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Image 5 <font color="#FF0000">*</font>
									<input type="file" name="img5" id="img5" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Quantity <font color="#FF0000">*</font>
									<input type="number" name="quantity" id="quantity" autofocus class="form-control">
								</div>

								<div class="col-md-12 form-group">
									Quantity Type <font color="#FF0000">*</font>
									<select name="quantitytype" id="quantitytype" class="form-control">
										<option value="">Select quantity type</option>
										<?php
										$arr = array("Kilogram", "Gram", "Quintal");
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
<script>
	function showUser(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
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

	function showUser1(str) {
		if (str == "") {
			document.getElementById("txtHint1").innerHTML = "";
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
					document.getElementById("txtHint1").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "ajaxvariety.php?q=" + str, true);
			xmlhttp.send();
		}
	}
</script>
<script type="application/javascript">
	function validatesellingproduce() {
		var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID

		if (document.frmsellingproduce.sellerid.value == "") {
			alert("Kindly select a seller name..");
			document.frmsellingproduce.sellerid.focus();
			return false;
		} else if (document.frmsellingproduce.category.value == "") {
			alert("Kindly select a category..");
			document.frmsellingproduce.cateory.focus();
			return false;
		} else if (document.frmsellingproduce.produce.value == "") {
			alert("Kindly select a produce..");
			document.frmsellingproduce.produce.focus();
			return false;
		} else if (document.frmsellingproduce.variety.value == "") {
			alert("Kindly select a variety..");
			document.frmsellingproduce.variety.focus();
			return false;
		} else if (document.frmsellingproduce.title.value == "") {
			alert("Title should not be blank..");
			document.frmsellingproduce.title.focus();
			return false;
		} else if (document.frmsellingproduce.img1.value == "") {
			alert("Kindly upload at least one image..");
			document.frmsellingproduce.img1.focus();
			return false;
		} else if (document.frmsellingproduce.quantity.value == "") {
			alert("Quantity should not be blank..");
			document.frmsellingproduce.quantity.focus();
			return false;
		} else if (document.frmsellingproduce.quantitytype.value == "") {
			alert("Kindly select a quantity type..");
			document.frmsellingproduce.quantitytype.focus();
			return false;
		} else {
			return true;
		}
	}
</script>