<?php
include("header.php");
include("dbconnection.php");
if (!isset($_SESSION['customerid']) && !isset($_SESSION['sellerid'])) {
	echo "<script>window.location='customerloginpanel.php'; </script>";
}
if ($_GET[delid]) {
	$sql = "DELETE FROM product_purchase_record WHERE purchase_record_id='$_GET[delid]'";
	$qsql = mysqli_query($con, $sql);
	if (mysqli_affected_rows($con)  >= 1) {
		echo "<script>alert('Product deleted from cart');</script>";
	}
}
if (isset($_GET[prodid])) {
	if (isset($_SESSION[customerid])) {
		$sql = "DELETE FROM product_purchase_record WHERE selling_prod_id='$_GET[prodid]' AND status='Pending' AND customer_id='$_SESSION[customerid]'";
		$qsql = mysqli_query($con, $sql);
	}
	if (isset($_SESSION[sellerid])) {
		$sql = "DELETE FROM product_purchase_record WHERE selling_prod_id='$_GET[prodid]' AND status='Pending' AND seller_id='$_SESSION[sellerid]'";
		$qsql = mysqli_query($con, $sql);
	}
	$sql = "INSERT INTO product_purchase_record(product_purchase_bill_id, selling_prod_id,customer_id, quantity, cost, status,seller_id) VALUES ('0','$_GET[prodid]','$_SESSION[customerid]','1','$_GET[prodcost]','Pending','$_SESSION[sellerid]')";
	$qsql = mysqli_query($con, $sql);
	echo "<script>alert('Product added to the cart');</script>";
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>My Cart</h3>
			</div>

		</div>
	</section><!-- End Cta Section -->


	<form id="form1" name="form1" method="post" action="buyproduct.php">
		<!-- ======= Contact Section ======= -->
		<section id="contact" class="contact">
			<div class="container">
				<div class="row">


					<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
						<div class="info mt-4 ">

							<center>
								<h4>Update your Cart before payment...</h4>
							</center>
							<hr>

							<?php
							$i = 1;
							$sql = "SELECT * FROM product_purchase_record where customer_id='$_SESSION[customerid]' AND status='Pending'";
							$qsql = mysqli_query($con, $sql);
							if (mysqli_num_rows($qsql)  == 0) {
								echo "<center>Empty Cart</center>";
							} else {
							?>
								<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
									<THEAD>
										<tr>
											<th scope="row"><strong>&nbsp;Select</strong></th>
											<th scope="row"><strong>&nbsp;Image</strong></th>
											<th><strong>&nbsp;Product detail</strong></th>
											<th><strong>&nbsp;Product Cost</strong></th>
											<th><strong>&nbsp;Quantity</strong></th>
											<th><strong>&nbsp;Total</strong></th>
											<th><strong>&nbsp;Delete</strong></th>
										</tr>
									</THEAD>
									<TBODY>
										<?php
										while ($rs = mysqli_fetch_array($qsql)) {
											$sql1 = "SELECT * FROM selling_product WHERE selling_prod_id='$rs[selling_prod_id]'";
											$qsql1 = mysqli_query($con, $sql1);
											$rs1 = mysqli_fetch_array($qsql1);
											echo "
                        <tr>
                        <td>&nbsp;<input type='checkbox' name='buyingproduct[]' value='$rs[purchase_record_id]' checked></td>
                        <td>&nbsp;<img src='imgsellingproduct/$rs1[product_img1]' width='75' height='100'></td>
                          <td>&nbsp;$rs1[product_description]</td>
                          <td>&nbsp; $rs[cost]</td>
                          <td>&nbsp;<input type='text' name='productcart' value='$rs[quantity]' size='3' onkeyup='changecost(this.value,$rs[purchase_record_id],$i)' /> $rs1[quantity_type]</td>
                          <td>&nbsp;<span id='calccost$i'>" . $rs[cost] * $rs[quantity] . "</span></td>
                          <td>&nbsp; <a href='displaycart.php?delid=$rs[purchase_record_id]' onclick='return delconfirm()' class='btn btn-danger'>X</a></td>					  
                        </tr>";
											$i++;
										}
										?>
									</TBODY>
								</table>
							<?php
							}
							?>
							<hr>
							<center>
								<input type="submit" name="submit" id="submit" value="Confirm your order" autofocus class="btn btn-success">
							</center>
						</div>
					</div>

				</div>

			</div>
		</section><!-- End Contact Section -->
	</form>

</main><!-- End #main -->

<?php
include("footer.php");
?>
<script type="application/javascript">
	function changecost(totqty, purchaseid, divid) {
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("calccost" + divid).innerHTML = xmlhttp.responseText;
			}
		};
		xmlhttp.open("GET", "ajaxupdatecart.php?totqty=" + totqty + "&purchaseid=" + purchaseid + "&divid=" + divid, true);
		xmlhttp.send();
	}

	function delconfirm() {
		if (confirm("Are you sure want to delete this cart item?") == true) {
			return true;
		} else {
			return false;
		}
	}
</script>