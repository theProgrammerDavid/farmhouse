<?php
include("header.php");
include("dbconnection.php");
if (isset($_GET[deleteid])) {
	$sql = "DELETE FROM customer WHERE customer_id='$_GET[deleteid]'";
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
				<h3>View Registered Customers</h3>
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
							<h4>View Registered Customer list...</h4>
						</center>
						<hr>

						<?php
						$sql = "SELECT * FROM customer";
						$qsql = mysqli_query($con, $sql);
						if (mysqli_num_rows($qsql)  == 0) {
							echo "<center>There is no customer to display!!</center>";
						} else {
						?>
							<table ID="datatable" class="table table-striped table-bordered" style="width:100%">
								<THEAD>
									<tr>
										<th height="32"><strong>Customer Name</strong></th>
										<th><strong>Address</strong></th>
										<th><strong>Contact Number</strong></th>
										<th><strong>Mobile Number</strong></th>
										<th><strong>Customer Type</strong></th>
										<th><strong>Status</strong></th>
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
							    <td>&nbsp;$rs[address],<br>
&nbsp;$rs1[country],<br>
&nbsp;$rs2[state],<br>
&nbsp;$rs3[city]<br>
PIN code: &nbsp;$rs[pincode]</td>
							    <td>&nbsp;$rs[contact_no]</td>
							    <td>&nbsp;$rs[mobile_no]</td>
							    <td>&nbsp;$rs[customer_type]</td>
							    <td>&nbsp;$rs[status]</td>
							    <td>&nbsp; <a href='customerReg.php?editid=$rs[customer_id]'>Edit</a>| <a href='viewcustomerReg.php?deleteid=$rs[customer_id]' onclick='return delconfirm()'>Delete</a></td>
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