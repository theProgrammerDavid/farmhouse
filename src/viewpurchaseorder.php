<?php
include("header.php");
include("dbconnection.php");
if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM purchase_request WHERE purchase_request_id='$_GET[deleteid]'";
	if (!mysqli_query($con, $sql)) {
		echo "<script>alert('Failed to delete record'); </script>";
	} else {
		echo "<script>alert('This record deleted successfully..'); </script>";
	}
}

?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" style="padding-bottom:0px;">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3 style="color:black;">View Purchase Order</h3>
			</div>

		</div>
	</section><!-- End Cta Section -->


	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<div class="row">


				<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
					<div class="info mt-4 ">


						<?php
						$sql = "SELECT * FROM `purchase_order` WHERE seller_id='$_SESSION[sellerid]' ORDER BY purchase_order_id DESC ";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no Purchase Order to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th><strong>Product</strong></th>
										<th><strong>Customer Name</strong></th>
										<th><strong>Request Date</strong></th>
										<th><strong>Amount</strong></th>
										<th><strong>Quantity</strong></th>
										<th><strong>Status</strong></th>
									</tr>
								</THEAD>
								<TBODY>
									<?php

									while ($rs = mysqli_fetch_array($qsql)) {

										$sql1 = "SELECT * FROM product WHERE product_id='$rs[product_id]'";
										$qsql1 = mysqli_query($con, $sql1);
										$rs1 = mysqli_fetch_array($qsql1);


										$sql2 = "SELECT * FROM customer WHERE customer_id='$rs[customer_id]'";
										$qsql2 = mysqli_query($con, $sql2);
										$rs2 = mysqli_fetch_array($qsql2);

										echo "
						    <tr>
						      <td>&nbsp;$rs1[title]</td>
						      <td>&nbsp;$rs2[customer_name]</td>
						      <td>&nbsp;$rs[purchase_order_date]</td>
						      <td>&nbsp;$rupeesymbol $rs[purchase_amt]</td>
						      <td>&nbsp;$rs[quantity] $rs1[quantity_type]	</td>
						      <td>&nbsp;$rs[status]</td>
					        </tr>";
									}
									?>
								</TBODY>
							</table>
						<?php
						}
						?>
					</div>
				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
include("footer.php");
?>