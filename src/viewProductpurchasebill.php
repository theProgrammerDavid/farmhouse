<?php
include("header.php");
include("dbconnection.php");
if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM product_purchase_bill WHERE product_purchase_bill_id='$_GET[deleteid]'";
	if (!mysqli_query($con, $sql)) {
		echo "<script>alert('Failed to delete record'); </script>";
	} else {
		if (mysqli_affected_rows($con)  >= 1) {
			echo "<script>alert('This record deleted successfully..'); </script>";
		}
	}
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>Product Purchase Bill</h3>
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
							<h4>Product Purchase Bill...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM product_purchase_bill";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no Product purchase bill to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th><strong>Customer Name</strong></th>
										<th><strong>Customer Address</strong></th>
										<th><strong>Country</strong></th>
										<th><strong>State</strong></th>
										<th><strong>City</strong></th>
										<th><strong>Pincode</strong></th>
										<th><strong>Contact Number</strong></th>
										<th><strong>Action</strong></th>
									</tr>
								</THEAD>
								<TBODY>
									<?php
									while ($rs = mysqli_fetch_array($qsql)) {
										$sql1 = "SELECT * FROM country WHERE country_id='$rs[country_id]'";
										$qsql1 = mysqli_query($con, $sql1);
										$rs1 = mysqli_fetch_array($qsql1);

										$sql2 = "SELECT * FROM state WHERE state_id='$rs[state_id]'";
										$qsql2 = mysqli_query($con, $sql2);
										$rs2 = mysqli_fetch_array($qsql2);

										$sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
										$qsql3 = mysqli_query($con, $sql3);
										$rs3 = mysqli_fetch_array($qsql3);
										echo "
							  <tr> 
						      <td>&nbsp;$rs[customer_name]</td>
						      <td>&nbsp;$rs[customer_address]</td>
						      <td>&nbsp;$rs1[country]</td>
						      <td>&nbsp;$rs2[state]</td>
						      <td>&nbsp;$rs3[city]</td>
						      <td>&nbsp;$rs[pincode]</td>
						      <td>&nbsp;$rs[customer_contact_number]</td>
							    <td>&nbsp;  <a href='Productpurchasebill.php?editid=$rs[product_purchase_bill_id]'>Edit</a> |  <a href='viewProductpurchasebill.php?deleteid=$rs[product_purchase_bill_id]'onclick='return delconfirm()'>Delete</a></td>
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
<script type="application/javascript">
	function delconfirm() {
		if (confirm("Are you sure you want to delete this record?") == true) {
			return true;
		} else {
			return false;
		}
	}
</script>