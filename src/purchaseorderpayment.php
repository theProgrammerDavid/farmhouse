<?php
if (!isset($_SESSION)) {
	session_start();
}
include("header.php");
include("dbconnection.php");
if ($_SESSION[randnumber]  == $_POST[randnumber]) {
	if (isset($_GET[deleteid])) {
		$sql = "DELETE FROM purchase_request WHERE purchase_request_id='$_GET[deleteid]'";
		if (!mysqli_query($con, $sql)) {
			echo "<script>alert('Failed to delete record'); </script>";
		} else {
			echo "<script>alert('This record deleted successfully..'); </script>";
		}
	}
	if (isset($_POST['submit'])) {
		$sql = "SELECT * FROM purchase_order WHERE purchase_order_id='$_GET[purchaseorderid]'";
		$qsql = mysqli_query($con, $sql);
		$rspurchase_order = mysqli_fetch_array($qsql);
		$purchase_request_id = $rspurchase_order[purchase_request_id];

		$sql = "UPDATE purchase_request SET status='Paid' WHERE purchase_order_id='$purchase_request_id'";
		mysqli_query($con, $sql);

		$sql = "UPDATE purchase_order SET status='Paid' WHERE purchase_order_id='$_GET[purchaseorderid]'";
		mysqli_query($con, $sql);

		$sql = "UPDATE product SET quantity= quantity - $rspurchase_order[quantity] WHERE product_id='$rspurchase_order[product_id]'";
		mysqli_query($con, $sql);

		$sql = "INSERT INTO `purchase_order_bill`(purchase_order_id, `payment_type`, `payment_description`, `paid_date`, `paid_amt`, `status`) VALUES ('$_GET[purchaseorderid]','$_POST[paymenttype]','Card Holder name: $_POST[txtcardholdname] Card Number: $_POST[txtcardnumb] Expiry date: $_POST[txtexpirydate] CVV No.$_POST[txtcvv]','$dt','$_POST[txtpayment]','Active')";
		if (!mysqli_query($con, $sql)) {
			echo "Error in mysqli query" . mysqli_error($con);
		} else {
			$insid = mysqli_insert_id($con);
			$sqlsellerproduct = "SELECT * FROM product WHERE product_id='$rspurchase_order[product_id]'";
			$qsqlsellerproduct = mysqli_query($con, $sqlsellerproduct);
			$rssellerproduct = mysqli_fetch_array($qsqlsellerproduct);

			$sqlseller = "SELECT * FROM seller WHERE seller_id='$rssellerproduct[seller_id]'";
			$qsqlseller = mysqli_query($con, $sqlseller);
			$rsseller = mysqli_fetch_array($qsqlseller);
			echo "<script>alert('Payment Done successfully...');</script>";
		}
	}
}
$randnumber = rand();
$_SESSION['randnumber'] = $randnumber;
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>Purchase Order Payment</h3>
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
							<h4>Purchase Order Payment Detail...</h4>
						</center>
						<hr>

						<table class="table table-striped table-bordered" style="width:100%">
							<THEAD>
								<tr>
									<th height="25"><strong>Product</strong></th>
									<th><strong>Customer Name</strong></th>
									<th><strong>Request Date</strong></th>
									<th><strong>Amount</strong></th>
									<th><strong>Quantity</strong></th>
									<th><strong>Status</strong></th>
								</tr>
							</THEAD>
							<TBODY>
								<?php
								$sql = "SELECT * FROM `purchase_order` WHERE customer_id='$_SESSION[customerid]' AND purchase_order_id='$_GET[purchaseorderid]'";
								$qsql = mysqli_query($con, $sql);
								while ($rs = mysqli_fetch_array($qsql)) {
									$sql1 = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
									$qsql1 = mysqli_query($con, $sql1);
									$rs1 = mysqli_fetch_array($qsql1);

									$sql2 = "SELECT * FROM customer WHERE customer_id='$rs[customer_id]'";
									$qsql2 = mysqli_query($con, $sql2);
									$rs2 = mysqli_fetch_array($qsql2);

									$purchaseamt = $rs[purchase_amt];
									echo "
							  <tr> 
							      <td>&nbsp;$rs1[title]</td>
									  <td>&nbsp;$rs2[customer_name]</td>
									  <td>&nbsp;$rs[purchase_order_date]</td>
									  <td>&nbsp;$rupeesymbol $rs[purchase_amt]</td>
									  <td>&nbsp;$rs[quantity] $rs1[quantity_type]</td>
									  <td>&nbsp;$rs[status]</td>	
						      </tr>";
								}
								?>
							</TBODY>
						</table>
					</div>
				</div>

			</div>



			<div class="container">
				<div class="row">


					<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
						<div class="info mt-4 ">

							<center>
								<h4>Worker Request Entry</h4>
							</center>
							<hr>

							<form method="post" action="" name="frmorderpayment" onSubmit="return validateorderpayment()">
								<input type="hidden" name="randnumber" value="<?php echo $randnumber; ?>">
								<div class="form-row">
									<div class="col-md-6 form-group">
										Payment Type: <font color="#FF0000">*</font>
										<select name="paymenttype" id="select" autofocus class="form-control">
											<option value="">Select</option>
											<?php
											$arr = array("Visa", "Master Card", "Rupay");
											foreach ($arr as $val) {
												echo "<option value='$val'>$val</option>";
											}
											?>
										</select>
									</div>


									<div class="col-md-6 form-group">
										Card Holder Name <font color="#FF0000">*</font>
										<input type="text" name="txtcardholdname" id="txtcardholdname" class="form-control">
									</div>


									<div class="col-md-6 form-group">
										Card Number: <font color="#FF0000">*</font>
										<input type="number" name="txtcardnumb" id="txtcardnumb" class="form-control">
									</div>


									<div class="col-md-6 form-group">
										Expiry Date: <font color="#FF0000">*</font>
										<input type="month" name="txtexpirydate" id="txtexpirydate" class="form-control">
									</div>

									<div class="col-md-6 form-group">
										CVV Number: <font color="#FF0000">*</font>
										<input type="number" min="001" max="999" name="txtcvv" id="txtcvv" class="form-control">
									</div>

									<div class="col-md-6 form-group">
										Payment Amount: <font color="#FF0000">*</font>
										<input type="text" name="txtpayment" id="txtpayment" value="<?php echo $purchaseamt; ?>" readonly class="form-control">
									</div>


								</div>

								<hr>
								<button type="submit" name="submit" id="submit" class="btn btn-info btn-lg btn-block">Make Payment</button>

							</form>
						</div>
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
	function validateorderpayment() {

		var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
		var numericExpression = /^[0-9]+$/; //Variable to validate only numbers

		if (document.frmorderpayment.paymenttype.value == "") {
			alert("Kindly select a Payment Type..");
			document.frmorderpayment.paymenttype.focus();
			return false;
		} else if (document.frmorderpayment.txtcardholdname.value == "") {
			alert("Card holder name should not be empty..");
			document.frmorderpayment.txtcardholdname.focus();
			return false;
		} else if (!document.frmorderpayment.txtcardholdname.value.match(alphaspaceExp)) {
			alert("Please enter only letters for the Card Holder name..");
			document.frmorderpayment.txtcardholdname.focus();
			return false;
		} else if (document.frmorderpayment.txtcardnumb.value == "") {
			alert("Kindly enter Card Number..");
			document.frmorderpayment.txtcardnumb.focus();
			return false;
		} else if (document.frmorderpayment.txtcardnumb.value.length < 16) {
			alert("Kindly enter a valid 16 digit Card Number...");
			document.frmorderpayment.txtcardnumb.focus();
			return false;
		} else if (document.frmorderpayment.txtcardnumb.value.length > 16) {
			alert("Kindly enter a valid 16 digit Card Number...");
			document.frmorderpayment.txtcardnumb.focus();
			return false;
		} else if (document.frmorderpayment.txtexpirydate.value == "") {
			alert("Kindly select the Expiry Date...");
			document.frmorderpayment.txtexpirydate.focus();
			return false;
		} else if (document.frmorderpayment.txtcvv.value == "") {
			alert("Kindly enter CVV Number..");
			document.frmorderpayment.txtcvv.focus();
			return false;
		} else if (document.frmorderpayment.txtpayment.value == "") {
			alert("Kindly enter Payment Amount..");
			document.frmorderpayment.txtpayment.focus();
			return false;
		} else {
			return true;
		}
	}
</script>