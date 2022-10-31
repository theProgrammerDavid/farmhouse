<?php
include("header.php");
if ($_SESSION[customerid] != "" && $_SESSION[sellerid] != "") {
	echo "<script>window.location='customerloginpanel.php';</script>";
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>Agro Products Purchase Report</h3>
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
						if (isset($_SESSION[customerid])) {
							$sql = "SELECT * FROM product_purchase_bill where customer_id='$_SESSION[customerid]' ORDER BY product_purchase_bill_id DESC ";
						}
						if (isset($_SESSION[sellerid])) {
							$sql = "SELECT * FROM product_purchase_bill where seller_id='$_SESSION[sellerid]' ORDER BY product_purchase_bill_id DESC ";
						}
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no Purchase Report to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered ">
								<thead>
									<tr>
										<th width="129" height="45"><strong>Bill No.</strong></th>
										<th width="401"><strong>Address</strong></th>
										<th width="130"><strong>Purchase Date</strong></th>
										<th width="105"><strong>Total Amount</strong></th>
										<th width="70"><strong>Status</strong></th>
										<th width="86"><strong>View</strong></th>
									</tr>
								</thead>
								<tbody>
									<?php

									while ($rs = mysqli_fetch_array($qsql)) {
										$sqlsum = "select sum(cost * quantity)  from product_purchase_record where product_purchase_bill_id='$rs[product_purchase_bill_id]'";
										$qsqlsum = mysqli_query($con, $sqlsum);
										$rssum = mysqli_fetch_array($qsqlsum);

										echo "<tr>
				  			<td>&nbsp;$rs[product_purchase_bill_id]</td>
							<td>&nbsp;$rs[customer_address]</td>
				  			<td>&nbsp;$rs[purchase_date]</td>
				  			<td>&nbsp;$rupeesymbol " . $rssum[0]  . "</td>
				  			<td>&nbsp;$rs[status]</td>
				  			<td>&nbsp; <a href='printbill.php?billid=$rs[0]'>View Bill</a></td>
						</tr> ";
									}
									?>
								</tbody>
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
<script type="application/javascript">
	function delconfirm() {
		if (confirm("Are you sure you want to delete this record?") == true) {
			return true;
		} else {
			return false;
		}
	}
</script>