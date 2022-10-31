<?php
include("header.php");
include("dbconnection.php");
if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM seller WHERE seller_id='$_GET[deleteid]'";
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
				<h3>View Farmer</h3>
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
							<h4>Registered Farmers list...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM seller";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no Seller to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th width="98" height="60"><strong>Name</strong></th>
										<th width="130"><strong>Address</strong></th>
										<th width="104"><strong>Contact No.</strong></th>
										<th width="104"><strong>Mobile No.</strong></th>
										<th width="115"><strong>Email ID</strong></th>
										<th width="138"><strong>Bank Details</strong></th>
										<th width="98"><strong>Status</strong></th>
										<th width="104"><strong>Action</strong></th>
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
										$rs12 = mysqli_fetch_array($qsql2);

										$sql3 = "SELECT * FROM city WHERE city_id='$rs[city_id]'";
										$qsql3 = mysqli_query($con, $sql3);
										$rs13 = mysqli_fetch_array($qsql3);
										echo "
						    <tr>
						      <td>&nbsp;$rs[seller_name]</td>
						      <td>&nbsp;$rs[seller_address],
						      &nbsp;$rs13[city],
						      &nbsp;$rs12[state],
						      &nbsp;$rs1[country],
						      PIN Code:&nbsp;$rs[pincode].
						      <td>&nbsp;$rs[contact_number]</td>
						      <td>&nbsp;$rs[mobile_no]</td>
						      <td>&nbsp;$rs[email_id]</td>
						      <td> <strong>Bank A/c No.:</strong>&nbsp;$rs[bank_acno],<br>" . "
							  <strong>IFSC Code:</strong>&nbsp;$rs[bank_IFSC],<br>" . "
							  <strong>Bank Name:</strong>&nbsp;$rs[bank_name],<br>" . "
						      <strong>Branch:</strong>&nbsp;$rs[bank_branch].
						     </td>
						      <td>&nbsp;$rs[status]</td>
						      <td>&nbsp;  <a href='seller.php?editid=$rs[seller_id]'>Edit</a> | <a href='viewseller.php?deleteid=$rs[seller_id]' onclick='return delconfirm()'>Delete</a></td>
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