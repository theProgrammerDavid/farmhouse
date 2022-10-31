<?php
include("header.php");
if (!isset($_SESSION)) {
	session_start();
}
if (!isset($_SESSION[customerid])) {
	echo "<script>window.location='customerpanel.php';</script>";
}
if (isset($_SESSION[customerid])) {
	$sql = "SELECT * FROM customer WHERE customer_id='$_SESSION[customerid]'";
	$qsql = mysqli_query($con, $sql);
	$rsdisp = mysqli_fetch_array($qsql);
}
?>
<main id="main">


	<!-- ======= Cta Section ======= -->
	<section id="cta" style="padding-bottom:0px;">
		<div class="container">

			<div class="text-center" data-aos="zoom-in">
				<br><br>
				<h3>Customer Dashboard</h3>
			</div>

		</div>
	</section><!-- End Cta Section -->


	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">
			<div class="row">

				<div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
					<div class="info mt-4">
						<form method="post" action="" name="frmcstview">
							<table class="table table-striped table-bordered" style="width:100%" class="datatable">
								<tbody>
									<tr>
										<th width="175" height="34" align="right"><strong>Your Name:</strong></th>
										<td><?php echo $rsdisp[customer_name]; ?></td>
									</tr>
									<tr>
										<th height="48" align="right"><strong>Your Address:</strong></th>

										<?php

										$sql1 = "SELECT * FROM country WHERE country_id='$rsdisp[country_id]'";
										$qsql1 = mysqli_query($con, $sql1);
										$rs1 = mysqli_fetch_array($qsql1);

										$sql2 = "SELECT * FROM state WHERE state_id='$rsdisp[state_id]'";
										$qsql2 = mysqli_query($con, $sql2);
										$rs2 = mysqli_fetch_array($qsql2);

										$sql3 = "SELECT * FROM city WHERE city_id='$rsdisp[city_id]'";
										$qsql3 = mysqli_query($con, $sql3);
										$rs3 = mysqli_fetch_array($qsql3); ?>
										<td>
											<?php echo $rsdisp[address]; ?><br />
											<?php echo $rs3[city]; ?><br />
											<?php echo $rsdisp[pincode]; ?><br />
											<?php echo $rs2[state]; ?> <br />
											<?php echo $rs1[country]; ?><br />
										</td>
									</tr>
									<tr>
										<th height="39" align="left"><strong>Contact Number:</strong></th>
										<td><?php echo $rsdisp[contact_no]; ?></td>
									</tr>
									<tr>
										<th height="35" align="left"><strong>Mobile Number:</strong></th>
										<td><?php echo $rsdisp[mobile_no]; ?></td>
									</tr>
									<tr>
										<th height="39" align="left"><strong>Email ID:</strong></th>
										<td><?php echo $rsdisp[email_id]; ?></td>
									</tr>
									<tr>
										<th height="33" align="left"><strong>Customer Type:</strong></th>
										<td><?php echo $rsdisp[customer_type]; ?>
										</td>
									</tr>
							</table>
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
	$(document).ready(function() {
		$('#datatable').DataTable();
	});
</script>